<?php
	$id_skl = $_SESSION['sekolah'];

	function rndRGBColorCode()
	{
		return 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')'; #using the inbuilt random function
	}
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
								<div style="width: 100%;margin: 0px auto;">
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

											$query_siswa = "SELECT * FROM tbl_siswa";
											$sql_siswa = $pdo->prepare($query_siswa);
											$sql_siswa->execute();
											$jml_siswa = $sql_siswa->rowCount();
											echo "<br>Total Siswa : ".$jml_siswa." Orang";
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
								$rndcolor = rndRGBColorCode(); #function call
								$kandidat = $pilih['id_pil'];
								$query_vote = "SELECT * FROM tbl_vote Where id_pil = '$kandidat'";
								$sql_vote = $pdo->prepare($query_vote);
								$sql_vote->execute();
								$jml_vote = $sql_vote->rowCount();

								$hasil = ($jml_vote / $jml_siswa) * 100;
								echo number_format($hasil,2).',';
							}
						?>
					],
				backgroundColor: [
									<?php	
										$query_warna = "SELECT * FROM tbl_calon Where id_sekolah LIKE '$id_skl'";
										$sql_warna = $pdo->prepare($query_warna);
										$sql_warna->execute();

										while ($warna = $sql_warna->fetch()) {
											echo "' ". $warna['warna'] . " ',";
										}
									?>
								],
				borderColor: [
								<?php	
										$query_warna = "SELECT * FROM tbl_calon Where id_sekolah LIKE '$id_skl'";
										$sql_warna = $pdo->prepare($query_warna);
										$sql_warna->execute();

										while ($warna = $sql_warna->fetch()) {
											echo "' ". $warna['warna'] . " ',";
										}
									?>
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
				 clearInterval(auto_refresh);
			}, 600000);
</script>
