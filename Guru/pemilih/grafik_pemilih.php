<?php
	$id_skl = $_SESSION['sekolah'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Calon Ketua OSIS</title>
</head>
<body>
<div class="panel panel-default">
	<div class="panel-heading">
				<h3><strong>Grafik Pemilih Ketua OSIS </strong> <a class="btn btn-primary" href="?page=pemilih&aksi=pemilihsudah">Data Sudah Memilih</a> <a class="btn btn-danger" href="?page=pemilih&aksi=pemilihbelum">Data Belum Memilih</a> </h3>
			</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12" >
							<div class="table-responsive">
								<div style="width: 800px;margin: 0px auto;">
									<canvas id="myChart"></canvas>
								</div>
									<div align="center">
										<h2>
										<?php
											$query_vote = "SELECT * FROM tbl_vote";
											$sql_vote = $pdo->prepare($query_vote);
											$sql_vote->execute();
											$jml_vote = $sql_vote->rowCount();
											echo "Jumlah Voting Masuk : ".$jml_vote." Orang";
										?>
										</h2>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
</body>
</html>

<script>
	var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'pie',
		data: {
			labels: [
						"Sudah Memilih", "Belum Memilih"
					],
			datasets: [{
				label: '',
				data: [
						<?php
						$query_siswa = "SELECT * FROM tbl_siswa Where id_sekolah LIKE '$id_skl'";
						$sql_siswa = $pdo->prepare($query_siswa);
						$sql_siswa->execute();
						$jml_siswa = $sql_siswa->rowCount();

						$query_sudah = "SELECT * FROM tbl_siswa Where id_sekolah LIKE '$id_skl' AND status LIKE 'Y'";
						$sql_sudah = $pdo->prepare($query_sudah);
						$sql_sudah->execute();
						$jml_sudah = $sql_sudah->rowCount();
						$hasil = ($jml_sudah / $jml_siswa) * 100;
						echo $hasil.',';

						$query_belum = "SELECT * FROM tbl_siswa Where id_sekolah LIKE '$id_skl' AND status LIKE 'T'";
						$sql_belum = $pdo->prepare($query_belum);
						$sql_belum->execute();
						$jml_belum = $sql_belum->rowCount();
						$hasil = ($jml_belum / $jml_siswa) * 100;
						echo $hasil;
						?>
					],
				backgroundColor: [
									'rgba(255, 99, 132, 0.2)',
									'rgba(128, 0, 128, 0.2)',
									'rgba(255, 206, 86, 0.2)',
									'rgba(75, 192, 192, 0.2)'
								],
				borderColor: [
									'rgba(255, 99, 132, 1)',
									'rgba(128, 0, 128, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(75, 192, 192, 1)'
							],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});

	var auto_refresh = setInterval(
			function () {
				 window.location='?page=pemilih&aksi=aktif';
				 clearInterval(auto_refresh);
			}, 600000);

</script>
