<?php
	
	$id = $_GET['id'];
	$id_skl = $_SESSION['sekolah'];
	$query = "SELECT * FROM tbl_calon WHERE id_pil = '$id' AND id_sekolah = '$id_skl'";
	$sql = $pdo->prepare($query);
	$sql->execute();
	$data = $sql->fetch();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Sekolah</title>
</head>
<body>
	<div class="panel panel-default">
	<div class="panel-heading">
		<h3><strong>Edit Data</strong></h3>
	</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6" >
					<form action="?page=calon&aksi=update" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id_pil" value="<?php echo $data['id_pil'];?>">
						<div class="form-group">
							<label>Nama Calon</label>
							<input class="form-control" name="nama_calon" required placeholder="Nama Calon"  value="<?php echo $data['nama_calon'];?>"/>
						</div>
						<div class="form-group">
							<label>Kelas</label>
							<input class="form-control" name="kelas" required placeholder="Kelas"  value="<?php echo $data['kelas'];?>"/>
						</div>
						<div class="form-group">
							<label>Foto</label>
							<input class="form-control" type="file" accept="image/*" name="foto">
						</div>
						<input type="submit" name="update" value="Update" class="btn btn-primary" style="margin-top:15px">
						<a class="btn btn-default" href="?page=calon&aksi=aktif" style="margin-top:15px">Kembali</a>
					</form>
				</div>
			</div>
		</div>
</div>
</body>
</html>