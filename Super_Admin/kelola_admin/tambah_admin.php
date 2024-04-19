<!DOCTYPE html>
<html>
<head>
	<title>Tambah Sekolah</title>
</head>
<body>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3><strong>Tambah Data Admin</strong></h3>
	</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6" >
					<form action="?page=admin&aksi=insert" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label> Nama Sekolah</label>
								<select class="form-control" name="sekolah">
									<option value=""> -Pilih Sekolah-</option>
									<?php
										$query = 'SELECT * FROM tbl_sekolah';
										$sql = $pdo->prepare($query);
										$sql->execute();

										while($data = $sql->fetch()){
											
									?>
									
									<option value="<?php echo $data['id_sekolah'];?>"> <?php echo $data['nama_sekolah'];?></option>
									<?php
									}
									?>
								</select>
						</div>
						<div class="form-group">
							<label>Nama admin</label>
							<input class="form-control" name="nama_admin" required placeholder="Nama admin" />
						</div>
						<div class="form-group">
							<label> Jenis Kelamin</label>
								<select class="form-control" name="jk">
									<option value=""> -Pilih Jenis Kelamin-</option>
									<option value="L"> Laki-laki</option>
									<option value="P"> Perempuan</option>
								</select>
						</div>
						<div class="form-group">
							<label>Jabatan</label>
							<input class="form-control" name="jabatan" required placeholder="Jabatan" />
						</div>
				
						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary" style="margin-top:15px">
						<a class="btn btn-default" href="?page=admin&aksi=aktif" style="margin-top:15px">Kembali</a>
					</form>
				</div>
			</div>
		</div>
</div>
</body>
</html>