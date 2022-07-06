<?php session_start(); 

if(!isset($_SESSION["isLogin"]) && !$_SESSION["isLogin"] == "Yes"){
	die("Maaf Anda tidak memiliki Akses pada Modul ini atau sesi Anda telah expired.");
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
?><?php
if(isset($_POST["excell"])){
	header("location: cetak_jurnal_excell.php");
}
require("../fpdf181/fpdf.php");
include("../include/infoclient.php");
function baliktgl($tgl) {
	//21/12/2010
	$hari = substr($tgl,0,2);
	$bln = substr($tgl,3,2);
	$thn = substr($tgl,6,4);
	$tgle = $thn."-".$bln."-".$hari;
	return $tgle;
}
function baliktglindo($tglx) {
	//2010-12-01
	$hari = substr($tglx,8,2);
	$bln = substr($tglx,5,2);
	$thn = substr($tglx,0,4);
	$tgli = $hari."-".$bln."-".$thn;
	return $tgli;
}
function nobukti($nomor){
	$panjang = strlen($nomor);
	switch ($panjang){
		case "1" :
			return "00000".$nomor;	
		break;
		case "2" :
			return "0000".$nomor;	
		break;
		case "3" :
			return "000".$nomor;	
		break;
		case "4" :
			return "00".$nomor;	
		break;
		case "5" :
			return "0".$nomor;	
		break;
		default :
			return $nomor;	
		break;
	}
}
//include "otentik_gli.php";

date_default_timezone_set('Asia/Shanghai');

$pdf = new FPDF();
$pdf->AddPage();

//inisialisasi baris untuk paging
$barisPerHalaman = 25;

$pdf->setY(14);
$pdf->setFont('Arial','',12);
$pdf->cell(190,6,'LAPORAN JURNAL', 0, 0, 'C');
$pdf->setY(20);
$pdf->setFont('Arial','',10);
$pdf->cell(190,6,$namaclient, 0, 0, 'C');
$pdf->setY(26);
$pdf->cell(190,6,$jalamclient, 0, 0, 'C');
$pdf->setY(32);
$pdf->cell(190,6,$telponclient, 0, 0, 'C');

$pdf->setY(40);
$pdf->cell(20,6,'Periode ', 0, 0, 'L');
$pdf->cell(50,6,': '.$_POST['tgl_awal'].' s/d '.$_POST['tgl_akhir'], 0, 0, 'L');
$pdf->setY(45);
$pdf->cell(20,6,'Divisi ', 0, 0, 'L');
	$divisi = "ALL";
	if($_POST['divisi']<>""){
		$SQL = "SELECT namadiv FROM divisi WHERE subdiv = '".$_POST['divisi']."'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		$divisi = $baris[0];
	}
$pdf->cell(50,6,': '.$divisi, 0, 0, 'L');

$pdf->setFont('Arial','',7);
$pdf->setY(52);
$pdf->cell(8,5,'No.', 1, 0, 'C');
$pdf->cell(15,5,'Tanggal', 1, 0, 'C');
$pdf->cell(15,5,'Nobukti', 1, 0, 'C');
$pdf->cell(15,5,'Norek', 1, 0, 'C');
$pdf->cell(90,5,'Uraian', 1, 0, 'C');
$pdf->cell(25,5,'Debet', 1, 0, 'C');
$pdf->cell(25,5,'Kredit', 1, 0, 'C');

$SQL = "SELECT A.*, (SELECT COUNT(id)+1 from acc_jurnal_srb B WHERE B.nobukti = A.nobukti) AS child FROM acc_jurnal_srb A 
where A.id <> ''";
if($_POST['tgl_awal']<>"" && $_POST['tgl_akhir']<>""){
	$SQL = $SQL . " AND tanggal between '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."'";
}
if($_POST['divisi']<>""){
	$SQL = $SQL . " AND sub = '".$_POST['divisi']."'";
}
if($_POST['user']<>""){
	$SQL = $SQL . " AND user_id = '".$_POST['user']."'";
}
$SQL = $SQL . " GROUP BY nobukti ORDER BY tanggal, nobukti, id ASC";
$result = $dbh_mbs->query($SQL);
//die($SQL);

$y = 57;
$no = 1;
$No = 1;
$TOTAL = 0;
while($baris = $result->fetch_assoc()){
	//looping
	
	if($baris['jenis']=="Debet") {
	
		$pdf->setY($y);
		$pdf->cell(8,5,++$no, 1, 0, 'C');
		++$No;
		$pdf->cell(15,5,baliktglindo($baris['tanggal']), 1, 0, 'C');
		$pdf->cell(15,5,substr($baris['jenis'],0,1).'/'.nobukti($baris['nobukti']), 1, 0, 'C');
	
		if($baris['jenis']=="Debet") {
			$pdf->cell(15,5,$baris['kd'], 1, 0, 'C');
		}
		if($baris['jenis']=="Kredit") {
			$pdf->cell(15,5,$baris['kk'], 1, 0, 'C');
		}
				
		$pdf->cell(90,5,substr($baris['ket2'],0,100), 1, 0, 'L');
		$sqlj = "select sum(jumlah) as jumlah from acc_jurnal_srb where nobukti = '".$baris['nobukti']."'";
		$hasilj = $dbh_mbs->query($sqlj);
		$barisj = $hasilj->fetch_assoc();
		$pdf->cell(25,5,number_format($barisj["jumlah"],2,'.',','), 1, 0, 'R');
		$TOTAL = $TOTAL + $barisj["jumlah"];
		$pdf->cell(25,5,'0.00', 1, 0, 'R');
		$y = $y + 5;
	}
	
	//anak
	$SQLkr = "SELECT * FROM acc_jurnal_srb where id <> '' and nobukti = '".$baris['nobukti']."' order by id ";

		$hasilkr = $dbh_mbs->query($SQLkr);

	$i=0;
	while($bariskr = $hasilkr->fetch_assoc()){
		
		++$No;
		$pdf->setY($y);
		if($i==0 && $baris['jenis']=="Kredit") {
			$pdf->cell(8,5,++$no, 1, 0, 'C');
			$pdf->cell(15,5,baliktglindo($baris['tanggal']), 1, 0, 'C');
			$pdf->cell(15,5,substr($baris['jenis'],0,1).'/'.nobukti($baris['nobukti']), 1, 0, 'C');
		} else {
			$pdf->cell(8,5,'', 1, 0, 'C');
			$pdf->cell(15,5,'', 1, 0, 'C');
			$pdf->cell(15,5,'', 1, 0, 'C');
		}
		$i++;
		
		if($baris['jenis']=="Debet") {
			$pdf->cell(15,5,$bariskr['kk'], 1, 0, 'C');
		}

		if($baris['jenis']=="Kredit") {
			$pdf->cell(15,5,$bariskr['kd'], 1, 0, 'C');
		}
		
		if($baris['tipe_jurnal']=="JUM"){
				$pdf->cell(90,5,substr($bariskr['ket2'],0,100), 1, 0, 'L');
		} else {
			
			$pdf->cell(90,5,substr($bariskr['ket2'],0,100), 1, 0, 'L');
		}
		
		if($baris['jenis']=="Kredit") {
			$pdf->cell(25,5,number_format($bariskr['jumlah'],2,'.',','), 1, 0, 'R');
			$pdf->cell(25,5,'0.00', 1, 0, 'R');
		} else {
			$pdf->cell(25,5,'0.00', 1, 0, 'R');
			$pdf->cell(25,5,number_format($bariskr['jumlah'],2,'.',','), 1, 0, 'R');			
		}
		$y = $y + 5;
	}
	
	if($baris['jenis']=="Kredit") {
		$pdf->setY($y);
		$pdf->cell(8,5,'', 1, 0, 'C');
		$pdf->cell(15,5,'', 1, 0, 'C');
		$pdf->cell(15,5,'', 1, 0, 'C');
	
		if($baris['jenis']=="Debet") {
			$pdf->cell(15,5,$baris['kd'], 1, 0, 'C');
		}
		if($baris['jenis']=="Kredit") {
			$pdf->cell(15,5,$baris['kk'], 1, 0, 'C');
		}
		
		$pdf->cell(90,5,substr($baris['ket'],0,100), 1, 0, 'L');
		$sqlj = "select sum(jumlah) as jumlah from acc_jurnal_srb where nobukti = '".$baris['nobukti']."'";
		$hasilj = $dbh_mbs->query($sqlj);

		$barisj = $hasilj->fetch_assoc();
		$pdf->cell(25,5,'0.00', 1, 0, 'R');
		$pdf->cell(25,5,number_format($barisj["jumlah"],2,'.',','), 1, 0, 'R');
		$TOTAL = $TOTAL + $barisj["jumlah"];
		$y = $y + 5;
	}
	
	//paging
	if(($No % $barisPerHalaman) == 0){
		$pdf->AddPage();
		$pdf->setY(52);
		$pdf->cell(8,5,'No.', 1, 0, 'C');
		$pdf->cell(15,5,'Tanggal', 1, 0, 'C');
		$pdf->cell(15,5,'Nobukti', 1, 0, 'C');
		$pdf->cell(15,5,'Norek', 1, 0, 'C');
		$pdf->cell(90,5,'Uraian', 1, 0, 'C');
		$pdf->cell(25,5,'Debet', 1, 0, 'C');
		$pdf->cell(25,5,'Kredit', 1, 0, 'C');
		$y = 57;
	} // end if paging
} // end looping jurnal

$pdf->setY($y);
$pdf->cell(8,5,'', 1, 0, 'C');
$pdf->cell(15,5,'', 1, 0, 'C');
$pdf->cell(15,5,'', 1, 0, 'C');
$pdf->cell(15,5,'', 1, 0, 'C');
$pdf->cell(90,5,'TOTAL', 1, 0, 'R');
$pdf->cell(25,5,number_format($TOTAL,2,'.',','), 1, 0, 'R');
$pdf->cell(25,5,number_format($TOTAL,2,'.',','), 1, 0, 'R');

$pdf->Output();
?>