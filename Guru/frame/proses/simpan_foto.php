<?php
 	$nis = $_SESSION['username'];
 	$foto = '../Assets/img/frame_jadi/'.$nis.'.jpg'; 


	$img = $_POST['hidden_data'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = $foto;
	$success = file_put_contents($file, $data);
?>
