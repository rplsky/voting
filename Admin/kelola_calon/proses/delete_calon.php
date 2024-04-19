<?php

	$id = $_GET['id'];
	$foto = $_GET['foto'];

	unlink("../assets/img/calon/".$foto);

	$query = "DELETE FROM tbl_calon WHERE id_pil = '$id'";
	$sql = $pdo->prepare($query);
	$sql->execute();
	
	if($sql){
		?>
		<script type="text/javascript">
			alert('Data telah terhapus');
			setTimeout("location.href='?page=calon&aksi=aktif'", 1000);
		</script>
		<?php
	}else{
		echo $query;
		?>
		<script type="text/javascript">
			alert('Data gagal terhapus');
			setTimeout("location.href='?page=calon&aksi=aktif'", 1000);
		</script>
		<?php
	}
?>