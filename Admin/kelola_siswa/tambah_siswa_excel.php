<!DOCTYPE html>
<html>
<head>
	<title>Tambah Sekolah</title>
</head>
<body>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3><strong>Import Data Siswa</strong> <a class="btn btn-success" href="../Assets/excel/format_siswa.xlsx">Download Format Excel</a></h3>
	</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6" >
					<form action="?page=siswa&aksi=insert_excel" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>File</label>
							<input type="file" class="form-control" name="file" required placeholder="File" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
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
