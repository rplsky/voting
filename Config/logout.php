<?php
	$id = $_GET['id'];

	if($id=="timeout" || $id=="akses"){
		session_start();
		session_destroy();
		echo "<script>window.location='../index.php'</script>";	
	} else{
		session_start();
		session_destroy();
		echo "<script>window.alert('Anda telah keluar dari system');
		            window.location='../index.php'</script>";
	}
?>