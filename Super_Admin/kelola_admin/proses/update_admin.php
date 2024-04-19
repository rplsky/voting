<?php
	$id = $_POST['id'];
	$nama_admin = $_POST['nama_admin'];
	$sekolah = $_POST['sekolah'];
	$jk = $_POST['jk'];
	$jabatan = $_POST['jabatan'];

	if ($jk=='') {
		?>
		<script type="text/javascript">
			alert('Jenis Kelamin belum terisi');
			setTimeout("location.href='?page=admin&aksi=edit&id = <?php echo $id;?>'", 1000);
		</script>
		<?php
	}else{
		if ($jk=='L') {
			$foto = 'user_laki.png';
		}else{
			$foto = 'user_perempuan.png';
		}
	
			$query = "UPDATE tbl_admin SET  
								id_sekolah = '$sekolah',
								nama = '$nama_admin', 
								jk = '$jk', 
								jabatan = '$jabatan',
								foto = '$foto'
								WHERE nip = '$id';";
			$query .="UPDATE tbl_login SET  
								username = '$id'
								WHERE username = '$id'";
			$sql = $pdo->prepare($query);
			$sql->execute();
			if($sql){
				?>
				<script type="text/javascript">
					alert('Data telah tersimpan');
					setTimeout("location.href='?page=admin&aksi=aktif'", 1000);
				</script>
				<?php
			}else{
				echo $query;
				?>
				<script type="text/javascript">
					alert('Data gagal tersimpan');
					setTimeout("location.href='?page=admin&aksi=edit&id = <?php echo $id;?>'", 1000);
				</script>
				<?php
			}
	}
?>