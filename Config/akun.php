<?php
  SESSION_START();
  include "koneksi.php";
  if(empty($_SESSION['username'])){
  	$_SESSION['username'] = "";
  }else{
  	$user=$_SESSION['username'];
    $level=$_SESSION['level'];

    if ($level=="Admin") {
    	$sql="select * from tbl_admin where nip='$user'";
    	$query=$pdo->prepare($sql);
    	$query->execute();
    	$data=$query->fetch();
    } elseif ($level=="Super Admin") {
      $sql="select * from tbl_admin where nip='$user'";
      $query=$pdo->prepare($sql);
      $query->execute();
      $data=$query->fetch();
    } elseif ($level=="Guru") {
      $sql="select * from tbl_admin where nip='$user'";
      $query=$pdo->prepare($sql);
      $query->execute();
      $data=$query->fetch();
    } elseif ($level=="Siswa") {
      $sql="select * from tbl_siswa where nis='$user'";
      $query=$pdo->prepare($sql);
      $query->execute();
      $data=$query->fetch();
    }
  }
?>