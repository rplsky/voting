<?php
	$id_skl = $_SESSION['sekolah'];
	$nip = $_POST['nip'];
	$nama_guru = $_POST['nama_guru'];
	$jk = $_POST['jk'];
	$jabatan = $_POST['jabatan'];
	$pass = sha1("gurusmkskr@76");
	$status = "Aktif";
	$akses = "Guru";

	if ($jk=='') {
		?>
		<script type="text/javascript">
			alert('Jenis Kelamin belum terisi');
			setTimeout("location.href='?page=guru&aksi=tambah'", 1000);
		</script>
		<?php
	}else{
		if ($jk=='L') {
			$foto = 'user_laki.png';
		}else{
			$foto = 'user_perempuan.png';
		}
			$query = "INSERT INTO tbl_admin (nip, id_sekolah, nama, jk, jabatan, hak_akses, foto) VALUES ('$nip', '$id_skl', '$nama_guru', '$jk', '$jabatan', '$akses', '$foto');";
			$query .= "INSERT INTO tbl_login (username, id_sekolah, password, hak_akses, status) VALUES ('$nip', '$id_skl','$pass', '$akses', '$status')";
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
					setTimeout("location.href='?page=guru&aksi=tambah'", 1000);
				</script>
				<?php
			}
	}	
?>