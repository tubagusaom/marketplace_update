<?php session_start(); 

if(!isset($_SESSION["isLogin"]) && !$_SESSION["isLogin"] == "Yes"){
	die("Maaf Anda tidak memiliki Akses pada Modul ini atau sesi Anda telah expired.");
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
?><?php 
if(isset($_POST["excell"])){
	header("location: cetak_neraca_excell.php");
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

include("../include/infoclient.php");
$SQL = "SELECT SUM(debet) AS debet, SUM(kredit) AS kredit FROM acc_saldo_awal";
$hasil = $dbh_mbs->query($SQL);
$baris = $hasil->fetch_assoc();
if($baris["debet"]!=$baris["kredit"]){
	die("Saldo Awal Tidak Balance, silakan di perbaiki terlebih dahulu.");
}
if($_POST['tipe']=="dollar"){
	include "cetak_neraca_dollar.php";
	exit;
}
//=============================================================================

$SQL = "DELETE FROM acc_dbfn WHERE generate < concat(subdate(current_date, 2), ' 23:59:59')";
$hasil = $dbh_mbs->query($SQL);

//proses perhitungan neraca
$a = session_id();
	$divisi = "ALL";
	if($_POST['divisi']<>""){
		$SQL = "SELECT namadiv FROM divisi WHERE subdiv = '".$_POST['divisi']."'";
		$hasil = $dbh_mbs->query($SQL);
		$baris = $hasil->fetch_assoc();
		$divisi = $baris[0];
	}
	$SQLdel = "DELETE FROM acc_dbfn WHERE id = '".$a."'";
	$hasildel = $dbh_mbs->query($SQLdel);
	
//1. loop rek
$akredit = 0;
$adebet = 0;
$barisadebetd_mem = 0;
$barisadebetk_mem = 0;
$akredit = 0;
$adebet  = 0;
$d_aktiva= 0;
$k_aktiva = 0;
$sr_aktiva = 0;
$total_d_aktiva = 0;
$sa_passiva = 0;
$d_passiva = 0;
$k_passiva = 0;
$sr_passiva = 0;
$total_d_passiva = 0;
$total_k_passiva = 0;
$saldoawal = 0;

$SQLrek = "SELECT *, saldonormal as saldonormal,  debet as debet, kredit as kredit FROM acc_rekening WHERE (level = 4 OR  level = 3) ";
$hasilrek =  $dbh_mbs->query($SQLrek);
while($barisrek = $hasilrek->fetch_assoc()) {

	// insert nore ke acc_dbfn
	$SQLi = "INSERT INTO acc_dbfn(norek, namarek, debet, kredit, saldoawal, saldoakhir, tipe, id, periode, divisi, saldonormal) VALUES('".$barisrek['kode_akun']."', '".$barisrek['nama_akun']."', ".$barisrek['debet'].", ".$barisrek['kredit'].", '".$barisrek['saldoawal']."', '".$barisrek['saldoakhir']."', '".$barisrek['tipe']."', '".$a."', '".$_POST['tgl_awal'].' s/d '.$_POST['tgl_akhir']."', '".$divisi."', '".$barisrek['saldonormal']."')";
	$hasili = $dbh_mbs->query($SQLi);
	//1. saldo awal tahun
	$SQL = "SELECT IF(saldonormal='D',SUM(debet-kredit),SUM(kredit-debet)) as saldoawal FROM acc_v_saldo_awal WHERE kode_akun = '". $barisrek['kode_akun'] ."'";
	if($barisrek['kode_akun']=='MO1-311'){
		//die($SQL);
	}
	$hasil =  $dbh_mbs->query($SQL);

	$barissa = $hasil->fetch_assoc();

	//2. cari adebet; perhatikan kurang dari tgl yg direquest
	$SQLadebet = "SELECT SUM(jumlah) FROM acc_jurnal_srb WHERE kd = '".$barisrek["kode_akun"]."' AND tanggal < '".baliktgl($_POST['tgl_awal'])."'";
	if($_POST['divisi']<>""){
		$SQLadebet = $SQLadebet . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasiladebet = $dbh_mbs->query($SQLadebet);
	$barisadebet = $hasiladebet->fetch_assoc();
	
	//memorial pending
	/*
	$SQLadebet_mem = "SELECT SUM(debet) FROM jurnal a, jurnal_header b WHERE a.buyer_id = b.id AND a.coa = '".$barisrek[0]."' AND b.tanggal < '".baliktgl($_POST['tgl_awal'])."'";
	if($_POST['divisi']<>""){
		$SQLadebet_mem = $SQLadebet_mem . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasiladebet_mem = mysql_query($SQLadebet_mem) or die($SQLadebet_mem);
	$barisadebet_mem = mysql_fetch_array($hasiladebet_mem);
	
	$adebet = $barisadebet[0] + $barisadebet_mem[0];
	*/
	
	
	//3. cari akredit; perhatikan kurang dari tgl yg direquest
	$SQLakredit = "SELECT SUM(jumlah) FROM acc_jurnal_srb WHERE kk = '".$barisrek["kode_akun"]."' AND tanggal < '".baliktgl($_POST['tgl_awal'])."'";
	if($_POST['divisi']<>""){
		$SQLakredit = $SQLakredit . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasilakredit = $dbh_mbs->query($SQLakredit);
	$barisakredit = $hasilakredit->fetch_assoc();
	
	//memorial pending
	/*
	$SQLakredit_mem = "SELECT SUM(kredit) FROM jurnal a, jurnal_header b WHERE a.buyer_id = b.id AND a.coa = '".$barisrek[0]."' AND b.tanggal < '".baliktgl($_POST['tgl_awal'])."'";
	if($_POST['divisi']<>""){
		$SQLakredit_mem = $SQLakredit_mem . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasilakredit_mem = mysql_query($SQLakredit_mem);
	$barisakredit_mem= mysql_fetch_array($hasilakredit_mem);
	
	$akredit = $barisakredit[0] + $barisakredit_mem[0];
	*/
	

	/* metode kelompok
	if($barisrek['tipe']=="A"){
		$saldoawal = $barissa["saldoawal"] + $adebet - $akredit;
	} 
	if($barisrek['tipe']=="P"){
		$saldoawal =  $barissa["saldoawal"] - $akredit - $adebet;
	} 
	if($barisrek['tipe']=="R"){
		$saldoawal =  $barissa["saldoawal"] + $akredit - $adebet;
	} 
	if($barisrek['tipe']=="R2"){
		$saldoawal =  $barissa["saldoawal"] + $akredit - $adebet;
	} 
	*/

	//metode saldo normal
	if($barisrek['saldonormal']=="D"){
		$saldoawal = $barissa["saldoawal"] + $adebet - $akredit;
	} else {
	//if($barisrek['saldonormal']=="K"){
		$saldoawal =  $barissa["saldoawal"] + $akredit - $adebet;
	} 


	//4. update saldo awal di rek laporan; perhatikan penambahan saldo 
	//$SQLawal = "UPDATE acc_dbfn SET saldoawal = $saldoawal + ".$barisrek['saldoawal']." WHERE norek = '".$barisrek['kode_akun']."' AND id = '".$a."'";
	$SQLawal = "UPDATE acc_dbfn SET saldoawal = $saldoawal  WHERE norek = '".$barisrek['kode_akun']."' AND id = '".$a."' AND (substr(norek,-4) != '0000')";
	if($barisrek['kode_akun']=='MO1-311'){
		//die($SQLawal);
	}
	$hasilawal = $dbh_mbs->query($SQLawal);
	
	//debet
	//2. cari jumlah total debet per akun; perhatikan tgl sesuai yg direquest
	$SQLadebetd = "SELECT SUM(jumlah) as jumlah FROM acc_jurnal_srb WHERE kd = '".$barisrek["kode_akun"]."' AND (tanggal BETWEEN '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."')";
	if($_POST['divisi']<>""){
		$SQLadebetd = $SQLadebetd . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasiladebetd = $dbh_mbs->query($SQLadebetd);
	$barisadebetd = $hasiladebetd->fetch_assoc();
		
		//memorial pending
			/*
		$SQLadebetd_mem = "SELECT SUM(a.debet) as debet FROM jurnal a, jurnal_header b WHERE a.buyer_id = b.id AND a.coa = '".$barisrek[0]."' AND (b.tanggal BETWEEN '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."')";
		if($_POST['divisi']<>""){
			$SQLadebetd_mem = $SQLadebetd_mem . " AND divisi = '".$_POST['divisi']."'";
		}
		$hasiladebetd_mem = mysql_query($SQLadebetd_mem) or die($SQLadebetd_mem);
		$barisadebetd_mem = mysql_fetch_array($hasiladebetd_mem);
		//if($barisrek[0]=='1110001') { echo $SQLadebetd_mem; die(); }
	*/
	
	$adebetd = $barisadebetd["jumlah"]; // + $barisadebetd_mem[0];
		
	
	$SQLawald = "UPDATE acc_dbfn SET debet = '".$adebetd."' WHERE norek = '".$barisrek['kode_akun']."' AND id = '".$a."'";
	
	$hasilawald =  $dbh_mbs->query($SQLawald);
	
	//cari jumlah total kredit per akun; perhatikan tgl sesuai yg direquest
	$SQLadebetk = "SELECT SUM(jumlah) as jumlah FROM acc_jurnal_srb WHERE kk = '".$barisrek["kode_akun"]."' AND (tanggal BETWEEN '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."')";
	if($_POST['divisi']<>""){
		$SQLadebetk = $SQLadebetk . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasiladebetk =  $dbh_mbs->query($SQLadebetk);
	$barisadebetk = $hasiladebetk->fetch_assoc();
	
	//memorial pending
	/*
	$SQLadebetk_mem = "SELECT SUM(a.kredit) as kredit FROM jurnal a, jurnal_header b WHERE a.buyer_id = b.id AND a.coa = '".$barisrek[0]."' AND (b.tanggal BETWEEN '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."')";
	if($_POST['divisi']<>""){
		$SQLadebetk_mem = $SQLadebetk_mem . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasiladebetk_mem = mysql_query($SQLadebetk_mem) or die($SQLadebetk_mem);
	$barisadebetk_mem = mysql_fetch_array($hasiladebetk_mem);
	*/
	$adebetk = $barisadebetk["jumlah"]; // + $barisadebetk_mem[0];
	
	
	
	$SQLawalk = "UPDATE acc_dbfn SET kredit = '".$adebetk."' WHERE norek = '".$barisrek['kode_akun']."' AND id = '".$a."'";
	$hasilawalk =  $dbh_mbs->query($SQLawalk);
	
	
} // end while loop rek



//=============================================================================


$a = session_id();

date_default_timezone_set('Asia/Shanghai');

$pdf = new FPDF();
$pdf->AddPage();

//inisialisasi baris untuk paging

$pdf->setY(14);
$pdf->setFont('Arial','',12);
$pdf->cell(190,6,'LAPORAN NERACA SALDO', 0, 0, 'C');
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

$pdf->setFont('Arial','',8);
$pdf->setY(57);
//$pdf->cell(8,5,'No.', 1, 0, 'C');
$pdf->cell(15,5,'Norek', 1, 0, 'C');
$pdf->cell(60,5,'Uraian', 1, 0, 'C');
$pdf->cell(28,5,'', 1, 0, 'C');
$pdf->cell(28,5,'Debet', 1, 0, 'C');
$pdf->cell(28,5,'Kredit', 1, 0, 'C');
$pdf->cell(28,5,'Total', 1, 0, 'C');

$barisPerHalaman = 40;
$no = 0;

//looping aktiva
$y = 62;
$total_k_aktiva = 0;
//$SQL = "SELECT * FROM acc_dbfn WHERE id = '".$a."' AND (tipe = 'A' OR norek LIKE 'AP%') ORDER BY norek";
$SQL = "SELECT * FROM acc_dbfn WHERE id = '".$a."' AND (tipe = 'A') ORDER BY norek";
$hasil =$dbh_mbs->query($SQL);
while($baris = $hasil->fetch_assoc()){
	$pdf->setY($y);
	if(substr($baris['norek'],0,2) == 'AP'){
		$d_aktiva = $d_aktiva -  $baris['debet'];
		$k_aktiva = $k_aktiva - $baris['kredit'];
		$sr_aktiva = $sr_aktiva - ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
		$total_k_aktiva = $total_k_aktiva + ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
	} else {
		$d_aktiva = $d_aktiva +  $baris['debet'];
		$k_aktiva = $k_aktiva + $baris['kredit'];
		$sr_aktiva = $sr_aktiva + ($baris['saldoawal']+$baris['debet']-$baris['kredit']);
		$total_d_aktiva = $total_d_aktiva +($baris['saldoawal']+$baris['debet']-$baris['kredit']);
	}
	
	if($baris['saldoawal']=="0.00" && $baris['debet']=="0.00" && $baris['kredit']=="0.00") {
		if(substr($baris['norek'],-4)=="0000"){
			//$pdf->cell(8,5,++$no, 1, 0, 'C');
			++$no;
			$pdf->cell(15,5,noreknn($baris['norek']), 0, 0, 'C');
			$pdf->cell(60,5,$baris['namarek'], 0, 0, 'L');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$y = $y + 5;
		} 
	} else {
		//$pdf->cell(8,5,++$no, 1, 0, 'C');
		++$no;
		if(substr($baris['norek'],0,2) == 'AP'){
			$pdf->cell(15,5,noreknn($baris['norek']), 0, 0, 'C');
			$pdf->cell(60,5,'        '.$baris['namarek'], 0, 0, 'L');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,minuss($baris['saldoawal']-$baris['debet']+$baris['kredit'],2,'.',','), 0, 0, 'R');
			$pdf->cell(28,5,'', 0, 0, 'R');
		} else {
			$pdf->cell(15,5,noreknn($baris['norek']), 0, 0, 'C');
			$pdf->cell(60,5,'        '.$baris['namarek'], 0, 0, 'L');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,minuss(($baris['saldoawal']+$baris['debet']-$baris['kredit'])), 0, 0, 'R');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,'', 0, 0, 'R');
		}
		$y = $y + 5;
	}
	
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
$pdf->cell(75,5,'TOTAL AKTIVA', 1, 0, 'C');
$pdf->cell(28,5,'', 1, 0, 'R');
$pdf->cell(28,5,number_format($total_d_aktiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($total_k_aktiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($total_d_aktiva - $total_k_aktiva,2,'.',','), 1, 0, 'R');

//looping pasiva
$y = $y + 6;
$SQL = "SELECT * FROM acc_dbfn WHERE  id = '".$a."' AND (tipe = 'P' || tipe = 'R' || tipe = 'R2') AND norek NOT LIKE 'AP%' ORDER BY norek";
$hasil = $dbh_mbs->query($SQL);
while($baris = $hasil->fetch_assoc()){
	$pdf->setY($y);
	$sa_passiva = $sa_passiva + $baris['saldoawal'];
	$d_passiva = $d_passiva +  $baris['debet'];
	$k_passiva = $k_passiva + $baris['kredit'];
	$sr_passiva = $sr_passiva + ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
	
		
	if($baris['saldoawal']=="0.00" && $baris['debet']=="0.00" && $baris['kredit']=="0.00") {
		if(substr($baris['norek'],-4)=="0000"){
			//$pdf->cell(8,5,++$no, 1, 0, 'C');
			++$no;
			$pdf->cell(15,5,noreknn($baris['norek']), 0, 0, 'C');
			$pdf->cell(60,5,$baris['namarek'], 0, 0, 'L');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$y = $y + 5;
		} 
	} else {
		//$pdf->cell(8,5,++$no, 1, 0, 'C');
		++$no;
		$pdf->cell(15,5,noreknn($baris['norek']), 0, 0, 'C');
		$pdf->cell(60,5,'        '.$baris['namarek'], 0, 0, 'L');
		$pdf->cell(28,5,'',0, 0, 'R');
		if ($baris['saldonormal'] == 'D'){
			$d_aktiva = $d_aktiva +  $baris['debet'];
			$k_aktiva = $k_aktiva + $baris['kredit'];
			$sr_aktiva = $sr_aktiva + ($baris['saldoawal']+$baris['debet']-$baris['kredit']);
			$total_d_passiva = $total_d_passiva +($baris['saldoawal']+$baris['debet']-$baris['kredit']);
			$pdf->cell(28,5,number_format($baris['saldoawal']+$baris['debet']-$baris['kredit'],2,'.',','), 0, 0, 'R');	
			$pdf->cell(28,5,'', 0, 0, 'R');
			//$pdf->cell(28,5,number_format($baris['saldoawal']+$baris['debet']-$baris['kredit'],2,'.',','), 0, 0, 'R');	
		}
		if($baris['saldonormal'] == 'K'){
			$d_aktiva = $d_aktiva -  $baris['debet'];
			$k_aktiva = $k_aktiva - $baris['kredit'];
			$sr_aktiva = $sr_aktiva - ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
			$total_k_passiva = $total_k_passiva + ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,number_format($baris['saldoawal']-$baris['debet']+$baris['kredit'],2,'.',','), 0, 0, 'R');
			//$pdf->cell(28,5,number_format($baris['saldoawal']-$baris['debet']+$baris['kredit'],2,'.',','), 0, 0, 'R');	
		}
		$y = $y + 5;
	}
		
	if(($no % $barisPerHalaman) == 0){
		$pdf->AddPage();
		$pdf->setY(57);
		//$pdf->cell(8,5,'No.', 1, 0, 'C');
		$pdf->cell(15,5,'Norek', 1, 0, 'C');
		$pdf->cell(60,5,'Uraian', 1, 0, 'C');
		$pdf->cell(28,5,'', 1, 0, 'C');
		$pdf->cell(28,5,'Debet', 1, 0, 'C');
		$pdf->cell(28,5,'Kredit', 1, 0, 'C');
		$pdf->cell(28,5,'Total', 1, 0, 'C');		
		$y = 62;
	}
} // end loop passiva


 // end loop LR


//rugi laba
$pdf->setY($y);

++$no;
$sr_passiva = $sr_passiva + ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
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

$SQL = "SELECT SUM(saldoawal) as saldoawal, SUM(debet) as debet, SUM(kredit) as kredit FROM acc_dbfn WHERE  id = '".$a."' AND tipe LIKE 'R%'";
$hasil = $dbh_mbs->query($SQL);
$baris = $hasil->fetch_assoc();

	$sa_passiva = $sa_passiva + $baris['saldoawal'];
	$d_passiva = $baris['debet'];
	$k_passiva = $baris['kredit'];
	$Laba = $baris['saldoawal']-$baris['debet']+$baris['kredit'];
	
	$_SESSION["laba"] = $Laba;
	
$y =$y + 5;

$pdf->setY($y);
$pdf->cell(75,5,'TOTAL PASSIVA', 1, 0, 'C');
$pdf->cell(28,5,'', 1, 0, 'R');
$pdf->cell(28,5,number_format($total_d_passiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($total_k_passiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($total_k_passiva-$total_d_passiva,2,'.',','), 1, 0, 'R');
$pdf->Output();
?>