<?php
	$query = "SELECT max(nip) as maxKode FROM tbl_admin Where hak_akses LIKE 'Admin'";
	$sql = $pdo->prepare($query);
	$sql->execute();
	$data = $sql->fetch();
	$kode = $data['maxKode'];
	 
	// mengambil angka atau bilangan dalam kode anggota terbesar,
	// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
	// misal 'BRG001', akan diambil '001'
	// setelah substring bilangan diambil lantas dicasting menjadi integer
	$noUrut = (int) substr($kode, 3, 3);
	 
	// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
	$noUrut++;
	 
	// membentuk kode anggota baru
	// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
	// misal sprintf("%03s", 12); maka akan dihasilkan '012'
	// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
	$char = "A";
	$id_admin = $char . sprintf("%03s", $noUrut);

	$id_skl = $_POST['sekolah'];
	$nama_admin = $_POST['nama_admin'];
	$jk = $_POST['jk'];
	$jabatan = $_POST['jabatan'];
	$pass = sha1("adminsmkskr@76");
	$status = "Aktif";
	$akses = "Admin";

	if ($jk=='') {
		?>
		<script type="text/javascript">
			alert('Jenis Kelamin belum terisi');
			setTimeout("location.href='?page=admin&aksi=tambah'", 1000);
		</script>
		<?php
	}else{
		if ($jk=='L') {
			$foto = 'user_laki.png';
		}else{
			$foto = 'user_perempuan.png';
		}
			$query = "INSERT INTO tbl_admin (nip, id_sekolah, nama, jk, jabatan, hak_akses, foto) VALUES ('$id_admin', '$id_skl', '$nama_admin', '$jk', '$jabatan', '$akses', '$foto');";
			$query .= "INSERT INTO tbl_login (username, id_sekolah, password, hak_akses, status) VALUES ('$id_admin', '$id_skl','$pass', '$akses', '$status')";
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
					setTimeout("location.href='?page=admin&aksi=tambah'", 1000);
				</script>
				<?php
			}
	}	
?>