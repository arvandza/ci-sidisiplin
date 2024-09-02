<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Siswa ke Kelas</title>
    <!-- Tambahkan link CSS AdminLTE dan Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css'); ?>">
    <style>
        .result-list {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .result-item {
            cursor: pointer;
            padding: 5px;
            border-bottom: 1px solid #eee;
        }
        .result-item:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col">
                        
                        <div class="container mt-5">
                            <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
        <?= $this->session->flashdata('error'); ?>
    </div>
    <?php endif; ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Siswa ke Kelas</h3>
            </div>
            <div class="card-body">
                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                <?php endif; ?>
                <form action="<?= base_url('kelas/proses_tambah_siswa'); ?>" method="post">
                    <div class="form-group">
                        <label for="id_kelas">Pilih Kelas</label>
                        <select name="id_ruang_belajar" id="id_kelas" class="form-control">
                            <?php foreach ($kelas as $k): ?>
                                <option value="<?= $k->id_ruang_belajar; ?>"><?= $k->kode_ruang_belajar; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="search_siswa">Cari Siswa</label>
                        <input type="text" id="search_siswa" class="form-control" placeholder="Masukkan nama siswa">
                        <div class="result-list" id="result_list"></div>
                    </div>
                    <div class="form-group">
                        <label for="id_siswa">Siswa yang Dipilih</label>
                        <ul id="selected_siswa" class="list-group"></ul>
                    </div>
                    <input type="hidden" name="id_siswas[]" id="id_siswa_input">
                    <button type="submit" class="btn btn-primary">Tambah Siswa</button>
                </form>
            </div>
        </div>
    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tambahkan link JS AdminLTE, jQuery, dan Select2 -->
    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js'); ?>"></script>
    
</body>
</html>
