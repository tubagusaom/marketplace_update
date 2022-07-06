<?php session_start(); 
if(isset($_POST["excell"])){
	header("location: cetak_neraca_excell.php");
}
?>
<?php
require('../fpdf16/fpdf.php');
include("../include/infoclient.php");


if(isset($_POST['tipe']) && $_POST['tipe']=="dollar"){
	include "cetak_neraca_dollar.php";
	exit;
}
//=============================================================================
function baliktgl($tgl) {
	//21/12/2010
	$hari = substr($tgl,0,2);
	$bln = substr($tgl,3,2);
	$thn = substr($tgl,6,4);
	$tgle = $thn."-".$bln."-".$hari;
	return $tgle;
}
function noreknn($noreka) {
	$sql = "SELECT kode_akun FROM acc_rekening WHERE kode_akun = '$noreka'";
	$hasil = mysql_query($sql);
	$row = mysql_fetch_array($hasil);
 if(substr($row["kode_akun"],-4)=="0000" || substr($row["kode_akun"],-3)=="000"){
			return "";		  
	  } else {
	  		$split = split("-",$row["kode_akun"]);
		  	return $split[1];
	  }
	  
}
function minuss($jumlah){
/* 	if(substr($jumlah,0,1) == "-"){
		return  "(".number_format($jumlah*(-1),2,'.',',').")";
	}
	else{
		return  number_format($jumlah,2,'.',',');
	} */
}// fungsi-fungsi pendukung.

function minuss0($jumlah){
	if(substr($jumlah,0,1) == "-"){
		return  "(".number_format($jumlah*(-1),0,'.',',').")";
	}
	else{
		return  number_format($jumlah,0,'.',',');
	}
}
$SQL = "DELETE FROM $database.acc_dbfn WHERE generate < concat(subdate(current_date, 2), ' 23:59:59')";
$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());


$barisadebet_mem[0] = 0;
$barisakredit_mem[0] = 0;
$barisadebetd_mem[0] = 0;
$barisadebetk_mem[0] = 0;
$sa_aktiva = 0;
$d_aktiva = 0;
$k_aktiva = 0;
$sr_aktiva =0;
$sa_passiva = 0;
$d_passiva = 0;
$k_passiva = 0;
$sr_passiva = 0;


//proses perhitungan neraca
$a = session_id();
	$divisi = "ALL";
	if(isset($_POST['divisi']) && $_POST['divisi'] <>""){
		$SQL = "SELECT namadiv FROM $database.divisi WHERE subdiv = '".$_POST['divisi']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);
		$divisi = $baris[0];
	}
	$SQLdel = "DELETE FROM $database.acc_dbfn WHERE id = '".$a."'";
	$hasildel = mysql_query($SQLdel, $dbh_jogjaide);
	
//1. loop rek
$SQLrek = "SELECT *, debet as debet, kredit as kredit, kode_akun as norek, nama_akun as namarek FROM acc_rekening";
$hasilrek = mysql_query($SQLrek) or die(mysql_error());
while($barisrek = mysql_fetch_array($hasilrek)) {

	// insert nore ke acc_dbfn
	$SQLi = "INSERT INTO acc_dbfn(norek, namarek, debet, kredit, saldoawal, saldoakhir, tipe, id, periode, divisi) VALUES('".$barisrek['norek']."', '".$barisrek['namarek']."', ".$barisrek['debet'].", ".$barisrek['kredit'].", '".$barisrek['saldoawal']."', '".$barisrek['saldoakhir']."', '".$barisrek['tipe']."', '".$a."', '".$_SESSION["tgl_awal"].' s/d '.$_SESSION["tgl_akhir"]."', '".$divisi."')";
	$hasili = mysql_query($SQLi, $dbh_jogjaide);
	
	//2. cari adebet; perhatikan kurang dari tgl yg direquest
	$SQLadebet = "SELECT SUM(jumlah) FROM $database.acc_jurnal_srb WHERE kd = '".$barisrek['norek']."' AND tanggal < '".baliktgl($_SESSION['tgl_awal'])."'";
	if(isset($_POST['divisi']) && $_POST['divisi']<>""){
		$SQLadebet = $SQLadebet . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasiladebet = mysql_query($SQLadebet) or die($SQLadebet);
	$barisadebet = mysql_fetch_array($hasiladebet);
	//
	$SQLadebet_mem = "SELECT SUM(debet) FROM $database.jurnal a, $database.jurnal_header b WHERE a.buyer_id = b.id AND a.coa = '".$barisrek[0]."' AND b.tanggal < '".baliktgl($_SESSION['tgl_awal'])."'";
	if(isset($_POST['divisi']) && $_POST['divisi']<>""){
		$SQLadebet_mem = $SQLadebet_mem . " AND divisi = '".$_POST['divisi']."'";
	}
	//nng $hasiladebet_mem = mysql_query($SQLadebet_mem) or die($SQLadebet_mem);
	//nng $barisadebet_mem = mysql_fetch_array($hasiladebet_mem);
	
	$adebet = $barisadebet[0] + $barisadebet_mem[0];
	
	//3. cari akredit; perhatikan kurang dari tgl yg direquest
	$SQLakredit = "SELECT SUM(jumlah) FROM $database.acc_jurnal_srb WHERE kk = '".$barisrek[0]."' AND tanggal < '".baliktgl($_SESSION['tgl_awal'])."'";
	if(isset($_POST['divisi']) && $_POST['divisi']<>""){
		$SQLakredit = $SQLakredit . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasilakredit = mysql_query($SQLakredit) or die(mysql_error());
	$barisakredit = mysql_fetch_array($hasilakredit);
	
	$SQLakredit_mem = "SELECT SUM(kredit) FROM $database.acc_jurnal_srb a, $database.jurnal_header b WHERE a.buyer_id = b.id AND a.coa = '".$barisrek[0]."' AND b.tanggal < '".baliktgl($_SESSION['tgl_awal'])."'";
	if(isset($_POST['divisi']) && $_POST['divisi']<>""){
		$SQLakredit_mem = $SQLakredit_mem . " AND divisi = '".$_POST['divisi']."'";
	}
	//nng $hasilakredit_mem = mysql_query($SQLakredit_mem) or die(mysql_error());
	//nng $barisakredit_mem= mysql_fetch_array($hasilakredit_mem);
	
	$akredit = $barisakredit[0] + $barisakredit_mem[0];
	
	if($barisrek['tipe']=="A"){
		$saldoawal = $adebet - $akredit;
	} 
	if($barisrek['tipe']=="P"){
		$saldoawal =  $akredit - $adebet;
	} 
	if($barisrek['tipe']=="R"){
		$saldoawal =  $akredit - $adebet;
	} 
	if($barisrek['tipe']=="R2"){
		$saldoawal =  $akredit - $adebet;
	} 
	
	//4. update saldo awal di rek laporan; perhatikan penambahan saldo 
	$SQLawal = "UPDATE $database.acc_dbfn SET saldoawal = $saldoawal + ".$barisrek['saldoawal']." WHERE norek = '".$barisrek['norek']."' AND id = '".$a."'";
	$hasilawal = mysql_query($SQLawal, $dbh_jogjaide);
	
	//debet
	//2. cari jumlah total debet per akun; perhatikan tgl sesuai yg direquest
	$SQLadebetd = "SELECT SUM(jumlah) FROM $database.acc_jurnal_srb WHERE kd = '".$barisrek[0]."' AND (tanggal BETWEEN '".baliktgl($_SESSION['tgl_awal'])."' AND '".baliktgl($_SESSION['tgl_akhir'])."')";
	if(isset($_POST['divisi']) && $_POST['divisi']<>""){
		$SQLadebetd = $SQLadebetd . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasiladebetd = mysql_query($SQLadebetd, $dbh_jogjaide) or die($SQLadebetd);
	$barisadebetd = mysql_fetch_array($hasiladebetd);
	
		$SQLadebetd_mem = "SELECT SUM(a.debet) as debet FROM $database.jurnal a, $database.jurnal_header b WHERE a.buyer_id = b.id AND a.coa = '".$barisrek[0]."' AND (b.tanggal BETWEEN '".baliktgl($_SESSION['tgl_awal'])."' AND '".baliktgl($_SESSION['tgl_akhir'])."')";
		if(isset($_POST['divisi']) && $_POST['divisi']<>""){
			$SQLadebetd_mem = $SQLadebetd_mem . " AND divisi = '".$_POST['divisi']."'";
		}
		//nng $hasiladebetd_mem = mysql_query($SQLadebetd_mem, $dbh_jogjaide) or die($SQLadebetd_mem);
		//nng $barisadebetd_mem = mysql_fetch_array($hasiladebetd_mem);
		//if($barisrek[0]=='1110001') { echo $SQLadebetd_mem; die(); }
	$adebetd = $barisadebetd[0] + $barisadebetd_mem[0];
	
	$SQLawald = "UPDATE $database.acc_dbfn SET debet = '".$adebetd."' WHERE norek = '".$barisrek['norek']."' AND id = '".$a."'";
	$hasilawald = mysql_query($SQLawald, $dbh_jogjaide);
	
	//cari jumlah total kredit per akun; perhatikan tgl sesuai yg direquest
	$SQLadebetk = "SELECT SUM(jumlah) FROM $database.acc_jurnal_srb WHERE kk = '".$barisrek[0]."' AND (tanggal BETWEEN '".baliktgl($_SESSION['tgl_awal'])."' AND '".baliktgl($_SESSION['tgl_akhir'])."')";
	if(isset($_POST['divisi']) && $_POST['divisi']<>""){
		$SQLadebetk = $SQLadebetk . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasiladebetk = mysql_query($SQLadebetk) or die($SQLadebetk);
	$barisadebetk = mysql_fetch_array($hasiladebetk);
	
	$SQLadebetk_mem = "SELECT SUM(a.kredit) as kredit FROM $database.jurnal a, $database.jurnal_header b WHERE a.buyer_id = b.id AND a.coa = '".$barisrek[0]."' AND (b.tanggal BETWEEN '".baliktgl($_SESSION['tgl_awal'])."' AND '".baliktgl($_SESSION['tgl_akhir'])."')";
	if(isset($_POST['divisi']) && $_POST['divisi']<>""){
		$SQLadebetk_mem = $SQLadebetk_mem . " AND divisi = '".$_POST['divisi']."'";
	}
	//nng $hasiladebetk_mem = mysql_query($SQLadebetk_mem, $dbh_jogjaide) or die($SQLadebetk_mem);
	//nng $barisadebetk_mem = mysql_fetch_array($hasiladebetk_mem);
	
	$adebetk = $barisadebetk[0] + $barisadebetk_mem[0];
	
	$SQLawalk = "UPDATE $database.acc_dbfn SET kredit = '".$adebetk."' WHERE norek = '".$barisrek['norek']."' AND id = '".$a."'";
	$hasilawalk = mysql_query($SQLawalk, $dbh_jogjaide);
	
	
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
$pdf->cell(50,6,': '.$_SESSION['tgl_awal'].' s/d '.$_SESSION['tgl_akhir'], 0, 0, 'L');
$pdf->setY(45);
$pdf->cell(20,6,'Divisi ', 0, 0, 'L');
	$divisi = "ALL";
	if(isset($_POST['divisi']) && $_POST['divisi']<>""){
		$SQL = "SELECT namadiv FROM $database.acc_divisi WHERE subdiv = '".$_POST['divisi']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);
		$divisi = $baris[0];
	}
$pdf->cell(50,6,': '.$divisi, 0, 0, 'L');

$pdf->setFont('Arial','',8);
$pdf->setY(57);
//$pdf->cell(8,5,'No.', 1, 0, 'C');
$pdf->cell(15,5,'Norek', 1, 0, 'C');
$pdf->cell(60,5,'Uraian', 1, 0, 'C');
$pdf->cell(28,5,'Awal', 1, 0, 'C');
$pdf->cell(28,5,'Debet', 1, 0, 'C');
$pdf->cell(28,5,'Kredit', 1, 0, 'C');
$pdf->cell(28,5,'Saldo', 1, 0, 'C');

$barisPerHalaman = 40;
$no = 0;

//looping aktiva
$y = 62;
$SQL = "SELECT * FROM $database.acc_dbfn WHERE id = '".$a."' AND (tipe = 'A' OR norek LIKE 'AP%') ORDER BY norek";
$hasil = mysql_query($SQL, $dbh_jogjaide);
while($baris = mysql_fetch_array($hasil)){
	$pdf->setY($y);
	if(substr($baris['norek'],0,2) == 'AP'){
		$sa_aktiva = $sa_aktiva - $baris['saldoawal'];
		$d_aktiva = $d_aktiva -  $baris['debet'];
		$k_aktiva = $k_aktiva - $baris['kredit'];
		$sr_aktiva = $sr_aktiva - ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
	} else {
		$sa_aktiva = $sa_aktiva + $baris['saldoawal'];
		$d_aktiva = $d_aktiva +  $baris['debet'];
		$k_aktiva = $k_aktiva + $baris['kredit'];
		$sr_aktiva = $sr_aktiva + ($baris['saldoawal']+$baris['debet']-$baris['kredit']);
	}
	
	if($baris['saldoawal']=="0.00" && $baris['debet']=="0.00" && $baris['kredit']=="0.00") {
		if(substr($baris['norek'],-3)=="000"){
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
			$pdf->cell(28,5,minuss($baris['saldoawal']*-1,2,'.',','), 0, 0, 'R');
			$pdf->cell(28,5,minuss($baris['debet']*-1,2,'.',','), 0, 0, 'R');
			$pdf->cell(28,5,minuss($baris['kredit']*-1,2,'.',','), 0, 0, 'R');
			$pdf->cell(28,5,minuss(($baris['saldoawal']+$baris['debet']-$baris['kredit']) * -1), 0, 0, 'R');
		} else {
			$pdf->cell(15,5,noreknn($baris['norek']), 0, 0, 'C');
			$pdf->cell(60,5,'        '.$baris['namarek'], 0, 0, 'L');
			$pdf->cell(28,5,minuss($baris['norek'],2,'.',','), 0, 0, 'R');
			$pdf->cell(28,5,minuss($baris['debet'],2,'.',','), 0, 0, 'R');
			$pdf->cell(28,5,minuss($baris['kredit'],2,'.',','), 0, 0, 'R');
			$pdf->cell(28,5,minuss(($baris['saldoawal']+$baris['debet']-$baris['kredit'])), 0, 0, 'R');
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
$pdf->cell(28,5,number_format($sa_aktiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($d_aktiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($k_aktiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($sr_aktiva,2,'.',','), 1, 0, 'R');

//looping pasiva
$y = $y + 6;
$SQL = "SELECT * FROM $database.acc_dbfn WHERE  id = '".$a."' AND (tipe = 'P' || tipe = 'R' ||tipe = 'R2') AND norek NOT LIKE 'AP%' ORDER BY norek";
$hasil = mysql_query($SQL, $dbh_jogjaide);
while($baris = mysql_fetch_array($hasil)){
	$pdf->setY($y);
	$sa_passiva = $sa_passiva + $baris['saldoawal'];
	$d_passiva = $d_passiva +  $baris['debet'];
	$k_passiva = $k_passiva + $baris['kredit'];
	$sr_passiva = $sr_passiva + ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
	
		
	if($baris['saldoawal']=="0.00" && $baris['debet']=="0.00" && $baris['kredit']=="0.00") {
		if(substr($baris['norek'],-3)=="000"){
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
		$pdf->cell(28,5,number_format($baris['saldoawal'],2,'.',','), 0, 0, 'R');
		$pdf->cell(28,5,number_format($baris['debet'],2,'.',','), 0, 0, 'R');
		$pdf->cell(28,5,number_format($baris['kredit'],2,'.',','), 0, 0, 'R');
		$pdf->cell(28,5,number_format($baris['saldoawal']-$baris['debet']+$baris['kredit'],2,'.',','), 0, 0, 'R');	
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

$SQL = "SELECT SUM(saldoawal) as saldoawal, SUM(debet) as debet, SUM(kredit) as kredit FROM $database.acc_dbfn WHERE  id = '".$a."' AND tipe LIKE 'R%'";
$hasil = mysql_query($SQL, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);

	$sa_passiva = $sa_passiva + $baris['saldoawal'];
	$d_passiva = $baris['debet'];
	$k_passiva = $baris['kredit'];
	$Laba = $baris['saldoawal']-$baris['debet']+$baris['kredit'];
	
	$_SESSION["laba"] = $Laba;
	
$y =$y + 5;

$pdf->setY($y);
$pdf->cell(75,5,'TOTAL PASSIVA', 1, 0, 'C');
$pdf->cell(28,5,number_format($sa_passiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($d_passiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($k_passiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($sr_passiva,2,'.',','), 1, 0, 'R');
$pdf->Output();
?>