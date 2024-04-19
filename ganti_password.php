<?php
  include 'Config/koneksi.php';
  include 'Config/akun.php';

  if (empty($_SESSION['username']) && empty($_SESSION['level'])) {
        ?>
        <script type="text/javascript">
            alert('Anda Belum Melakukan Login.');
            setTimeout("location.href='index.php'", 1000);
        </script>
        <?php
    }else{
        $idletime = 30 * 60;
        if (time()-$_SESSION['timestamp']>$idletime){
          ?>
          <script type="text/javascript">
              alert('Waktu akses anda telah habis. Silahkan login kembali.');
              setTimeout("location.href='Config/logout.php?id=timeout'", 1000);
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
  <link rel="icon" type="image/png" href="Assets/img/logo.png"/>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="Assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="Assets/dist/css/skins/_all-skins.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="Assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- js -->
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
    <a href="ganti_password.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="Assets/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" height="40px" width="40px" style="opacity: .8"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="Assets/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" height="40px" width="40px" style="opacity: .8"><b> School </b>Voting</span>
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
              <img src="Assets/img/<?php echo $data['foto'];?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $data['nama'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="Assets/img/<?php echo $data['foto'];?>" class="img-circle" alt="User Image">

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
                  <a href="Config/logout.php?id=logout" class="btn btn-default btn-flat">Keluar</a>
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
          <img src="Assets/img/<?php echo $data['foto'];?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $data['nama'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
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
       <div class="panel panel-default">
          <div class="panel-heading">
            <h3><strong>Ganti Password</strong></h3>
          </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-6" >
                  <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Password Baru</label>
                      <input class="form-control" type="password" name="password" required placeholder="Password Baru" />
                    </div>
                    <div class="form-group">
                      <label>Password Konfirmasi</label>
                      <input class="form-control" type="password" name="password_konfirmasi" required placeholder="Password Konfirmasi" />
                    </div>

                    <input type="submit" name="simpan" value="Simpan" class="btn btn-primary" style="margin-top:15px">
                  </form>
                </div>
              </div>
              <label>Password minimal dari 8 karakter yang terdiri dari kombinasi Huruf Kapital (A-Z), Huruf Kecil (a-z) dan Angka (0-9). Contoh : Smksky22</label>
            </div>
        </div>
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
    <strong>Copyright &copy; 2019 <a href="ganti_password.php">School Voting</a>.</strong> All rights
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
<script src="Assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="Assets/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="Assets/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="Assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="Assets/dist/js/demo.js"></script>
</body>
</html>

<?php
    }
}
?>

<?php
          include 'Config/koneksi.php';
          include 'Config/mac.php';
          if(isset($_POST['simpan'])) {
            $password_baru = sha1($_POST['password']);
            $password_text = $_POST['password'];
            $password_konfirmasi = sha1($_POST['password_konfirmasi']);
            $password = $_SESSION['password'];

            if ($password == $password_baru) {
              echo "<script>window.alert('Password yang anda masukkan sama dengan password lama');
                                window.location='ganti_password.php'</script>";
            } else{
              if ($password_baru != $password_konfirmasi) {
                echo "<script>window.alert('Password yang anda masukkan tidak sama dengan password konfirmasi');
                                window.location='ganti_password.php'</script>";
              } else {
                $uppercase = preg_match('@[A-Z]@', $password_text);
                $lowercase = preg_match('@[a-z]@', $password_text);
                $number    = preg_match('@[0-9]@', $password_text);

                if(!$uppercase || !$lowercase || !$number || strlen($password_text)<=7){
                    echo "<script>window.alert('Password harus lebih dari 8 karakter, mengandung huruf BESAR, huruf kecil dan angka');
                                window.location='ganti_password.php'</script>";
                }else{
                     /*
                      $query_mac = "SELECT * FROM tbl_login WHERE mac_address = '$macAddr'";
                      $sql_mac = $pdo->prepare($query_mac);
                      $sql_mac->execute();
                      $cocok = $sql_mac->rowCount();

                      if ($cocok > 0) {
                        echo "<script>window.alert('Perangkat sudah terdaftar di akun lain. Silahkan hubungi Admin.');
                                window.location='ganti_password.php'</script>";
                      } else { */
                          $query ="UPDATE tbl_login SET
                                                      password = '$password_baru',
                                                      mac_address = '$macAddr'
                                                      WHERE username = '$user'";
                          $sql = $pdo->prepare($query);
                          $sql->execute();
                          if($sql){
                            ?>
                            <script type="text/javascript">
                              alert("Data telah tersimpan\nUsername : <?php echo$user;?>\nPassword  : <?php echo$password_text;?>\nAkses  : <?php echo$_SESSION['level'];?>");
                              setTimeout("location.href='Config/logout.php?id=timeout'", 1000);
                            </script>
                            <?php
                          }else{
                            echo $query;
                            ?>
                            <script type="text/javascript">
                              alert('Data gagal tersimpan');
                              setTimeout("location.href='ganti_password.php'", 1000);
                            </script>
                            <?php
                        }
                     // }
                }
              }
            }
          }
        ?>
