<?php

	$id = $_GET['id'];

	$query = "DELETE FROM tbl_admin WHERE id_sekolah = '$id' AND Hak_Akses = 'Guru';";
	$query .= "DELETE FROM tbl_login WHERE id_sekolah = '$id' AND Hak_Akses = 'Guru'";
	$sql = $pdo->prepare($query);
	$sql->execute();
	
	if($sql){
		?>
		<script type="text/javascript">
			alert('Data telah terhapus');
			setTimeout("location.href='?page=guru&aksi=aktif'", 1000);
		</script>
		<?php
	}else{
		echo $query;
		?>
		<script type="text/javascript">
			alert('Data gagal terhapus');
			setTimeout("location.href='?page=guru&aksi=aktif'", 1000);
		</script>
		<?php
	}
?>