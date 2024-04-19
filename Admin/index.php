<?php
  include '../Config/koneksi.php';
  include '../Config/akun.php';
  include '../Config/function.php';

  if (empty($_SESSION['username']) && empty($_SESSION['level'])) {
        ?>
        <script type="text/javascript">
            alert('Anda Belum Melakukan Login.');
            setTimeout("location.href='../index.php'", 1000);
        </script>
        <?php
    }else{
      if ($_SESSION['level']!='Admin') {
        ?>
        <script type="text/javascript">
            alert('Anda tidak berhak login di sini.');
            setTimeout("location.href='../Config/logout.php?id=akses'", 1000);
        </script>
        <?php
      }else{
        $idletime = 30 * 60;
        if (time()-$_SESSION['timestamp']>$idletime){
          ?>
          <script type="text/javascript">
              alert('Waktu akses anda telah habis. Silahkan login kembali.');
              setTimeout("location.href='../Config/logout.php?id=timeout'", 1000);
          </script>
          <?php
        }else{
          $_SESSION['timestamp']=time();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>School Voting</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="image/png" href="../Assets/img/logo.png"/>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../Assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../Assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../Assets/dist/css/skins/_all-skins.min.css">
  <!-- Grafik Batang -->
  <script src="../Assets/js/chartjs/Chart.js"></script>
  <!-- Grafik Lingkaran -->
  <script src="../Assets/js/chartjs/highcharts.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php?page=beranda&aksi=aktif" class="logo" class="brand-link">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="../Assets/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" height="40px" width="40px" style="opacity: .8"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="../Assets/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" height="40px" width="40px" style="opacity: .8"><b> School </b>Voting</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../Assets/img/<?php echo $data['foto'];?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $data['nama'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../Assets/img/<?php echo $data['foto'];?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $data['nama'];?>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="../Config/logout.php?id=logout" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../Assets/img/<?php echo $data['foto'];?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $data['nama'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?page=calon&aksi=aktif"><i class="fa fa-circle-o"></i> Data Calon Ketua OSIS</a></li>
            <li><a href="?page=siswa&aksi=aktif"><i class="fa fa-circle-o"></i> Data Siswa</a></li>
            <li><a href="?page=guru&aksi=aktif"><i class="fa fa-circle-o"></i> Data Guru</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Hasil Voting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?page=gkandidat&aksi=aktif"><i class="fa fa-circle-o"></i> Grafik Kandidat Ketua OSIS</a></li>
            <li><a href="?page=pemilih&aksi=aktif"><i class="fa fa-circle-o"></i> Grafik Pemilih</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hak Akses : <?php echo $_SESSION['level']; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Hak Akses : <?php echo $_SESSION['level']; ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!--//Tulis Script-->
        <?php
          $page = $_GET['page'];
          $aksi = $_GET['aksi'];

          if($page=='calon'){
              if($aksi=='aktif'){
                include 'kelola_calon/tampil_calon.php';
              } else if($aksi=='tambah'){
                include 'kelola_calon/tambah_calon.php';
              } else if($aksi=='edit') {
                include 'kelola_calon/edit_calon.php';
              } else if($aksi=='delete'){
                include 'kelola_calon/proses/delete_calon.php';
              } else if($aksi=='insert'){
                include 'kelola_calon/proses/insert_calon.php';
              } else if($aksi=='update') {
                include 'kelola_calon/proses/update_calon.php';
              }
          } else if ($page=='siswa') {
              if ($aksi=='aktif') {
                include 'kelola_siswa/tampil_siswa.php';
              } else if ($aksi=='tambah') {
                include 'kelola_siswa/tambah_siswa.php';
              } else if ($aksi=='tambahexcel') {
                include 'kelola_siswa/tambah_siswa_excel.php';
              } else if ($aksi=='edit') {
                include 'kelola_siswa/edit_siswa.php';
              } else if ($aksi=='delete') {
                include 'kelola_siswa/proses/delete_siswa.php';
              } else if ($aksi=='insert') {
                include 'kelola_siswa/proses/insert_siswa.php';
              } else if ($aksi=='update') {
                include 'kelola_siswa/proses/update_siswa.php';
              } else if ($aksi=='insert_excel') {
                include 'kelola_siswa/proses/insert_siswa_excel.php';
              } else if ($aksi=='hapussiswa') {
                include 'kelola_siswa/proses/delete_semuasiswa.php';
              }
          } else if ($page=='guru') {
              if ($aksi=='aktif') {
                include 'kelola_guru/tampil_guru.php';
              } else if ($aksi=='tambah') {
                include 'kelola_guru/tambah_guru.php';
              } else if ($aksi=='tambahexcel') {
                include 'kelola_guru/tambah_guru_excel.php';
              } else if ($aksi=='edit') {
                include 'kelola_guru/edit_guru.php';
              } else if ($aksi=='delete') {
                include 'kelola_guru/proses/delete_guru.php';
              } else if ($aksi=='insert') {
                include 'kelola_guru/proses/insert_guru.php';
              } else if ($aksi=='update') {
                include 'kelola_guru/proses/update_guru.php';
              } else if ($aksi=='insert_excel') {
                include 'kelola_guru/proses/insert_guru_excel.php';
              } else if ($aksi=='hapusguru') {
                include 'kelola_guru/proses/delete_semuaguru.php';
              }
          } else if($page=='gkandidat'){
              if($aksi=='aktif'){
                include 'kandidat/grafik_kandidat.php';
              }
          } else if ($page=='pemilih') {
              if ($aksi=='aktif') {
                include 'pemilih/grafik_pemilih.php';
              } else if ($aksi=='pemilihsudah') {
                include 'pemilih/data_sudah_milih.php';
              } else if ($aksi=='pemilihbelum') {
                include 'pemilih/data_belum_milih.php';
              } else if ($aksi=='pemilihkelas') {
                include 'pemilih/data_kelas.php';
              }
          } else if($page=='beranda'){
              if ($aksi=='aktif') {
                include 'beranda/index.php';
              }
          }
        ?>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <!-- /.row -->

          </div>
          <!-- /.box -->


  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.1.1.1
    </div>
    <strong>Copyright &copy; 2019 <a href="index.php?page=beranda&aksi=aktif">School Voting</a>.</strong> All rights
    reserved.
  </footer>

    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../Assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="../Assets/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../Assets/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../Assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../Assets/dist/js/demo.js"></script>
</body>
</html>

<?php
    }
  }
}
?>
