<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard Siswa v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- Box untuk Kehadiran -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $presensi['hadir']; ?></h3>
              <p>Kehadiran</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo site_url("siswa/presensi") ?>" class="small-box-footer">Info Lanjut
              <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- Box untuk Izin -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo $presensi['izin']; ?></h3>
              <p>Izin</p>
            </div>
            <div class="icon">
              <ion-icon name="chevron-forward-outline"></ion-icon>
            </div>
            <a href="<?php echo site_url("siswa/presensi") ?>" class="small-box-footer">Info Lanjut 
              <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- Box untuk Alpa -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo $presensi['alpa']; ?></h3>
              <p>Alpa</p>
            </div>
            <div class="icon">
              <i class="ion ion-class"></i>
            </div>
            <a href="<?php echo site_url("siswa/presensi") ?>" class="small-box-footer">Info Lanjut 
              <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- Box untuk Sakit -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo $presensi['sakit']; ?></h3>
              <p>Sakit</p>
            </div>
            <div class="icon">
              <i class="ion ion-medkit"></i>
            </div>
            <a href="<?php echo site_url("siswa/presensi") ?>" class="small-box-footer">Info Lanjut 
              <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
</div>
