<?php
	
	$id = $_GET['id'];
	$query = "SELECT * FROM tbl_admin WHERE nip = '$id'";
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
		<h3><strong>Edit Data Guru</strong></h3>
	</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6" >
					<form action="?page=guru&aksi=update" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $data['nip'];?>">
						<div class="form-group">
							<label>NIP</label>
							<input class="form-control" name="nip" required placeholder="NIP" value="<?php echo $data['nip'];?>" />
						</div>
						<div class="form-group">
							<label>Nama Guru</label>
							<input class="form-control" name="nama_guru" required placeholder="Nama Guru" value="<?php echo $data['nama'];?>"/>
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
							<label>Jabatan</label>
							<input class="form-control" name="jabatan" required placeholder="Jabatan" value="<?php echo $data['jabatan'];?>"/>
						</div>
				
						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary" style="margin-top:15px">
						<a class="btn btn-default" href="?page=guru&aksi=aktif" style="margin-top:15px">Kembali</a>
					</form>
				</div>
			</div>
		</div>
</div>
</body>
</html>