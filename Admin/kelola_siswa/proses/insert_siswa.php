<?php
	$id_skl = $_SESSION['sekolah'];
	$nis = $_POST['nis'];
	$nama_siswa = $_POST['nama_siswa'];
	$jk = $_POST['jk'];
	$kelas = $_POST['kelas'];
	$pass = sha1("siswasmkskr@76");
	$status = "Aktif";
	$akses = "Siswa";

	if ($jk=='') {
		?>
		<script type="text/javascript">
			alert('Jenis Kelamin belum terisi');
			setTimeout("location.href='?page=siswa&aksi=tambah'", 1000);
		</script>
		<?php
	}else{
		if ($jk=='L') {
			$foto = 'user_laki.png';
		}else{
			$foto = 'user_perempuan.png';
		}
			$query = "INSERT INTO tbl_siswa (nis, id_sekolah, nama, jk, kelas, foto) VALUES ('$nis', '$id_skl', '$nama_siswa', '$jk', '$kelas', '$foto');";
			$query .= "INSERT INTO tbl_login (username, id_sekolah, password, hak_akses, status) VALUES ('$nis', '$id_skl','$pass', '$akses', '$status')";
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
					setTimeout("location.href='?page=siswa&aksi=tambah'", 1000);
				</script>
				<?php
			}
	}	
?>