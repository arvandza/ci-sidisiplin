<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthHook{
    public function check_login(){
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->load->helper('url');

        $excluded_routes = array('siswa/siswa_login', 'logout', 'master/login', 'master/authadmin');
        $current_route = $CI->uri->uri_string();
        
        if(!$CI->session->userdata('logged_in') && !in_array($current_route, $excluded_routes)) {
            redirect('siswa/siswa_login');
        }
    }
}