<script type="text/javascript">
    function reload_table() {
        var currentUrl = window.location.href;
        var tabel = $("#tabelJadwal").DataTable();
        $.ajax({
            url : currentUrl,
            type : "GET",
            dataType : "html",
            success:function (data) {
                var reloadData = $(data).find("#tabelJadwal tbody").html();
                tabel.clear().draw();
                $("#tabelJadwal tbody").html(reloadData);
                tabel.rows.add($("#tabelJadwal tbody tr")).draw();
            }
        });
    }
    $(document).ready(function() {
        $("#tabelJadwal").DataTable();
        jQuery(document).on("click","#formTambah",function () {
            $.ajax({
                url : "<?php echo site_url('master/jadwal/form-tambah') ?>",
                type : "POST",
                data : { },
                success : function (response) {
                    $("#modalSaya").html(response);
                    $("#modalSaya").modal("show");
                }
            });
        });
        jQuery(document).on("click","#formEdit",function () {
            var id_jadwal = $(this).data("id_jadwal");
            $.ajax({
                url : "<?php echo site_url('master/jadwal/form-edit') ?>",
                type : "POST",
                data : {"id_jadwal" : id_jadwal},
                success : function (response) {
                    $("#modalSaya").html(response);
                    $("#modalSaya").modal("show");
                }
            });
        });
        jQuery(document).on("click","#btnTambah",function (e) {
            e.preventDefault();
            var id_kelas = $("#id_kelas").val();
            var id_mapel = $("#mata_pelajaran").val();
            var id_guru = $("#id_guru").val();
            var id_hari = $("#hari").val();
            var jam_mulai = $("#jam_mulai").val();
            var jam_selesai = $("#jam_selesai").val();
            $.ajax({
                url : "<?php echo site_url('master/jadwal/tambah-jadwal') ?>",
                type : "POST",
                data : {
                    "id_kelas" : id_kelas,
                    "mata_pelajaran" : id_mapel,  
                    "id_guru" : id_guru,
                    "hari" : id_hari,
                    "jam_mulai" : jam_mulai,
                    "jam_selesai" : jam_selesai
                },
                success : function (response) {
                    if(response.sukses === true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        reload_table();
                        $("#modalSaya").modal("hide");
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }    
            });
        });
        jQuery(document).on("click","#btnEdit",function (e) {
        e.preventDefault();
        var id_jadwal = $(this).data("id_jadwal");
        var id_kelas = $("#id_kelas").val();
        var mata_pelajaran = $("#mata_pelajaran").val();
        var id_guru = $("#id_guru").val();
        var hari = $("#hari").val();
        var jam_mulai = $("#jam_mulai").val();
        var jam_selesai = $("#jam_selesai").val();

        const data = [id_kelas, mata_pelajaran, id_guru, hari, jam_mulai, jam_selesai];
        const pesan = ["Kelas", "Mata Pelajaran", "Guru", "Hari", "Jam Mulai", "Jam Selesai"];
        var valid = true;
        
        if (id_jadwal == "") {
            valid = false;
            Swal.fire("Terjadi Kesalahan Sistem!");
        } else {
            for (var i = 0; i < data.length; i++) {
                if (data[i] == "") {
                    alert("Ketikkan " + pesan[i] + " dari Jadwal!");
                    valid = false;
                    break;
                }
            }
        }

        if (valid) {
            $.ajax({
                url : "<?php echo site_url("master/jadwal/edit-jadwal") ?>",
                type : "POST",
                data : {
                    "id_jadwal" : id_jadwal,
                    "id_kelas" : id_kelas,
                    "mata_pelajaran" : mata_pelajaran,
                    "id_guru" : id_guru,
                    "hari" : hari,
                    "jam_mulai" : jam_mulai,
                    "jam_selesai" : jam_selesai
                },
                success:function (response) {
                    var data = JSON.parse(response);
                    if (data.sukses === true) {
                        Swal.fire("Jadwal berhasil diperbarui!");
                        $("#modalSaya").modal("toggle");
                        reload_table();
                    } else {
                        Swal.fire("Gagal, Terjadi Kesalahan Sistem!");
                    }
                }
            });
        }
    });

        jQuery(document).on("click","#btnDelete",function () {
            var id_jadwal = $(this).data("id_jadwal");
            if (id_jadwal == null) {
            Swal.fire("Terjadi Kesalahan Sistem");
            }else {
            Swal.fire({
                title: "Konfirmasi Hapus?",
                text: "Anda tidak akan bisa mengembalikan data ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus Data ini!"
            }).then((result) => {
                if (result.value) {
                console.log("tombol yes");
                $.ajax({
                    url : "<?php echo site_url("master/jadwal/hapus-jadwal") ?>",
                    type : "POST",
                    data : {"id_jadwal" : id_jadwal },
                    success : function (response) {
                    if (response.sukses === true) {
                        Swal.fire({
                        title: "Deleted!",
                        text: "Data Jadwal berhasil dihapus!",
                        icon: "success"
                        });
                        reload_table();
                    }else {
                        Swal.fire({
                        title : "Failed",
                        text : "Terjadi Kesalahan Sistem!",
                        icon : "error"
                        });
                    }
                    }
                });
                }else {
                console.log("tombol cancel");
                }
            });
            }
        });
    });
 
</script>
      

