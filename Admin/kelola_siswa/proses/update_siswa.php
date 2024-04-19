<?php
	$id = $_POST['id'];
	$nis = $_POST['nis'];
	$nama_siswa = $_POST['nama_siswa'];
	$jk = $_POST['jk'];
	$kelas = $_POST['kelas'];
	$pass = sha1("siswasmksky@22");
	$mac = '';

	if ($jk=='') {
		?>
		<script type="text/javascript">
			alert('Jenis Kelamin belum terisi');
			setTimeout("location.href='?page=siswa&aksi=edit&id = <?php echo $id;?>'", 1000);
		</script>
		<?php
	}else{
		if ($jk=='L') {
			$foto = 'user_laki.png';
		}else{
			$foto = 'user_perempuan.png';
		}
	
			$query = "UPDATE tbl_siswa SET  
								nis = '$nis',
								nama = '$nama_siswa', 
								jk = '$jk', 
								kelas = '$kelas',
								foto = '$foto'
								WHERE nis = '$id';";
			$query .="UPDATE tbl_login SET  
								username = '$nis',
								password = '$pass',
								mac_address = '$mac'
								WHERE username = '$id'";
			$sql = $pdo->prepare($query);
			$sql->execute();
			if($sql){
				?>
				<script type="text/javascript">
					alert('Data telah tersimpan');
					setTimeout("location.href='?page=siswa&aksi=aktif'", 1000);
				</script>
				<?php
			}else{
				echo $query;
				?>
				<script type="text/javascript">
					alert('Data gagal tersimpan');
					setTimeout("location.href='?page=siswa&aksi=edit&id = <?php echo $id;?>'", 1000);
				</script>
				<?php
			}
	}
?>