<?php session_start(); 

if(!isset($_SESSION["isLogin"]) && !$_SESSION["isLogin"] == "Yes"){
	die("Maaf Anda tidak memiliki Akses pada Modul ini atau sesi Anda telah expired.");
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
?><?php
require('../fpdf181/fpdf.php');

include("../include/infoclient.php");
$SQL = "SELECT SUM(debet) AS debet, SUM(kredit) AS kredit FROM acc_saldo_awal";
$hasil =  $dbh_mbs->query($SQL);
$baris = $hasil->fetch_assoc();
if($baris["debet"]!=$baris["kredit"]){
	die("Saldo Awal Tidak Balance, silakan di perbaiki terlebih dahulu.");
}
function noreknn($noreka) {
	$sqln = "SELECT kode_akun FROM acc_rekening WHERE kode_akun = '$noreka'";
	include("../include/infoclient.php");
	$resultn = $dbh_mbs->query($sqln);
	$rown =  $resultn->fetch_assoc();
 if(substr($rown["kode_akun"],-4)=="0000" || substr($rown["kode_akun"],-3)=="000"){
			return "";		  
	  } else {
	  		$split = explode("-",$rown["kode_akun"]);
		  	return $split[1];
	  }
	  
}
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
// fungsi-fungsi pendukung.
function minuss($jumlah){
	if(substr($jumlah,0,1) == "-"){
		return  "(".number_format($jumlah*(-1),2,'.',',').")";
	}
	else{
		return  number_format($jumlah,2,'.',',');
	}
}// fungsi-fungsi pendukung.

function minuss0($jumlah){
	if(substr($jumlah,0,1) == "-"){
		return  "(".number_format($jumlah*(-1),0,'.',',').")";
	}
	else{
		return  number_format($jumlah,0,'.',',');
	}
}



date_default_timezone_set('Asia/Shanghai');

$pdf = new FPDF();
$pdf->AddPage();

//inisialisasi baris untuk paging
$barisPerHalaman = 30;

$pdf->setY(14);
$pdf->setFont('Arial','',12);
$pdf->cell(190,6,'LAPORAN  LABA RUGI', 0, 0, 'C');
$pdf->setY(20);
$pdf->setFont('Arial','',10);
$pdf->cell(190,6,$namaclient, 0, 0, 'C');
$pdf->setY(26);
$pdf->cell(190,6,$jalamclient, 0, 0, 'C');
$pdf->setY(32);
$pdf->cell(190,6,$telponclient, 0, 0, 'C');

// header
$a = session_id();
$SQL = "SELECT * FROM acc_dbfn  WHERE id = '".$a."'";
$hasil = $dbh_mbs->query($SQL);
$baris = $hasil->fetch_assoc();

$pdf->setY(40);
$pdf->cell(20,6,'Periode ', 0, 0, 'L');
$pdf->cell(50,6,': '.$baris['periode'], 0, 0, 'L');
$pdf->setY(45);
$pdf->cell(20,6,'Divisi ', 0, 0, 'L');
$pdf->cell(50,6,': '.$baris['divisi'], 0, 0, 'L');

$pdf->setFont('Arial','',8);
$pdf->setY(57);
//$pdf->cell(8,5,'No.', 1, 0, 'C');
$pdf->cell(15,5,'Norek', 1, 0, 'C');
$pdf->cell(60,5,'Uraian', 1, 0, 'C');
$pdf->cell(28,5,'Awal', 1, 0, 'C');
$pdf->cell(28,5,'Debet', 1, 0, 'C');
$pdf->cell(28,5,'Kredit', 1, 0, 'C');
$pdf->cell(28,5,'Saldo', 1, 0, 'C');

$barisPerHalaman = 42;
$no = 0;

//looping aktiva
$y = 62;
$sa_passiva = 0;
$d_passiva = 0;
$k_passiva = 0;
$sa_passiva_R2 =0;
$d_passiva_R2 = 0;
$k_passiva_R2 = 0;

$sr_passiva = 0;
$SQL = "SELECT * FROM acc_dbfn WHERE tipe = 'R' AND id = '".$a."' ORDER BY norek";
$hasil =  $dbh_mbs->query($SQL);
while($baris = $hasil->fetch_assoc()){
	$pdf->setY($y);
	//$pdf->cell(8,5,++$no, 1, 0, 'C');
	++$no;
	$pdf->cell(15,5,noreknn($baris['norek']), 0, 0, 'C');
	if(substr($baris['norek'],-4)=="0000"){
		$pdf->cell(60,5,$baris['namarek'], 0, 0, 'L');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
	} else {
		$pdf->cell(60,5,'        '.$baris['namarek'], 0, 0, 'L');
		$pdf->cell(28,5,number_format($baris['saldoawal'],2,'.',','), 0, 0, 'R');
		$sa_passiva = $sa_passiva + $baris['saldoawal'];
		$pdf->cell(28,5,number_format($baris['debet'],2,'.',','), 0, 0, 'R');
		$d_passiva = $d_passiva +  $baris['debet'];
		$pdf->cell(28,5,number_format($baris['kredit'],2,'.',','), 0, 0, 'R');
		$k_passiva = $k_passiva + $baris['kredit'];
		$pdf->cell(28,5,minuss($baris['saldoawal']-$baris['debet']+$baris['kredit']), 0, 0, 'R');
		$sr_passiva = $sr_passiva + ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
		
	}
	$y = $y + 5;
	if(($no % $barisPerHalaman) == 0){
		$pdf->AddPage();
		$pdf->setY(57);
		//$pdf->cell(8,5,'No.', 1, 0, 'C');
		$pdf->cell(15,5,'Norek', 1, 0, 'C');
		$pdf->cell(60,5,'Uraian', 1, 0, 'C');
		$pdf->cell(28,5,'Awal', 1, 0, 'C');
		$pdf->cell(28,5,'Debet', 1, 0, 'C');
		$pdf->cell(28,5,'Kredit', 1, 0, 'C');
		$pdf->cell(28,5,'Saldo', 1, 0, 'C');		
		$y = 62;
	}
} // end loop aktiva

$pdf->setY($y);
++$no;
$pdf->cell(75,5,'TOTAL RUGI LABA OPERASIONAL', 1, 0, 'C');
$pdf->cell(28,5,number_format($sa_passiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($d_passiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($k_passiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($sr_passiva,2,'.',','), 1, 0, 'R');

//==== RL NON OP
$y = $y + 6; 
$sr_passiva_R2 = 0;
$SQL = "SELECT * FROM acc_dbfn WHERE tipe = 'R2' AND id = '".$a."' ORDER BY norek";
$hasil = $dbh_mbs->query($SQL);
while($baris = $hasil->fetch_assoc()){
	$pdf->setY($y);
	//$pdf->cell(8,5,++$no, 1, 0, 'C');
	++$no;
	$pdf->cell(15,5,noreknn($baris['norek']), 0, 0, 'C');
	if(substr($baris['norek'],-3)=="000"){
		$pdf->cell(60,5,$baris['namarek'], 0, 0, 'L');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
	} else {
		$pdf->cell(60,5,'        '.$baris['namarek'], 0, 0, 'L');
		$pdf->cell(28,5,number_format($baris['saldoawal'],2,'.',','), 0, 0, 'R');
		$sa_passiva_R2 = $sa_passiva_R2 + $baris['saldoawal'];
		$pdf->cell(28,5,number_format($baris['debet'],2,'.',','), 0, 0, 'R');
		$d_passiva_R2 = $d_passiva_R2 +  $baris['debet'];
		$pdf->cell(28,5,number_format($baris['kredit'],2,'.',','), 0, 0, 'R');
		$k_passiva_R2 = $k_passiva_R2 + $baris['kredit'];
		$pdf->cell(28,5,minuss($baris['saldoawal']-$baris['debet']+$baris['kredit']), 0, 0, 'R');
		$sr_passiva_R2 = $sr_passiva_R2 + ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
		
	}
	$y = $y + 5;
	if(($no % $barisPerHalaman) == 0){
		$pdf->AddPage();
		$pdf->setY(57);
		//$pdf->cell(8,5,'No.', 1, 0, 'C');
		$pdf->cell(15,5,'Norek', 1, 0, 'C');
		$pdf->cell(60,5,'Uraian', 1, 0, 'C');
		$pdf->cell(28,5,'Awal', 1, 0, 'C');
		$pdf->cell(28,5,'Debet', 1, 0, 'C');
		$pdf->cell(28,5,'Kredit', 1, 0, 'C');
		$pdf->cell(28,5,'Saldo', 1, 0, 'C');		
		$y = 62;
	}
} // end loop aktiva

$pdf->setY($y);
++$no;
$pdf->cell(75,5,'TOTAL RUGI LABA NON OPERASIONAL', 1, 0, 'C');
$pdf->cell(28,5,number_format($sa_passiva_R2,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($d_passiva_R2,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($k_passiva_R2,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,minuss($sr_passiva_R2,2,'.',','), 1, 0, 'R');

$y= $y + 6;
$pdf->setY($y);
$ketrl = "";
if(substr($sr_passiva,0,1) == "0"){
	$ketrl = "NIHIL";
}
elseif(substr($sr_passiva,0,1) == "-"){
	$ketrl = "RUGI";
}
else{
	$ketrl = "LABA";
}

$pdf->cell(75,5,$ketrl, 1, 0, 'C');
$pdf->cell(28,5,'', 1, 0, 'R');
$pdf->cell(28,5,'', 1, 0, 'R');
$pdf->cell(28,5,'', 1, 0, 'R');
$pdf->cell(28,5,number_format($sr_passiva + $sr_passiva_R2,2,'.',','), 1, 0, 'R');

$pdf->Output();
?>