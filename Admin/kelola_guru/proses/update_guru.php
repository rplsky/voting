<?php
	$id = $_POST['id'];
	$nip = $_POST['nip'];
	$nama_guru = $_POST['nama_guru'];
	$jk = $_POST['jk'];
	$jabatan = $_POST['jabatan'];

	if ($jk=='') {
		?>
		<script type="text/javascript">
			alert('Jenis Kelamin belum terisi');
			setTimeout("location.href='?page=guru&aksi=edit&id = <?php echo $id;?>'", 1000);
		</script>
		<?php
	}else{
		if ($jk=='L') {
			$foto = 'user_laki.png';
		}else{
			$foto = 'user_perempuan.png';
		}
	
			$query = "UPDATE tbl_admin SET  
								nip = '$nip',
								nama = '$nama_guru', 
								jk = '$jk', 
								jabatan = '$jabatan',
								foto = '$foto'
								WHERE nip = '$id';";
			$query .="UPDATE tbl_login SET  
								username = '$nip'
								WHERE username = '$id'";
			$sql = $pdo->prepare($query);
			$sql->execute();
			if($sql){
				?>
				<script type="text/javascript">
					alert('Data telah tersimpan');
					setTimeout("location.href='?page=guru&aksi=aktif'", 1000);
				</script>
				<?php
			}else{
				echo $query;
				?>
				<script type="text/javascript">
					alert('Data gagal tersimpan');
					setTimeout("location.href='?page=guru&aksi=edit&id = <?php echo $id;?>'", 1000);
				</script>
				<?php
			}
	}
?>