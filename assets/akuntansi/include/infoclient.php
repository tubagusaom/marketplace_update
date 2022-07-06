<?php 

	$host ="128.199.119.79";
    $user="root";
    $password="bismIll@h99";
    $database="diklat_asahi_db";
    $dbh_mbs = mysqli_connect($host,$user,$password,$database);

    // Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql = "select * from acc_laporanid";

$result = $dbh_mbs->query($sql);
$row = $result->fetch_assoc();

$namaclient = $row["nama"];
$jalamclient = $row["alamat"];
$telponclient = $row["telpon"];
?>