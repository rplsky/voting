<?php
	$hal = (isset($_GET['hal']))? $_GET['hal'] : 1;

	$limit = 5; // Jumlah data per halamannya

	// Untuk menentukan dari data ke berapa yang akan ditampilkan pada tabel yang ada di database
	$limit_start = ($hal - 1) * $limit;

	$id_skl = $_SESSION['sekolah'];

	$query = "SELECT * FROM tbl_calon Where id_sekolah LIKE '$id_skl' LIMIT $limit_start,$limit";
	$sql = $pdo->prepare($query);
	$sql->execute();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Calon Ketua OSIS</title>
</head>
<body>
<div class="panel panel-default">
	<div class="panel-heading">
				<h3><strong>Data Calon Ketua OSIS</strong> <a class="btn btn-primary" href="?page=calon&aksi=tambah">Tambah</a></h3>
			</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12" >
							<div class="table-responsive">
								<table class="table table-striped">
						<thead>
							<tr>
								<th>Foto</th>
								<th>Id calon</th>
								<th>Nama calon</th>
								<th>Kelas</th>
								<th>Status</th>
								<th colspan="2">Aksi</th>
							</tr>
						</thead>
						<?php
							while($data = $sql->fetch()){
								?>
								<tbody>
									<tr>
										<td><img src="../Assets/img/calon/<?php echo $data['foto'];?>" height="50px" width="50px" class="user-image" alt="User Image"></td>
										<td><?php echo $data['id_pil'];?></td>
										<td><?php echo $data['nama_calon'];?></td>
										<td><?php echo $data['kelas'];?></td>
										<td><?php echo $data['status'];?></td>
										<td><a class="btn btn-warning" href="?page=calon&aksi=edit&id=<?php echo $data['id_pil'];?>">Edit</a></td>
										<td><a onclick="return confirm('Anda akan menghapus data ini?')" class="btn btn-danger" href="?page=calon&aksi=delete&id=<?php echo $data['id_pil'];?>&foto=<?php echo $data['foto'];?>">Delete</a></td>
									</tr>
								</tbody>
								<?php
							}
						?>

						</table>
				</div>
			</div>
		</div>
		<ul class="pagination">
				<!-- LINK FIRST AND PREV -->
				<?php
				if($hal == 1){ // Jika hal adalah hal ke 1, maka disable link PREV
				?>
					<li class="disabled"><a href="#">First</a></li>
					<li class="disabled"><a href="#">&laquo;</a></li>
				<?php
				}else{ // Jika hal bukan hal ke 1
					$link_prev = ($hal > 1)? $hal - 1 : 1;
				?>
					<li><a href="?page=calon&aksi=aktif&hal=1">First</a></li>
					<li><a href="?page=calon&aksi=aktif&hal=<?php echo $link_prev; ?>">&laquo;</a></li>
				<?php
				}
				?>

				<!-- LINK NUMBER -->
				<?php
				// Buat query untuk menghitung semua jumlah data
				$sql2 = $pdo->prepare("SELECT COUNT(*) AS jumlah FROM  tbl_calon Where id_sekolah LIKE '$id_skl' LIMIT $limit_start,$limit");
				$sql2->execute(); // Eksekusi querynya
				$get_jumlah = $sql2->fetch();

				$jumlah_hal = ceil($get_jumlah['jumlah'] / $limit); // Hitung jumlah halamannya
				$jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah hal yang aktif
				$start_number = ($hal > $jumlah_number)? $hal - $jumlah_number : 1; // Untuk awal link number
				$end_number = ($hal < ($jumlah_hal - $jumlah_number))? $hal + $jumlah_number : $jumlah_hal; // Untuk akhir link number

				for($i = $start_number; $i <= $end_number; $i++){
					$link_active = ($hal == $i)? ' class="active"' : '';
				?>
					<li<?php echo $link_active; ?>><a href="?page=calon&aksi=aktif&hal=<?php echo $i; ?>"><?php echo $i; ?></a></li>
				<?php
				}
				?>

				<!-- LINK NEXT AND LAST -->
				<?php
				// Jika hal sama dengan jumlah hal, maka disable link NEXT nya
				// Artinya hal tersebut adalah hal terakhir
				if($hal == $jumlah_hal){ // Jika hal terakhir
				?>
					<li class="disabled"><a href="#">&raquo;</a></li>
					<li class="disabled"><a href="#">Last</a></li>
				<?php
				}else{ // Jika Bukan hal terakhir
					$link_next = ($hal < $jumlah_hal)? $hal + 1 : $jumlah_hal;
				?>
					<li><a href="?page=calon&aksi=aktif&hal=<?php echo $link_next; ?>">&raquo;</a></li>
					<li><a href="?page=calon&aksi=aktif&hal=<?php echo $jumlah_hal; ?>">Last</a></li>
				<?php
				}
				?>
			</ul>
	</div>
</div>
</body>
</html>
