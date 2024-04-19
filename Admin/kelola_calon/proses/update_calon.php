<?php
	$id_skl = $_SESSION['sekolah'];
	$id = $_POST['id_pil'];
	$nama_calon = $_POST['nama_calon'];
	$kelas = $_POST['kelas'];
	$status = "Y";
	$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
	$nama_foto = $_FILES['foto']['name'];
	$x = explode('.', $nama_foto);
	$ekstensi = strtolower(end($x));
	$ukuran	= $_FILES['foto']['size'];
	$file_tmp = $_FILES['foto']['tmp_name'];
	$foto = $id.'.'.$ekstensi;

	if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
		if($ukuran < 5044070){
			$upload = move_uploaded_file($file_tmp, '../assets/img/calon/'.$foto);
			if ($upload) {
				$query = "UPDATE tbl_calon SET  
									nama_calon = '$nama_calon',
									kelas = '$kelas', 
									status = '$status',
									foto = '$foto'
									WHERE id_pil = '$id'";
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
						setTimeout("location.href='?page=calon&aksi=edit&id= <?php echo$id;?>'", 1000);
					</script>
					<?php
				}
			} else {
				?>
				<script type="text/javascript">
					alert('Data gambar gagal diupload. Silahkan turunkan resolusi gambar.');
					setTimeout("location.href='?page=calon&aksi=edit&id= <?php echo$id;?>'", 1000);
				</script>
				<?php
			}
		}else{
			?>
			<script type="text/javascript">
				alert('Ukuran file terlalu besar');
				setTimeout("location.href='?page=calon&aksi=edit&id= <?php echo$id;?>'", 1000);
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
?>