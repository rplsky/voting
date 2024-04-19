<?php
	$id = $_POST['id_sekolah'];
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
	$logo = $id.'.'.$ekstensi;

	$ekstensi_frame_boleh	= array('png');
	$nama_frame = $_FILES['frame']['name'];
	$y = explode('.', $nama_frame);
	$ekstensi_frame = strtolower(end($y));
	$ukuran_frame	= $_FILES['frame']['size'];
	$file_tmp_frame = $_FILES['frame']['tmp_name'];
	$frame = $id.'.'.$ekstensi_frame;

	if(in_array($ekstensi, $ekstensi_diperbolehkan) && in_array($ekstensi_frame, $ekstensi_frame_boleh)){
		if(($ukuran < 5044070) && ($ukuran_frame < 5044070)){
			$upload1=move_uploaded_file($file_tmp, '../Assets/img/sekolah/'.$logo);
			$upload2=move_uploaded_file($file_tmp_frame, '../Assets/img/frame/'.$frame);
			if ($upload1 && $upload2) {
				$query = "UPDATE tbl_sekolah SET
								nama_sekolah = '$nama_sekolah',
								alamat = '$alamat',
								tahun_ajaran = '$tahun_ajaran',
								status = '$status',
								logo = '$logo',
								frame = '$frame'
								WHERE id_sekolah = '$id'";
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
						setTimeout("location.href='?page=sekolah&aksi=edit&id=<?php echo$id;?>'", 1000);
					</script>
					<?php
				}
			} else {
				?>
				<script type="text/javascript">
					alert('Data gagal diupload. Silahkan turunkan resolusi gambar.');
					setTimeout("location.href='?page=sekolah&aksi=edit&id=<?php echo$id;?>'", 1000);
				</script>
				<?php
			}
		}else{
			?>
			<script type="text/javascript">
				alert('Ukuran file terlalu besar');
				setTimeout("location.href='?page=sekolah&aksi=edit&id=<?php echo$id;?>'", 1000);
			</script>
			<?php
		}
	}else{
		?>
		<script type="text/javascript">
			alert('Ekstensi file yang di upload tidak di perbolehkan');
			setTimeout("location.href='?page=sekolah&aksi=edit&id= <?php echo$id;?>'", 1000);
		</script>
		<?php
	}
?>
