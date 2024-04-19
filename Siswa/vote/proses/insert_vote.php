<?php
	$id_skl = $_SESSION['sekolah'];
	$nis = $_SESSION['username'];
	$pilihan = $_POST['pilihan'];
	$kelas = $_POST['kelas'];
	$status = "Y";

	$query_calon = "SELECT * FROM tbl_calon Where id_pil = '$pilihan'";
	$sql_calon = $pdo->prepare($query_calon);
	$sql_calon->execute();
	$data_calon = $sql_calon->fetch();
	$calon = $data_calon['nama_calon']." | ".$data_calon['kelas'];
	echo $query_calon;
				
	$query_siswa = "SELECT * FROM tbl_siswa Where nis = '$nis'";
	$sql_siswa = $pdo->prepare($query_siswa);
	$sql_siswa->execute();
	$data_siswa = $sql_siswa->fetch();
	$nama_siswa = $data_siswa['nama'];

	$query = "INSERT INTO tbl_vote (nis, kelas, id_pil, id_sekolah, status) VALUES ('$nis','$kelas', '$pilihan', '$id_skl','$status');";
	$query .= "UPDATE tbl_siswa SET 
			   						status = '$status'
			   						Where nis = '$nis'";
	$sql = $pdo->prepare($query);
	$sql->execute();
	
			if($sql){
				
				$bot = "bot5819155909:AAEH5lnEfco3-a7agGhgagRTS1XOX3lHRg4";
				$user = "976626912";
				$pesan = "Telah Vote Memilih dari School Voting dengan data NIS : <b>$nis</b> Nama Siswa : <b>$nama_siswa</b> Kelas : <b>$kelas</b> Pilihan : <b>$calon</b>. Terimakasih Telah Memilih.";
				
				KirimTelegram($pesan, $bot, $user);

				?>
				<script type="text/javascript">
					alert('Data telah tersimpan. Terima kasih atas partisipasi anda.');
					//setTimeout("location.href='?page=vote&aksi=tambahfoto'", 1000);
					setTimeout("location.href='?page=beranda&aksi=aktif'", 1000);
				</script>
				<?php
			}else{
				echo $query;
				?>
				<script type="text/javascript">
					alert('Data gagal tersimpan');
					setTimeout("location.href='?page=vote&aksi=aktif'", 1000);
				</script>
				<?php
			}
?>