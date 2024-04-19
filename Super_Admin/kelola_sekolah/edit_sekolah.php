<?php
	
	$id = $_GET['id'];
	$query = "SELECT * FROM tbl_sekolah WHERE id_sekolah = '$id'";
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
					<form action="?page=sekolah&aksi=update" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id_sekolah" value="<?php echo $data['id_sekolah'];?>">
						<div class="form-group">
							<label>Nama Sekolah</label>
							<input class="form-control" name="nama_sekolah" required placeholder="Nama Sekolah"  value="<?php echo $data['nama_sekolah'];?>"/>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<textarea class="form-control" cols="10" rows="5" name="alamat" required placeholder="Alamat"><?php echo $data['alamat'];?></textarea>
						</div>
						<div class="form-group">
							<label>Tahun Ajaran</label>
							<input class="form-control" name="tahun_ajaran" required placeholder="Tahun Ajaran"  value="<?php echo $data['tahun_ajaran'];?>"/>
						</div>
						<div class="form-group">
							<label>Logo Sekolah</label>
							<input class="form-control" type="file" accept="image/*" name="logo">
						</div>
						<div class="form-group">
							<label>Frame Sekolah</label>
							<input class="form-control" type="file" accept="image/*" name="frame">
						</div>
						<input type="submit" name="update" value="Update" class="btn btn-primary" style="margin-top:15px">
						<a class="btn btn-default" href="?page=sekolah&aksi=aktif" style="margin-top:15px">Kembali</a>
					</form>
				</div>
			</div>
		</div>
</div>
</body>
</html>