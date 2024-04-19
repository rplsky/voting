<?php
	$sekolah = $_SESSION['sekolah'];
	$sql="select * from tbl_sekolah where id_sekolah='$sekolah'";
    $query=$pdo->prepare($sql);
    $query->execute();
    $data=$query->fetch();
?>

<div align="center">
	<h1>SELAMAT DATANG DI BERANDA</h1>
	<br>
	<h3><?php
		echo $data['nama_sekolah'];
	?></h3>
	<br>
	<img src="../Assets/img/sekolah/<?php echo $data['logo'];?>" height="200px" width="200px" class="user-image" alt="User Image"> 
</div>
