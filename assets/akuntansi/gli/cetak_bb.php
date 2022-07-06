<?php session_start(); 

if(!isset($_SESSION["isLogin"]) && !$_SESSION["isLogin"] == "Yes"){
	die("Maaf Anda tidak memiliki Akses pada Modul ini atau sesi Anda telah expired.");
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
?><?php @session_start();

include("../include/infoclient.php");
//cek saldo awal balance
$SQL = "SELECT SUM(debet) AS debet, SUM(kredit) AS kredit FROM acc_saldo_awal";
$result = $dbh_mbs->query($SQL);
$baris = $result->fetch_assoc();
if($baris["debet"]!=$baris["kredit"]){
	die("Saldo Awal Tidak Balance, silakan di perbaiki terlebih dahulu.");
}
if(isset($_POST["excell"])){
	header("location: cetak_bb_excell.php");
}
?>
<?php
require('../fpdf181/fpdf.php');
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
//include "otentik_gli.php";

	//periode($_POST['tgl_akhir']);
	$tgl_awal = isset($_POST["tgl_awal"]) ? $_POST["tgl_awal"] :"2014-01-01" ;
	$tgl_akhir = isset($_POST["tgl_akhir"]) ? $_POST["tgl_akhir"] :"2014-12-31" ;
	//unset($_SESSION["tgl_awal"]);
	//unset($_SESSION["tgl_akhir"]);
	$_SESSION["tgl_awal"] = $tgl_awal;
	$_SESSION["tgl_akhir"] = $tgl_akhir;
	
date_default_timezone_set('Asia/Shanghai');

$pdf = new FPDF();
$SQLinduk = "SELECT * FROM acc_rekening WHERE substr(kode_akun, -3) <> '000' AND level = 4  ";

$norek = isset($_POST["norek"]) ? $_POST["norek"] :"" ;
if($norek <> ""){
	$SQLinduk = $SQLinduk . " AND kode_akun = '".$norek."'";
}
$SQLinduk = $SQLinduk . " ORDER BY kode_akun";
$resultinduk = $dbh_mbs->query($SQLinduk);
while($barisinduk = $resultinduk->fetch_assoc()){

	$pdf->AddPage();
	
	//inisialisasi baris untuk paging
	$barisPerHalaman = 30;
	
	$pdf->setY(14);
	$pdf->setFont('Arial','',12);
	$pdf->cell(190,6,'LAPORAN BUKU BESAR', 0, 0, 'C');
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
	$_SESSION["periode"] = $_POST['tgl_awal'].' s/d '.$_POST['tgl_akhir'];
	$pdf->setY(45);
	$pdf->cell(20,6,'Divisi ', 0, 0, 'L');
		$divisi = "ALL";
		if(isset($_POST['divisi']) && $_POST['divisi']<>""){
			$SQL = "SELECT namadiv FROM divisi WHERE subdiv = '".$_POST['divisi']."'";
			$hasil = mysql_query($SQL);
			$baris = mysql_fetch_array($hasil);
			$divisi = $baris[0];
		}
	$pdf->cell(50,6,': '.$divisi, 0, 0, 'L');
	$pdf->setY(50);
	$pdf->cell(20,6,'Rekening  ', 0, 0, 'L');
		$SQnamarek = "SELECT nama_akun FROM acc_rekening WHERE kode_akun = '".$barisinduk['kode_akun']."'";
		$resultnamarek = $dbh_mbs->query($SQnamarek);
		$barisnamarek = $resultnamarek->fetch_assoc();
	$pdf->cell(50,6,': '.$barisnamarek["nama_akun"].' - '.noreknn($barisinduk['kode_akun']), 0, 0, 'L');
	
	$pdf->setFont('Arial','',7);
	$pdf->setY(57);
	$pdf->cell(8,5,'No.', 1, 0, 'C');
	$pdf->cell(15,5,'Tanggal', 1, 0, 'C');
	$pdf->cell(31,5,'Nobukti', 1, 0, 'C');
	$pdf->cell(60,5,'Uraian', 1, 0, 'C');
	$pdf->cell(25,5,'Debet', 1, 0, 'C');
	$pdf->cell(25,5,'Kredit', 1, 0, 'C');
	$pdf->cell(30,5,'Saldo', 1, 0, 'C');
	
	//saldo awal
	//saldo awal
	$SQL = "SELECT SUM(debet-kredit) as saldoawal FROM acc_saldo_awal WHERE kode_akun = '". $barisinduk['kode_akun'] ."'";
	$resulta = $dbh_mbs->query($SQL);
	$barissa = $resulta->fetch_assoc();
	$SQL = "SELECT SUM(jumlah) as jumlah FROM acc_jurnal_srb where kd = '".$barisinduk['kode_akun']."' AND tanggal < '".baliktgl($_POST['tgl_awal'])."'";
	$result = $dbh_mbs->query($SQL);
	$baris = $result->fetch_assoc();
	$sa_debet = $baris["jumlah"];
	$SQL = "SELECT SUM(jumlah) as jumlah FROM acc_jurnal_srb where kk = '".$barisinduk['kode_akun']."' AND tanggal < '".baliktgl($_POST['tgl_awal'])."'";
	$hasil = $dbh_mbs->query($SQL);
	$baris = $hasil->fetch_assoc();
	$sa_kredit = $baris["jumlah"];
	
	//echo $barissa['saldoawal']."<br>";
	//echo $sa_debet."<br>";
	//echo $sa_kredit; exit();

	if($barisinduk['tipe']=="A"){
		$saldoawal = $barissa['saldoawal'] + $sa_debet - $sa_kredit;
	} 
	if($barisinduk['tipe']=="P"){
		$saldoawal = $barissa['saldoawal'] + $sa_kredit - $sa_debet;
	} 
	if($barisinduk['tipe']=="R"){
		$saldoawal = $barissa['saldoawal'] + $sa_kredit - $sa_debet;
	} 
	
	
		//menyimpan masing masing kode_akun di session
		$sess_kode_akun = $barisinduk['kode_akun'];
		$_SESSION[$sess_kode_akun] = $sess_kode_akun;
		
		
		
		//menyimpan saldo awal masing masing kode_akun di session
		$sess_kode_akun_a = $saldoawal;
		$_SESSION[$sess_kode_akun_a] = $sess_kode_akun_a;
		//echo $_SESSION[$sess_kode_akun] .'=' . $_SESSION[$sess_kode_akun_a]; exit();
		
		
	//transaksi
	$SQL = "SELECT * FROM acc_jurnal_srb where (kd = '".$barisinduk['kode_akun']."' OR kk = '".$barisinduk['kode_akun']."')";
	if($_POST['tgl_awal']<>"" && $_POST['tgl_akhir']<>""){
		$SQL = $SQL . " AND tanggal between '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."'";
	}
	if(isset($_POST['divisi']) && $_POST['divisi']<>""){
		$SQL = $SQL . " AND sub = '".$_POST['divisi']."'";
	}
	$SQL = $SQL . " ORDER BY tanggal, nobukti, id ASC";
	$hasil = $dbh_mbs->query($SQL);
	
	$y = 62;
	//saldo awal
	$pdf->setY($y);
		$pdf->cell(8,5,'', 1, 0, 'C');
		$pdf->cell(15,5,'', 1, 0, 'C');
		$pdf->cell(31,5,'', 1, 0, 'C');
		$pdf->cell(60,5,'Saldo Awal', 1, 0, 'L');
		if($barisinduk["saldonormal"] == "D"){
			$pdf->cell(25,5,number_format($saldoawal,2,'.',','), 1, 0, 'R');
			$pdf->cell(25,5,'', 1, 0, 'R'); //kredit
			$saldoawal_d = $saldoawal;
			$saldoawal_k = 0;
		} 
		if($barisinduk["saldonormal"] == "K"){
			$pdf->cell(25,5,'', 1, 0, 'R');
			$pdf->cell(25,5,number_format($saldoawal,2,'.',','), 1, 0, 'R'); //kredit
			$saldoawal_k = $saldoawal;
			$saldoawal_d = 0;
		}
		$pdf->cell(30,5,number_format($saldoawal,2,'.',','), 1, 0, 'R'); //saldo
		
	$y = 67;
	$sr_debet = 0;
	$sr_kredit = 0;
	$no=0;
	while($baris = $hasil->fetch_assoc()){
		$_SESSION[$sess_kode_akun] =  $_SESSION[$sess_kode_akun_a];
		//looping
		$pdf->setY($y);
		$pdf->cell(8,5,++$no, 1, 0, 'C');
		$pdf->cell(15,5,baliktglindo($baris['tanggal']), 1, 0, 'C');
		$pdf->cell(31,5,$baris['sub'].'/'.nobukti($baris['nobukti']), 1, 0, 'C');
		$pdf->cell(60,5,substr($baris['ket2'],0,60), 1, 0, 'L');
		if($baris['kd'] == $barisinduk['kode_akun']){
			$pdf->cell(25,5,number_format($baris['jumlah'],2,'.',','), 1, 0, 'R'); //debet
			$sr_debet = $sr_debet + $baris['jumlah'];
			
			if($barisinduk['tipe']=="A"){
				$saldoawal = $saldoawal + $baris['jumlah'];
			} 
			if($barisinduk['tipe']=="P"){
				$saldoawal = $saldoawal - $baris['jumlah'];
			} 
			if($barisinduk['tipe']=="R"  && $barisinduk['saldonormal']=="D"){
				$saldoawal = $saldoawal + $baris['jumlah'];
			} 
			if($barisinduk['tipe']=="R"  && $barisinduk['saldonormal']=="K"){
				$saldoawal = $saldoawal - $baris['jumlah'];
			} 
			
			$_SESSION[$sess_kode_akun.'_rr'] = $saldoawal;
			$pdf->cell(25,5,'0.00', 1, 0, 'R'); //kredit
		}

		if($baris['kk'] == $barisinduk['kode_akun']){
			$pdf->cell(25,5,'0.00', 1, 0, 'R'); //debet
			$pdf->cell(25,5,number_format($baris['jumlah'],2,'.',','), 1, 0, 'R'); //kredit
			$sr_kredit = $sr_kredit + $baris['jumlah'];
			
			if($barisinduk['tipe']=="A"){
				$saldoawal = $saldoawal - $baris['jumlah'];
			} 
			if($barisinduk['tipe']=="P"){
				$saldoawal = $saldoawal + $baris['jumlah'];
			} 
			if($barisinduk['tipe']=="R" && $barisinduk['saldonormal']=="D"){
				$saldoawal = $saldoawal + $baris['jumlah'];
			} 
			if($barisinduk['tipe']=="R" && $barisinduk['saldonormal']=="K"){
				$saldoawal = $saldoawal + $baris['jumlah'];
			} 
			$_SESSION[$sess_kode_akun.'_rr'] = $saldoawal;
		}
		
		
			$pdf->cell(30,5,number_format($saldoawal,2,'.',','), 1, 0, 'R'); //saldo
		
		$y = $y + 5;
		
		//paging
		
		if(($no % $barisPerHalaman) == 0){
			$pdf->AddPage();
			$pdf->setY(52);
			$pdf->cell(8,5,'No.', 1, 0, 'C');
			$pdf->cell(15,5,'Tanggal', 1, 0, 'C');
			$pdf->cell(31,5,'Nobukti', 1, 0, 'C');
			$pdf->cell(60,5,'Uraian', 1, 0, 'C');
			$pdf->cell(23,5,'Debet', 1, 0, 'C');
			$pdf->cell(23,5,'Kredit', 1, 0, 'C');
			$pdf->cell(30,5,'Saldo', 1, 0, 'C');
			$y = 57;
		} // end if paging */
	} // end looping jurnal
	
	
	$pdf->setY($y);
		
	if($barisinduk['tipe']=="A"){
		$rr = $barissa['saldoawal'] + $sr_debet - $sr_debet;
	} 
	if($barisinduk['tipe']=="P"){
		$rr = $barissa['saldoawal'] + $sr_kredit - $sr_debet;
	} 
	if($barisinduk['tipe']=="R"){
		$rr = $barissa['saldoawal'] + $sr_kredit - $sr_debet;
	} 	
		$_SESSION[$sess_kode_akun] =  $_SESSION[$sess_kode_akun_a];
		$_SESSION[$sess_kode_akun.'_rd'] =  $sr_debet;
		$_SESSION[$sess_kode_akun.'_rk'] =  $sr_kredit;
	
	//acc_rekening upah tenaga kerja
	//BP1-5113
	/*
	if($barisinduk['kode_akun']=="BP1-5113"){
		$_SESSION["BP1-5113_tdebet"] = $sr_debet;
		//upah tenaga kerja langsung = upah borongan
		$SQLb = "SELECT SUM(jumlah) FROM acc_jurnal_srb WHERE ket LIKE 'Upah Borongan Unit%' ";
		$SQLb = $SQLb . " AND kd = 'BP1-5113' AND tanggal between '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."'";
		$hasilb = mysql_query($SQLb)or die(mysql_error());
		$barisb = mysql_fetch_array($hasilb);
		$_SESSION["BP1-5113_borongan"] = $barisb[0];
		$SQLb = "SELECT SUM(jumlah) FROM acc_jurnal_srb WHERE ket NOT LIKE 'Upah Borongan Unit%' ";
		$SQLb = $SQLb . " AND kd = 'BP1-5113'  AND tanggal between '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."'";
		$hasilb = mysql_query($SQLb);
		$barisb = mysql_fetch_array($hasilb);
		$_SESSION["BP1-5113_tk_taklangsung"] = $barisb[0];
	}
	*/
		$pdf->cell(8,5,'', 1, 0, 'C');
		$pdf->cell(15,5,'', 1, 0, 'C');
		$pdf->cell(31,5,'', 1, 0, 'C');
		$pdf->cell(60,5,'TOTAL', 1, 0, 'L');
		$pdf->cell(25,5,number_format($sr_debet + $saldoawal_d,2,'.',','), 1, 0, 'R'); //debet
		$pdf->cell(25,5,number_format($sr_kredit + $saldoawal_k,2,'.',','), 1, 0, 'R'); //kredit
		$pdf->cell(30,5,number_format($saldoawal,2,'.',','), 1, 0, 'R'); //saldo
} // end while loop acc_rekening
$pdf->Output();
?>