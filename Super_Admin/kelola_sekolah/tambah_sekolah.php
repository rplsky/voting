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
					<form action="?page=sekolah&aksi=insert" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>Nama Sekolah</label>
							<input class="form-control" name="nama_sekolah" required placeholder="Nama Sekolah" />
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<textarea class="form-control" cols="10" rows="5" name="alamat" required placeholder="Alamat"></textarea>
						</div>
						<div class="form-group">
							<label>Tahun Ajaran</label>
							<input class="form-control" name="tahun_ajaran" required placeholder="Tahun Ajaran" />
						</div>
						<div class="form-group">
							<label>Nama Admin</label>
							<input class="form-control" name="nama_admin" required placeholder="Nama Admin" />
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
							<label>Logo Sekolah</label>
							<input class="form-control" type="file" accept="image/*" name="logo">
						</div>
						<div class="form-group">
							<label>Frame Sekolah</label>
							<input class="form-control" type="file" accept="image/*" name="frame">
						</div>
						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary" style="margin-top:15px">
						<a class="btn btn-default" href="?page=sekolah&aksi=aktif" style="margin-top:15px">Kembali</a>
					</form>
				</div>
			</div>
		</div>
</div>
</body>
</html>