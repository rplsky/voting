<!DOCTYPE html>
<html>
<head>
	<title>Tambah Sekolah</title>
</head>
<body>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3><strong>Tambah Data Siswa</strong></h3>
	</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6" >
					<form action="?page=siswa&aksi=insert" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>NIS</label>
							<input class="form-control" name="nis" required placeholder="NIS" />
						</div>
						<div class="form-group">
							<label>Nama Siswa</label>
							<input class="form-control" name="nama_siswa" required placeholder="Nama Siswa" />
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
							<label>Kelas</label>
							<input class="form-control" name="kelas" required placeholder="Kelas" />
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