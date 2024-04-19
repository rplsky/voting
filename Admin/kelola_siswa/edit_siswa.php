<?php
	
	$id = $_GET['id'];
	$query = "SELECT * FROM tbl_siswa WHERE nis = '$id'";
	$sql = $pdo->prepare($query);
	$sql->execute();
	$data = $sql->fetch();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Sekolah</title>
</head>
<body>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3><strong>Edit Data Siswa</strong></h3>
	</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6" >
					<form action="?page=siswa&aksi=update" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $data['nis'];?>">
						<div class="form-group">
							<label>NIS</label>
							<input class="form-control" name="nis" required placeholder="NIS" value="<?php echo $data['nis'];?>" />
						</div>
						<div class="form-group">
							<label>Nama Siswa</label>
							<input class="form-control" name="nama_siswa" required placeholder="Nama Siswa" value="<?php echo $data['nama'];?>"/>
						</div>
						<?php
						if ($data['jk']=='L') {
							?>
							<div class="form-group">
							<label> Jenis Kelamin</label>
								<select class="form-control" name="jk">
									<option value=""> -Pilih Jenis Kelamin-</option>
									<option value="L" selected> Laki-laki</option>
									<option value="P"> Perempuan</option>
								</select>
							</div>
							<?php
						}else{
						?>
							<div class="form-group">
								<label> Jenis Kelamin</label>
									<select class="form-control" name="jk">
										<option value=""> -Pilih Jenis Kelamin-</option>
										<option value="L"> Laki-laki</option>
										<option value="P" selected> Perempuan</option>
									</select>
							</div>
							<?php
						}
						?>
						<div class="form-group">
							<label>Kelas</label>
							<input class="form-control" name="kelas" required placeholder="Kelas" value="<?php echo $data['kelas'];?>"/>
						</div>
				
						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary" style="margin-top:15px">
						<a class="btn btn-default" href="?page=siswa&aksi=aktif" style="margin-top:15px">Kembali</a>
					</form>
				</div>
			</div>
		</div>
</div>
</body>
</html>