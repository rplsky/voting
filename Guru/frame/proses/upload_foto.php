<?php

	$nis = $_SESSION['username'];
	$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
	$nama_foto = $_FILES['foto']['name'];
	$x = explode('.', $nama_foto);
	$ekstensi = strtolower(end($x));
	$ukuran	= $_FILES['foto']['size'];
	$file_tmp = $_FILES['foto']['tmp_name'];
	$foto = $nis.'.jpg';

	if(in_array($ekstensi, $ekstensi_diperbolehkan) == true){
		if($ukuran < 5044070){
			$upload = move_uploaded_file($file_tmp, '../Assets/img/foto/'.$foto);
			if ($upload) {
				?>
				<script type="text/javascript">
					alert('Data telah tersimpan');
					setTimeout("location.href='?page=frame&aksi=hasilfoto'", 1000);
				</script>
				<?php
			} else {
				?>
				<script type="text/javascript">
					alert('Data gagal diupload. Silahkan turunkan resolusi gambar.');
					setTimeout("location.href='?page=frame&aksi=tambahfoto'", 1000);
				</script>
				<?php
			}
		}else{
			?>
			<script type="text/javascript">
				alert('Ukuran file terlalu besar');
				setTimeout("location.href='?page=frame&aksi=tambahfoto'", 1000);
			</script>
			<?php
		}
	}else{
		?>
		<script type="text/javascript">
			alert('Ekstensi file yang di upload tidak di perbolehkan');
			setTimeout("location.href='?page=frame&aksi=tambahfoto'", 1000);
		</script>
		<?php
	}
?>
