<?php

	$id = $_GET['id'];

	$query = "DELETE FROM tbl_siswa WHERE id_sekolah = '$id';";
	$query .= "DELETE FROM tbl_login WHERE id_sekolah = '$id' AND Hak_Akses = 'Siswa'";
	$sql = $pdo->prepare($query);
	$sql->execute();
	
	if($sql){
		?>
		<script type="text/javascript">
			alert('Data telah terhapus');
			setTimeout("location.href='?page=siswa&aksi=aktif'", 1000);
		</script>
		<?php
	}else{
		echo $query;
		?>
		<script type="text/javascript">
			alert('Data gagal terhapus');
			setTimeout("location.href='?page=siswa&aksi=aktif'", 1000);
		</script>
		<?php
	}
?>