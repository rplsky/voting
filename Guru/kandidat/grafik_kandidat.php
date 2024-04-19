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
				<h3><strong>Grafik Calon Ketua OSIS</strong></h3>
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
		type: 'bar',
		data: {
			labels: [
						<?php
							$query = "SELECT * FROM tbl_calon Where id_sekolah LIKE '$id_skl'";
							$sql = $pdo->prepare($query);
							$sql->execute();
							$jml = $sql->rowCount();
							$i = 1;
							while ($data = $sql->fetch()) {
								if ($i == $jml) {
									echo '"'.$data['nama_calon'].'"';
								} else {
									echo '"'.$data['nama_calon'].'"'.',';
								}
								$i++;
							}
						?>
					],
			datasets: [{
				label: 'Persentase Suara',
				data: [
						<?php
							$query_siswa = "SELECT * FROM tbl_siswa Where id_sekolah LIKE '$id_skl'";
							$sql_siswa = $pdo->prepare($query_siswa);
							$sql_siswa->execute();
							$jml_siswa = $sql_siswa->rowCount();

							$query_calon = "SELECT * FROM tbl_calon Where id_sekolah LIKE '$id_skl'";
							$sql_calon = $pdo->prepare($query_calon);
							$sql_calon->execute();
							$jml_calon = $sql_calon->rowCount();


							while ($pilih = $sql_calon->fetch()) {
								$kandidat = $pilih['id_pil'];
								$query_vote = "SELECT * FROM tbl_vote Where id_pil = '$kandidat'";
								$sql_vote = $pdo->prepare($query_vote);
								$sql_vote->execute();
								$jml_vote = $sql_vote->rowCount();

								$hasil = ($jml_vote / $jml_siswa) * 100;
								echo $hasil.',';
							}
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
				 window.location='?page=gkandidat&aksi=aktif';
			}, 600000);
			
</script>
