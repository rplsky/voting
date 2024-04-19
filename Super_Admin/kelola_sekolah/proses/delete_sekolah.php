<?php
	include '../config/koneksi.php';

	$id = $_GET['id'];
	$logo = $_GET['logo'];
	$frame = $_GET['frame'];

	$hapus1 = unlink("../Assets/img/sekolah/".$logo);
	$hapus2 = unlink("../Assets/img/frame/".$frame);

	if ($hapus1 && $hapus2) {
		$query = "DELETE FROM tbl_sekolah WHERE id_sekolah = '$id'";
		$sql = $pdo->prepare($query);
		$sql->execute();
		
		if($sql){
			?>
			<script type="text/javascript">
				alert('Data telah terhapus');
				setTimeout("location.href='?page=sekolah&aksi=aktif'", 1000);
			</script>
			<?php
		}else{
			echo $query;
			?>
			<script type="text/javascript">
				alert('Data gagal terhapus');
				setTimeout("location.href='?page=sekolah&aksi=aktif'", 1000);
			</script>
			<?php
		}
	} else {
		?>
		<script type="text/javascript">
			alert('Gambar gagal dihapus.');
			setTimeout("location.href='?page=sekolah&aksi=aktif'", 1000);
		</script>
		<?php
	}
?>