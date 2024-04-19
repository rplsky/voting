<?php
	$id_skl = $_SESSION['sekolah'];
	$hal = (isset($_GET['hal']))? $_GET['hal'] : 1;
					
	$limit = 5; // Jumlah data per halamannya
					
	// Untuk menentukan dari data ke berapa yang akan ditampilkan pada tabel yang ada di database
	$limit_start = ($hal - 1) * $limit;

	$query = "SELECT DISTINCT kelas FROM tbl_siswa Where id_sekolah LIKE '$id_skl' ORDER BY kelas LIMIT $limit_start, $limit";
	$sql = $pdo->prepare($query);
	$sql->execute();

	function rndRGBColorCode()
	{
		return 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')'; #using the inbuilt random function
	}

	$rndcolor = rndRGBColorCode(); #function call

	//echo $rndcolor;
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Sekolah</title>
</head>
<body>

<div class="panel panel-default">
	<div class="panel-heading">
				<h3>
					<strong>Grafik Persentase Kelas Pemilihan OSIS</strong>
					<a class="btn btn-primary" href="?page=pemilih&aksi=aktif">Kembali Ke Grafik Pemilih</a>
				</h3>
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
							$query_kelas = "SELECT DISTINCT kelas FROM tbl_siswa Where id_sekolah LIKE '$id_skl' ORDER BY kelas";
							$sql_kelas = $pdo->prepare($query_kelas);
							$sql_kelas->execute();
							$jml_kelas = $sql_kelas->rowCount();
							$i = 1;
							while ($data_kelas = $sql_kelas->fetch()) {
								if ($i == $jml_kelas) {
									echo '"'.$data_kelas['kelas'].'"';
								} else {
									echo '"'.$data_kelas['kelas'].'"'.',';
								}
								$i++;
							}
						?>
					],
			datasets: [
				<?php
					$query_calon_grafik = "SELECT * FROM tbl_calon Where id_sekolah LIKE '$id_skl'";
					$sql_calon_grafik = $pdo->prepare($query_calon_grafik);
					$sql_calon_grafik->execute();
					$jml_calon_grafik = $sql_calon_grafik->rowCount();

					$a = 1;

					while ($kandidat_grafik = $sql_calon_grafik->fetch()) {

						$rndcolor = $kandidat_grafik['warna'];

						if ($a < $jml_calon_grafik) {
							?>
								{
									label: '<?php echo $a.'. '. $kandidat_grafik['nama_calon'].' | '.$kandidat_grafik['kelas'];?>',
									data: [
											<?php
												$rndcolor = $kandidat_grafik['warna'];
												$query_siswa_grafik = "SELECT * FROM tbl_siswa Where id_sekolah LIKE '$id_skl'";
												$sql_siswa_grafik = $pdo->prepare($query_siswa_grafik);
												$sql_siswa_grafik->execute();
												$jml_siswa_grafik = $sql_siswa_grafik->rowCount();

												$query_kelas2 = "SELECT DISTINCT kelas FROM tbl_siswa Where id_sekolah LIKE '$id_skl' ORDER BY kelas";
												$sql_kelas2 = $pdo->prepare($query_kelas2);
												$sql_kelas2->execute();
												$jml_kelas2 = $sql_kelas2->rowCount();

												$j = 1;

												while ($kelas2 = $sql_kelas2->fetch()) {
				
													if ($j < $jml_kelas2) {
														$kls = $kelas2['kelas'];
														$k_grafik = $kandidat_grafik['id_pil'];
														$query_vote_grafik = "SELECT * FROM tbl_vote INNER JOIN tbl_siswa ON tbl_vote.kelas = tbl_siswa.kelas Where tbl_vote.id_pil = '$k_grafik' AND tbl_siswa.status = 'Y' AND tbl_vote.kelas = '$kls'";
														$sql_vote_grafik = $pdo->prepare($query_vote_grafik);
														$sql_vote_grafik->execute();
														$jml_vote_grafik = $sql_vote_grafik->rowCount();

														$hasil_grafik = ($jml_vote_grafik / $jml_siswa_grafik) * 100;
														echo number_format($hasil_grafik,2).',';
													} else {
														$kls = $kelas2['kelas'];
														$k_grafik = $kandidat_grafik['id_pil'];
														$query_vote_grafik = "SELECT * FROM tbl_vote INNER JOIN tbl_siswa ON tbl_vote.kelas = tbl_siswa.kelas Where tbl_vote.id_pil = '$k_grafik' AND tbl_siswa.status = 'Y' AND tbl_vote.kelas = '$kls'";
														$sql_vote_grafik = $pdo->prepare($query_vote_grafik);
														$sql_vote_grafik->execute();
														$jml_vote_grafik = $sql_vote_grafik->rowCount();

														$hasil_grafik = ($jml_vote_grafik / $jml_siswa_grafik) * 100;
														echo number_format($hasil_grafik,2);
													}
													$j++;
												}
											?>
										],
									backgroundColor: [
														
																'<?php echo $rndcolor; ?>',
														
													],
									borderColor: [
																'<?php echo $rndcolor; ?>',
												],
									borderWidth: 1
								},
							<?php
							$a++;
						} else {
							$rndcolor = $rndcolor = $kandidat_grafik['warna'];
							?>
								{
									label: '<?php echo $a.'. '. $kandidat_grafik['nama_calon'].' | '.$kandidat_grafik['kelas'];?>',
									data: [
											<?php
												$rndcolor = $kandidat_grafik['warna'];
												$query_siswa_grafik = "SELECT * FROM tbl_siswa Where id_sekolah LIKE '$id_skl'";
												$sql_siswa_grafik = $pdo->prepare($query_siswa_grafik);
												$sql_siswa_grafik->execute();
												$jml_siswa_grafik = $sql_siswa_grafik->rowCount();

												$query_kelas2 = "SELECT DISTINCT kelas FROM tbl_siswa Where id_sekolah LIKE '$id_skl' ORDER BY kelas";
												$sql_kelas2 = $pdo->prepare($query_kelas2);
												$sql_kelas2->execute();
												$jml_kelas2 = $sql_kelas2->rowCount();

												$j = 1;

												while ($kelas2 = $sql_kelas2->fetch()) {
													if ($j < $jml_kelas2) {
														$kls = $kelas2['kelas'];
														$k_grafik = $kandidat_grafik['id_pil'];
														$query_vote_grafik = "SELECT * FROM tbl_vote Where id_pil = '$k_grafik' AND id_sekolah = '$id_skl' AND kelas = '$kls'";
														$sql_vote_grafik = $pdo->prepare($query_vote_grafik);
														$sql_vote_grafik->execute();
														$jml_vote_grafik = $sql_vote_grafik->rowCount();

														$hasil_grafik = ($jml_vote_grafik / $jml_siswa_grafik) * 100;
														echo number_format($hasil_grafik,2).',';
													} else {
														$kls = $kelas2['kelas'];
														$k_grafik = $kandidat_grafik['id_pil'];
														$query_vote_grafik = "SELECT * FROM tbl_vote Where id_pil = '$k_grafik' AND id_sekolah = '$id_skl' AND kelas = '$kls'";
														$sql_vote_grafik = $pdo->prepare($query_vote_grafik);
														$sql_vote_grafik->execute();
														$jml_vote_grafik = $sql_vote_grafik->rowCount();

														$hasil_grafik = ($jml_vote_grafik / $jml_siswa_grafik) * 100;
														echo number_format($hasil_grafik,2);
													}
													$j++;
														
												}
											?>
										],
										backgroundColor: [
														
														'<?php echo $rndcolor; ?>',
												
											],
									borderColor: [
														'<?php echo $rndcolor; ?>',
												],
									borderWidth: 1
								}
							<?php
							$a++;
						}
						
					}
				?>
		]
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
				 window.location='?page=pemilih&aksi=pemilihkelas';
				 clearInterval(auto_refresh);
			}, 600000);
</script>

<div class="panel panel-default">
	<div class="panel-heading">
				<h3><strong>Data Kelas Memilih <a class="btn btn-info" href="pemilih/export_kelas.php">Export Data</a></strong></h3>
			</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12" >
							<div class="table-responsive">
								<table class="table table-striped">
						<thead>
							<tr>
								<?php
									$query_calon2 = "SELECT * FROM tbl_calon Where id_sekolah LIKE '$id_skl' AND status = 'Y'";
									$sql_calon2 = $pdo->prepare($query_calon2);
									$sql_calon2->execute();
									$jml_calon2 = $sql_calon2->rowCount();
								?>
								<th rowspan="2"><h3>Kelas</h3></th>
								<th colspan="<?php echo $jml_calon2; ?>"><div align="center">Jumlah Suara</div></th>
							</tr>
							<tr>
								<?php
										$id_skl = $_SESSION['sekolah'];

										$query_calon = "SELECT * FROM tbl_calon Where id_sekolah LIKE '$id_skl' AND status = 'Y'";
										$sql_calon = $pdo->prepare($query_calon);
										$sql_calon->execute();
										$i = 1;
										while($data_calon = $sql_calon->fetch()){
									    ?>
                                            <th><div align='center'><?php echo $i.'. '. $data_calon['nama_calon'].' | '.$data_calon['kelas'];?></div></th>
                                    <?php
                                            $i++;
                                        }
                                    ?>
							</tr>
						</thead>
						<?php
							while($data = $sql->fetch()){
								?>
								<tbody>
									<tr>
										<td><?php echo $data['kelas'];?></td>
										<?php
                                            $query_siswa = "SELECT * FROM tbl_siswa Where id_sekolah LIKE '$id_skl' AND kelas LIKE '$data[kelas]'";
                                            $sql_siswa = $pdo->prepare($query_siswa);
                                            $sql_siswa->execute();
                                            $jml_siswa = $sql_siswa->rowCount();

                                            $query_calon = "SELECT * FROM tbl_calon Where id_sekolah LIKE '$id_skl'";
                                            $sql_calon = $pdo->prepare($query_calon);
                                            $sql_calon->execute();
                                            $jml_calon = $sql_calon->rowCount();


                                            while ($pilih = $sql_calon->fetch()) {
                                                $kandidat = $pilih['id_pil'];
                                                $query_vote = "SELECT * FROM tbl_vote Where id_pil = '$kandidat' AND id_sekolah = '$id_skl' AND kelas = '$data[kelas]'";
                                                $sql_vote = $pdo->prepare($query_vote);
                                                $sql_vote->execute();
                                                $jml_vote = $sql_vote->rowCount();

                                                echo "<td> <div align='center'>".$jml_vote."</div></td>";
                                            }
                                        ?>
									</tr>
								</tbody>
								<?php
							}
						?>	

						</table>	
				</div>
			</div>
		</div>
		<ul class="pagination">
				<!-- LINK FIRST AND PREV -->
				<?php
				if($hal == 1){ // Jika hal adalah hal ke 1, maka disable link PREV
				?>
					<li class="disabled"><a href="#">First</a></li>
					<li class="disabled"><a href="#">&laquo;</a></li>
				<?php
				}else{ // Jika hal bukan hal ke 1
					$link_prev = ($hal > 1)? $hal - 1 : 1;
				?>
					<li><a href="?page=pemilih&aksi=pemilihkelas&hal=1">First</a></li>
					<li><a href="?page=pemilih&aksi=pemilihkelas&hal=<?php echo $link_prev; ?>">&laquo;</a></li>
				<?php
				}
				?>
				
				<!-- LINK NUMBER -->
				<?php
				// Buat query untuk menghitung semua jumlah data
				$sql2 = $pdo->prepare("SELECT COUNT(DISTINCT kelas) AS jumlah FROM tbl_siswa Where id_sekolah LIKE '$id_skl' ORDER BY kelas");
				$sql2->execute(); // Eksekusi querynya
				$get_jumlah = $sql2->fetch();
				
				$jumlah_hal = ceil($get_jumlah['jumlah'] / $limit); // Hitung jumlah halamannya
				$jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah hal yang aktif
				$start_number = ($hal > $jumlah_number)? $hal - $jumlah_number : 1; // Untuk awal link number
				$end_number = ($hal < ($jumlah_hal - $jumlah_number))? $hal + $jumlah_number : $jumlah_hal; // Untuk akhir link number
				
				for($i = $start_number; $i <= $end_number; $i++){
					$link_active = ($hal == $i)? ' class="active"' : '';
				?>
					<li<?php echo $link_active; ?>><a href="?page=pemilih&aksi=pemilihkelas&hal=<?php echo $i; ?>"><?php echo $i; ?></a></li>
				<?php
				}
				?>
				
				<!-- LINK NEXT AND LAST -->
				<?php
				// Jika hal sama dengan jumlah hal, maka disable link NEXT nya
				// Artinya hal tersebut adalah hal terakhir 
				if($hal == $jumlah_hal){ // Jika hal terakhir
				?>
					<li class="disabled"><a href="#">&raquo;</a></li>
					<li class="disabled"><a href="#">Last</a></li>
				<?php
				}else{ // Jika Bukan hal terakhir
					$link_next = ($hal < $jumlah_hal)? $hal + 1 : $jumlah_hal;
				?>
					<li><a href="?page=pemilih&aksi=pemilihkelas&hal=<?php echo $link_next; ?>">&raquo;</a></li>
					<li><a href="?page=pemilih&aksi=pemilihkelas&hal=<?php echo $jumlah_hal; ?>">Last</a></li>
				<?php
				}
				?>
			</ul>
	</div>
</div>
</body>
</html>