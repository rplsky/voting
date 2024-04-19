<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>School Voting</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="Assets/img/logo.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/main.css">
<!--===============================================================================================-->
  <meta name="google-site-verification" content="4B_l4uEl3CngZUJ13-sFv96As565dr9PKop9lNtF-to" />
  <link rel="stylesheet" type="text/css" href="Assets/css/style_baru.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;700&family=Poppins:wght@700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <!--===============================================================================================-->
</head>
<body>
  
    <div class="container">
        <div class="img">
          <img src="Assets/img/pilketos.png">
        </div>
        <div class="login-content">
            <form action="" method="POST">
                <img class="avatar" src="Assets/img/logo.png"></img>
                <h4 style="margin-top:20px;">Sistem Informasi</h4>
                <h6>Pemilihan Ketua OSIS</h6><br>
                        <div class="input-div one">
                            <div class="i">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="div">
                                <h5>Username</h5>
                                <input class="input" type="text" name="username">
                            </div>
                        </div>
                        <div class="input-div pass">
                            <div class="i"> 
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="div">
                                <h5>Password</h5>
                                <input class="input" type="password" name="password">
                            </div>
                        </div>
                        <button class="btn" name="login">LOGIN</button>
            </form>
        </div>
    </div>
    
<!--===============================================================================================-->
	<script type="text/javascript" src="Assets/js/login_js.js"></script>

<!--===============================================================================================-->
	<script src="Assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="Assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="Assets/vendor/bootstrap/js/popper.js"></script>
	<script src="Assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="Assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="Assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="Assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="Assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="Assets/js/main.js"></script>

</body>
</html>

<?php
    include 'Config/koneksi.php';
    include 'Config/mac.php';
    if(isset($_POST['login'])) {
        $pass=sha1($_POST['password']);
        $password = $_POST['password'];
        $user=$_POST['username'];
        $query = "SELECT * FROM tbl_login INNER JOIN tbl_sekolah ON tbl_login.id_sekolah = tbl_sekolah.id_sekolah WHERE tbl_login.username = '$user' AND tbl_login.password = '$pass'";
        $login = $pdo->prepare($query);
        $login->execute();
        $cocok = $login->rowCount();
        $r=$login->fetch();
            if ($cocok >0){
                $_SESSION['username'] = $r['username'];
                $_SESSION['level'] =$r['hak_akses'];
                $_SESSION['sekolah'] =$r['id_sekolah'];
                $_SESSION['password'] =$pass;
                $_SESSION['timestamp']=time();

                if ($r['status']=='Y') {
	                if($_SESSION['level']=='Super Admin' || $_SESSION['level']=='Admin' || $password == 'siswasmksky@22' || $password == 'gurusmksky@22' || $password == 'adminsmksky@22'){
	                    if ($_SESSION['level']=='Super Admin') {
		                    echo "<script>window.alert('Anda masuk sebagai Super Admin');
		                            window.location='Super_Admin/index.php?page=beranda&aksi=aktif'</script>";
		                } else {
		                	if($_SESSION['level']=='Admin' && $password != 'adminsmksky@22'){
				                    ?><script>window.alert('Anda masuk sebagai Admin');
				                            window.location='Admin/index.php?page=beranda&aksi=aktif'</script>
				                    <?php
			                } else {
		                	/*echo "<script>window.alert('Anda telah berhasil masuk');
		                            window.location='ganti_password.php'</script>"; */
								if($_SESSION['level']=='Guru'){
									echo "<script>window.alert('Anda masuk sebagai Guru');
											window.location='Guru/index.php?page=beranda&aksi=aktif'</script>";
								} else{
									echo "<script>window.alert('Anda masuk sebagai Siswa');
											window.location='Siswa/index.php?page=beranda&aksi=aktif'</script>";
								}
		                    }
		                }
	                } else {
	                //	if (strcmp($r['mac_address'], $macAddr) == 0){
			                if($_SESSION['level']=='Guru'){
			                    echo "<script>window.alert('Anda masuk sebagai Guru');
			                            window.location='Guru/index.php?page=beranda&aksi=aktif'</script>";
			                } else{
			                    echo "<script>window.alert('Anda masuk sebagai Siswa');
			                            window.location='Siswa/index.php?page=beranda&aksi=aktif'</script>";
			                }
			         /*  } else {
			            	echo "<script>window.alert('Akun anda telah terdaftar di perangkat lain. Silahkan hubungi Admin');
			                            window.location='Config/logout.php?id=timeout'</script>";
			            } */
		            }
	            } else {
	            	echo "<script>window.alert('Status sekolah pasif. Silahkan hubungi Super Admin');
	                            window.location='Config/logout.php?id=timeout'</script>";
	            }
            } else {
                ?><script>window.alert('Username dan atau password salah');
                            window.location='index.php'</script>
                    <?php
            }
    }

?>
