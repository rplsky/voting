<!DOCTYPE html>
<html>
<head>
	<title>Tambah Sekolah</title>
</head>
<body>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3><strong>Tambah Data</strong></h3>
	</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6" >
					<form action="?page=calon&aksi=insert" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>Nama Calon</label>
							<input class="form-control" name="nama_calon" required placeholder="Nama Calon" />
						</div>
						<div class="form-group">
							<label>Kelas</label>
							<input class="form-control" name="kelas" required placeholder="Kelas" />
						</div>
						<div class="form-group">
							<label>Foto</label>
							<input class="form-control" type="file" accept="image/*" name="foto">
						</div>

						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary" style="margin-top:15px">
						<a class="btn btn-default" href="?page=calon&aksi=aktif" style="margin-top:15px">Kembali</a>
					</form>
				</div>
			</div>
		</div>
</div>
</body>
</html>