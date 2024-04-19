<?php

	function rndRGBColorCode()
	{
		return 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ', 0.8 )'; #using the inbuilt random function
	}

	$warna = rndRGBColorCode();

	$sekolah = $_SESSION['sekolah'];
	$query = "SELECT * FROM tbl_calon Where id_sekolah = '$sekolah'";
	$sql = $pdo->prepare($query);
	$sql->execute();
	$data = $sql->fetch();
	$jml = $sql->rowCount();
	 
	$jml++;
	 
	// membentuk kode anggota baru
	// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
	// misal sprintf("%03s", 12); maka akan dihasilkan '012'
	// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
	$id_pil = $sekolah ."-". sprintf("%03s", $jml);

	$nama_calon = $_POST['nama_calon'];
	$kelas = $_POST['kelas'];
	$status = "Y";
	$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
	$nama_foto = $_FILES['foto']['name'];
	$x = explode('.', $nama_foto);
	$ekstensi = strtolower(end($x));
	$ukuran	= $_FILES['foto']['size'];
	$file_tmp = $_FILES['foto']['tmp_name'];
	$foto = $id_pil.'.'.$ekstensi;

	if ($jml <= 10) {
		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			if($ukuran < 5044070){
				$upload = move_uploaded_file($file_tmp, '../assets/img/calon/'.$foto);
				if ($upload) {
					$query = "INSERT INTO tbl_calon (id_pil, id_sekolah, nama_calon, kelas, status, foto, warna) VALUES ('$id_pil','$sekolah', '$nama_calon', '$kelas', '$status', '$foto', '$warna')";
					$sql = $pdo->prepare($query);
					$sql->execute();

					if($sql){
						?>
						<script type="text/javascript">
							alert('Data telah tersimpan');
							setTimeout("location.href='?page=calon&aksi=aktif'", 1000);
						</script>
						<?php
					}else{
						echo $query;
						?>
						<script type="text/javascript">
							alert('Data gagal tersimpan');
							setTimeout("location.href='?page=calon&aksi=tambah'", 1000);
						</script>
						<?php
					}
				} else {
					?>
					<script type="text/javascript">
						alert('Data gambar gagal diupload. Silahkan turunkan resolusi gambar.');
						setTimeout("location.href='?page=calon&aksi=tambah'", 1000);
					</script>
					<?php
				}	
			}else{
				?>
				<script type="text/javascript">
					alert('Ukuran file terlalu besar');
					setTimeout("location.href='?page=calon&aksi=tambah'", 1000);
				</script>
				<?php
			}
		}else{
			?>
			<script type="text/javascript">
				alert('Ekstensi file yang di upload tidak di perbolehkan');
				setTimeout("location.href='?page=calon&aksi=tambah'", 1000);
			</script>
			<?php
		}
	} else {
		?>
		<script type="text/javascript">
			alert('Sudah lebih dari 4 kandidat ketua OSIS');
			setTimeout("location.href='?page=calon&aksi=tambah'", 1000);
		</script>
		<?php
	}	
?>