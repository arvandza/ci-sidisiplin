<?php

class UserModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function validate_user($username, $password, $role)
    {
        if ($role === 'orang_tua') {
            // Special case for `orang_tua` role where both `user_akun_1` and `user_akun_2` are possible usernames
            $this->db->where("(user_akun_1 = '$username' OR user_akun_2 = '$username')");
        } else {
            // For `guru` and `siswa`, check the `username` field
            $this->db->where('username', $username);
        }
        $this->db->where('password', md5($password));
        $query = $this->db->get('akun_'. $role);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function update_password($user_id, $role, $newpassword){
        $table = 'akun_'.$role;

        $data = [
            'password' => md5($newpassword), // Hash password baru menggunakan MD5
        ];

        if($role === 'orang_tua') {
            $this->db->where('id_orang_tua', $user_id);
        } else if ($role === 'siswa') {
            $this->db->where('id_siswa', $user_id);
        } else if ($role === 'guru') {
            $this->db->where('id_guru', $user_id);
        }

        $update = $this->db->update($table, $data);

        return $update;
    }

    public function get_superadmin($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('status_aktif', 1);
        
        $query = $this->db->get('super_users');
        if($query->num_rows() == 1){
            return $query->row();
        }else {
            return false;
        }
    }
}