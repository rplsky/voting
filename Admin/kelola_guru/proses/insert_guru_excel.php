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
	$nip	    = $data['A'];
	$nama_guru  = $data['B'];
	$jk         = $data['C'];
	$jabatan    = $data['D'];
	$pass	    = sha1("gurusmkskr@76");
	$status     = "Aktif";
	$akses      = "Guru";
	$id_skl     = $_SESSION['sekolah'];

	if ($jk=='L') {
		$foto = 'user_laki.png';
	}else{
		$foto = 'user_perempuan.png';
	}

	if($nip == "NIP" && $nama_guru == "Nama" && $jk == "Jenis Kelamin" && $jabatan == "Pejabat"){
		continue;
	} else if($nip != "" && $nama_guru != "" && $jk != "" && $jabatan != ""){
		// input data ke database (table data_pegawai)
		$query = "INSERT INTO tbl_admin (nip, id_sekolah, nama, jk, jabatan, hak_akses, foto) VALUES ('$nip', '$id_skl', '$nama_guru', '$jk', '$jabatan', '$akses', '$foto');";
			$query .= "INSERT INTO tbl_login (username, id_sekolah, password, hak_akses, status) VALUES ('$nip', '$id_skl','$pass', '$akses', '$status')";
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
			setTimeout("location.href='?page=guru&aksi=tambahexcel'", 1000);
		</script>
		<?php
	}else{
		?>
		<script type="text/javascript">
			alert('Data telah tersimpan');
			setTimeout("location.href='?page=guru&aksi=aktif'", 1000);
		</script>
		<?php
	}
?>