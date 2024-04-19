<Aphp

	$query = "SELECT max(id_sekolah) as maxKode FROM tbl_sekolah";
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
	$char = "S-";
	$id_sekolah = $char . sprintf("%03s", $noUrut);

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

	$nama_sekolah = $_POST['nama_sekolah'];
	$alamat = $_POST['alamat'];
	$tahun_ajaran = $_POST['tahun_ajaran'];
	$status = "Y";
	$ekstensi_diperbolehkan	= array('png','jpg');
	$nama_logo = $_FILES['logo']['name'];
	$x = explode('.', $nama_logo);
	$ekstensi = strtolower(end($x));
	$ukuran	= $_FILES['logo']['size'];
	$file_tmp = $_FILES['logo']['tmp_name'];
	$logo = $id_sekolah.'.'.$ekstensi;

	$ekstensi_frame_boleh	= array('png');
	$nama_frame = $_FILES['frame']['name'];
	$y = explode('.', $nama_frame);
	$ekstensi_frame = strtolower(end($y));
	$ukuran_frame	= $_FILES['frame']['size'];
	$file_tmp_frame = $_FILES['frame']['tmp_name'];
	$frame = $id_sekolah.'.'.$ekstensi_frame;

	$nama_admin = $_POST['nama_admin'];
	$jk = $_POST['jk'];
	$akses = "Admin";
	$password = sha1("adminsmksky@22");
	$status2 = "Aktif";

	if ($jk=='') {
		?>
		<script type="text/javascript">
			alert('Jenis Kelamin belum terisi');
			setTimeout("location.href='?page=sekolah&aksi=tambah'", 1000);
		</script>
		<?php
	}else{
		if ($jk=='L') {
			$foto = 'user_laki.png';
		}else{
			$foto = 'user_perempuan.png';
		}

		if(in_array($ekstensi, $ekstensi_diperbolehkan) && in_array($ekstensi_frame, $ekstensi_frame_boleh)){
			if(($ukuran < 5044070) && ($ukuran_frame < 5044070)){
				$upload1=move_uploaded_file($file_tmp, '../Assets/img/sekolah/'.$logo);
				$upload2=move_uploaded_file($file_tmp_frame, '../Assets/img/frame/'.$frame);
				if ($upload1 && $upload2) {
					$query = "INSERT INTO tbl_sekolah (id_sekolah, nama_sekolah, alamat, tahun_ajaran, status, logo, frame) VALUES ('$id_sekolah', '$nama_sekolah', '$alamat', '$tahun_ajaran', '$status', '$logo', '$frame');";
					$query .= "INSERT INTO tbl_admin (nip, id_sekolah, nama, jk, jabatan, hak_akses, foto) VALUES ('$id_admin', '$id_sekolah', '$nama_admin', '$jk', '$akses', '$akses', '$foto');";
					$query .= "INSERT INTO tbl_login (username, id_sekolah, password, hak_akses, status) VALUES ('$id_admin', '$id_sekolah','$password', '$akses', '$status2')";
					$sql = $pdo->prepare($query);
					$sql->execute();

					if($sql){
						?>
						<script type="text/javascript">
							alert('Data telah tersimpan');
							setTimeout("location.href='?page=sekolah&aksi=aktif'", 1000);
						</script>
						<?php
					}else{
						echo $query;
						?>
						<script type="text/javascript">
							alert('Data gagal tersimpan');
							setTimeout("location.href='?page=sekolah&aksi=tambah'", 1000);
						</script>
						<?php
					}
				} else {
					?>
					<script type="text/javascript">
						alert('Data gambar gagal diupload. Silahkan turunkan resolusi gambar.');
						setTimeout("location.href='?page=sekolah&aksi=tambah'", 1000);
					</script>
					<?php
				}
			}else{
				?>
				<script type="text/javascript">
					alert('Ukuran file terlalu besar');
					setTimeout("location.href='?page=sekolah&aksi=tambah'", 1000);
				</script>
				<?php
			}
		}else{
			?>
			<script type="text/javascript">
				alert('Ekstensi file yang di upload tidak di perbolehkan');
				setTimeout("location.href='?page=sekolah&aksi=tambah'", 1000);
			</script>
			<?php
		}
	}
?>
