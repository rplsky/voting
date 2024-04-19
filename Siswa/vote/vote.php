<?php
	$id_siswa = $_SESSION['username'];
	$query = "SELECT * FROM tbl_vote Where nis LIKE '$id_siswa'";
	$sql = $pdo->prepare($query);
	$sql->execute();
	$jml = $sql->rowCount();

	if ($jml==0) {
?>
		<div class="panel panel-default">
			<div class="panel-heading">
						<h3><strong>Vote Ketua OSIS</strong></h3>
					</div>
						<div class="panel-body">
							<div class="row">
								<div class="table-responsive">
								<table class="table table-striped">
									<form action="?page=vote&aksi=vote" method="POST">
									<tbody>
									<tr>
									<?php
										$id_skl = $_SESSION['sekolah'];

										$query_siswa = "SELECT * FROM tbl_siswa Where nis LIKE '$id_siswa'";
										$sql_siswa = $pdo->prepare($query_siswa);
										$sql_siswa->execute();
										$data_siswa = $sql_siswa->fetch();

										$query = "SELECT * FROM tbl_calon Where id_sekolah LIKE '$id_skl' AND status = 'Y'";
										$sql = $pdo->prepare($query);
										$sql->execute();
										$i = 1;
										while($data = $sql->fetch()){
									?>
									<input type="hidden" name="kelas" value="<?php echo $data_siswa['kelas'];?>">	
									<td>
										<div class="col-md-12" >
											<div align="center">
												<div class="card" style="width: 18rem;">
													<img src="../Assets/img/calon/<?php echo $data['foto'];?>" class="card-img-top" alt="..." height="200px" width="150px">
													<div class="card-body">
														<h5 class="card-title"><?php echo $i.'. '. $data['nama_calon'].' | '.$data['kelas'];?></h5>
														<div align="center"><input type="radio" value="<?php echo $data['id_pil'];?>" name="pilihan"></div>
													</div>
												</div>	
											</div>
										</div>
									</td>
									<?php
										$i++;
									}
									?>
								</tr>
								<tr>
									<td colspan="5">
										<div align="center">
											<input type="submit" name="vote" value="Vote" class="btn btn-primary" style="margin-top:15px">
										</div>
									</td>
								</tr>
							</tbody>
							</form>
							</table>
						</div>
					</div>
				</div>
		</div>
	<?php
	} else {
		?>
		<script type="text/javascript">
			alert('Anda sudah melakukan vote');
			setTimeout("location.href='?page=beranda&aksi=aktif'", 1000);
		</script>
		<?php
	}
	?>