<?php
	/*$hal = (isset($_GET['hal']))? $_GET['hal'] : 1;
					
	$limit = 5; // Jumlah data per halamannya
					
	// Untuk menentukan dari data ke berapa yang akan ditampilkan pada tabel yang ada di database
	$limit_start = ($hal - 1) * $limit; */

	include '../../Config/koneksi.php';
	include '../../Config/akun.php';
	include '../../Config/function.php';

    $id_skl = $_SESSION['sekolah'];

	$query = "SELECT DISTINCT kelas FROM tbl_siswa Where id_sekolah LIKE '$id_skl' ORDER BY kelas";
	$sql = $pdo->prepare($query);
	$sql->execute();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Export Data Kelas</title>
</head>
<body>
	<style type="text/css">
		body{
			font-family: sans-serif;
		}
		table{
			margin: 20px auto;
			border-collapse: collapse;
		}
		table th,
		table td{
			border: 1px solid #3c3c3c;
			padding: 3px 8px;
	 
		}
		a{
			background: blue;
			color: #fff;
			padding: 8px 10px;
			text-decoration: none;
			border-radius: 2px;
		}
	</style>
 
	<?php
	$nama_file = "Data Pemilih Kelas";
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=$nama_file.xls");
	?>
	<center>
		<h1>Data Pemilih Kelas</h1>
	</center>
			
	<table border="1">
    <tr>
		<?php
			$query_calon2 = "SELECT * FROM tbl_calon Where id_sekolah LIKE '$id_skl' AND status = 'Y'";
			$sql_calon2 = $pdo->prepare($query_calon2);
			$sql_calon2->execute();
			$jml_calon2 = $sql_calon2->rowCount();
		?>
			<th rowspan="2"><h3>No.</h3></th>
            <th rowspan="2"><h3>Kelas</h3></th>
			<th colspan="<?php echo $jml_calon2; ?>"><div align="center">Jumlah Suara</div></th>
	</tr>
	<tr>
		<?php
	    	$id_skl = $_SESSION['sekolah'];

			$query_calon = "SELECT * FROM tbl_calon Where id_sekolah LIKE '$id_skl' AND status = 'Y'";
			$sql_calon = $pdo->prepare($query_calon);
			$sql_calon->execute();
			$i = 1;
			while($data_calon = $sql_calon->fetch()){
		        ?>
                <th><div align='center'><?php echo $i.'. '. $data_calon['nama_calon'].' | '.$data_calon['kelas'];?></div></th>
                <?php
                $i++;
                                        }
        ?>
	</tr>
		
		<?php
			$no = 1;
			while($data = $sql->fetch()){
		?>
			<tr>
                <td><div align ="center"><?php echo $no;?></div></td>
                <td><?php echo $data['kelas'];?></td>
				<?php
                    $query_siswa = "SELECT * FROM tbl_siswa Where id_sekolah LIKE '$id_skl' AND kelas LIKE '$data[kelas]'";
                    $sql_siswa = $pdo->prepare($query_siswa);
                    $sql_siswa->execute();
                    $jml_siswa = $sql_siswa->rowCount();

                    $query_calon = "SELECT * FROM tbl_calon Where id_sekolah LIKE '$id_skl'";
                    $sql_calon = $pdo->prepare($query_calon);
                    $sql_calon->execute();
                    $jml_calon = $sql_calon->rowCount();


                    while ($pilih = $sql_calon->fetch()) {
                        $kandidat = $pilih['id_pil'];
                        $query_vote = "SELECT * FROM tbl_vote Where id_pil = '$kandidat' AND id_sekolah = '$id_skl' AND kelas = '$data[kelas]'";
                        $sql_vote = $pdo->prepare($query_vote);
                        $sql_vote->execute();
                        $jml_vote = $sql_vote->rowCount();

                        echo "<td> <div align='center'>".$jml_vote."</div></td>";
                    }
                    $no++;
                ?>
			</tr>
		<?php
			}
		?>	

	</table>	
</body>
</html>