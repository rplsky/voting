<!DOCTYPE html>
<html>
<head>
	<title>Tambah Sekolah</title>
</head>
<body>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3><strong>Tambah Data Foto</strong></h3>
	</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6" >
					<form action="?page=frame&aksi=upload" method="POST" enctype="multipart/form-data">
						
						<div class="form-group">
							<label>Foto</label>
							<input class="form-control" type="file" accept="image/*" name="foto">
						</div>

						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary" style="margin-top:15px">
					</form>
				</div>
			</div>
		</div>
</div>
</body>
</html>