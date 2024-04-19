<?php 
// menghubungkan dengan library excel reader
require "../Config/vendor/autoload.php";

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

// upload file xls
$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$target = "excel/".$_FILES['file']['name'].".".$ext;
move_uploaded_file($_FILES['file']['tmp_name'], $target);


// mengambil isi file xls
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$spreadsheet = $reader->load($target); // Load file yang tadi diupload ke folder tmp
$sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

// jumlah default data yang berhasil di import
$berhasil = 0;
$jumlah_baris = 0;

foreach ($sheet as $data){
	$jumlah_baris++;
}

$jumlah_baris = $jumlah_baris - 1;

foreach ($sheet as $data){

	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$nis	    = $data['A'];
	$nama_siswa = $data['B'];
	$jk         = $data['C'];
	$kelas      = $data['D'];
	$pass	    = sha1("siswasmkskr@76");
	$status     = "Aktif";
	$akses      = "Siswa";
	$id_skl     = $_SESSION['sekolah'];

	if ($jk=='L') {
		$foto = 'user_laki.png';
	}else{
		$foto = 'user_perempuan.png';
	}

	if($nis == "NIS" && $nama_siswa == "Nama" && $jk == "Jenis Kelamin" && $kelas == "Kelas"){
		continue;
	} else if($nis != "" && $nama_siswa != "" && $jk != "" && $kelas != ""){
		// input data ke database (table data_pegawai)
		$query = "INSERT INTO tbl_siswa (nis, id_sekolah, nama, jk, kelas, foto) VALUES ('$nis', '$id_skl', '$nama_siswa', '$jk', '$kelas', '$foto');";
			$query .= "INSERT INTO tbl_login (username, id_sekolah, password, hak_akses, status) VALUES ('$nis', '$id_skl','$pass', '$akses', '$status')";
			$sql = $pdo->prepare($query);
			$sql->execute();

		$berhasil++;
	}
}
// hapus kembali file .xls yang di upload tadi
unlink($target);

if($berhasil == $jumlah_baris){
		?>
		<script type="text/javascript">
			alert('Data gagal tersimpan');
			//setTimeout("location.href='?page=siswa&aksi=tambahexcel'", 1000);
		</script>
		<?php
	}else{
		?>
		<script type="text/javascript">
			alert('Data telah tersimpan');
			setTimeout("location.href='?page=siswa&aksi=aktif'", 1000);
		</script>
		<?php
	}
?>