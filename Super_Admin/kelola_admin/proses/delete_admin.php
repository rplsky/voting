<?php

	$id = $_GET['id'];

	$query = "DELETE FROM tbl_admin WHERE nip = '$id';";
	$query .= "DELETE FROM tbl_login WHERE username = '$id'";
	$sql = $pdo->prepare($query);
	$sql->execute();
	
	if($sql){
		?>
		<script type="text/javascript">
			alert('Data telah terhapus');
			setTimeout("location.href='?page=admin&aksi=aktif'", 1000);
		</script>
		<?php
	}else{
		echo $query;
		?>
		<script type="text/javascript">
			alert('Data gagal terhapus');
			setTimeout("location.href='?page=admin&aksi=aktif'", 1000);
		</script>
		<?php
	}
?>