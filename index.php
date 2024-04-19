<?php
	session_start();
	if (empty($_SESSION['username']) && empty($_SESSION['level'])) {
		header("location:login.php");
	}else{
		if($_SESSION['level']=='Admin'){
            ?>
            <script>window.alert('Anda masuk sebagai Admin');
            window.location='Admin/index.php?page=beranda&aksi=aktif'</script>
            <?php
        } else if($_SESSION['level']=='Guru'){
            echo "<script>window.alert('Anda masuk sebagai Guru');
                  window.location='Guru/index.php?page=beranda&aksi=aktif'</script>";
        } else if($_SESSION['level']=='Super Admin'){
					echo "<script>window.alert('Anda masuk sebagai Super Admin');
									window.location='Super_Admin/index.php?page=beranda&aksi=aktif'</script>";
        } else{
            echo "<script>window.alert('Anda masuk sebagai Siswa');
                 window.location='Siswa/index.php?page=beranda&aksi=aktif'</script>";
        }
	}
?>
