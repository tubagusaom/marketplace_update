<?php 
$jumlah_asesor = 2;
$jumlah_peserta = 10;

for($i=0;$i<$jumlah_asesor;$i++){ 
   // foreach ($asesor as $ky => $asesor_value){ 
	$id_asesor = $asesor[$i]->id;
	//var_dump($id_asesor); die();
        $asesi = array();
	$asesi = $this->jadwal_asesmen_model->asesi_clo($id_asesor, $id_jadwal);
        //var_dump($asesi[$i]);die();
?>
<style type="text/css">
	.border {
		border: 1px solid #000;
	}
	.header_elemen{
		border-bottom: 1px solid #000;		
	}
	.body_elemen{
		width: 4%;
		border: 1px solid #000;		
		text-align: center;
	}
</style>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo '/var/www/stpbandung/assets/img/logo48.png';?>" /></td>
                <td style="text-align: left;    width: 64%;font-weight: lighter;">
                    <?=$aplikasi->nama_unit?>
                </td>
                
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 21%"><?=$aplikasi->singkatan_unit?> :
                </td>
                <td style="text-align: left;    width: 49%"> <?=$aplikasi->alamat?> <?=$aplikasi->no_telpon?></td>
                <td style="text-align: right;    width: 30%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    
<div>
	<h5>CHECKLIST OBSERVASI PRAKTEK SKEMA <?= strtoupper($skema) ?></h5>
</div>
<?php 
$real_unit = false;
$table = '<table border="0" style="width: 100%;border-collapse: collapse;">';
foreach ($elemen_clo as $key => $value) {
	if($real_unit != $value->id_unit_kompetensi){   
		$real_unit = $value->id_unit_kompetensi;
		$aa[] = $value->unit_kompetensi;
		$table.= '<tr>
					<td style="width: 60%; border-bottom: 1px solid #000; padding-top: 5px; padding-bottom: 5px;">
						<label style="font-size: 16px; font-weight: bold;">
						'.$value->unit_kompetensi.'
						</label>
					</td>
					<td class="header_elemen"></td>
					<td class="header_elemen"></td>
					<td class="header_elemen"></td>
					<td class="header_elemen"></td>
					<td class="header_elemen"></td>
					<td class="header_elemen"></td>
					<td class="header_elemen"></td>
					<td class="header_elemen"></td>
					<td class="header_elemen"></td>
					<td class="header_elemen"></td>
				 </tr>';
		$table.='<tr>
					<td style="width: 60%; border: 1px solid #000; padding: 5px;">Poin Observasi</td>
					<td class="body_elemen">1</td>
					<td class="body_elemen">2</td>
					<td class="body_elemen">3</td>
					<td class="body_elemen">4</td>
					<td class="body_elemen">5</td>
					<td class="body_elemen">6</td>
					<td class="body_elemen">7</td>					
					<td class="body_elemen">8</td>
					<td class="body_elemen">9</td>
					<td class="body_elemen">10</td>

				</tr>';
		$aa[] = $value->elemen_kompetensi;
	}else{
		//echo $value->unit_kompetensi.'<br/>';
		echo '';

	}
		$table .='
		 	<tr style="border: 1px solid #000;">
		 		<td style="width: 60%;border: 1px solid #000; padding: 5px;">'.$value->elemen_kompetensi.'</td>	
		 		<td class="body_elemen"></td>	 		
				<td class="body_elemen"></td>
				<td class="body_elemen"></td>
				<td class="body_elemen"></td>
				<td class="body_elemen"></td>
				<td class="body_elemen"></td>
				<td class="body_elemen"></td>
				<td class="body_elemen"></td>
				<td class="body_elemen"></td>
				<td class="body_elemen"></td>		 		
		 	</tr>
		';			
	
}
$table .= '</table>';
echo $table;

?>    
</page>
<?php } ?>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo '/var/www/stpbandung/assets/img/logo48.png';?>" /></td>
                <td style="text-align: left;    width: 64%;font-weight: lighter;">
                    <?=$aplikasi->nama_unit?>
                </td>
                
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 21%"><?=$aplikasi->singkatan_unit?> :
                </td>
                <td style="text-align: left;    width: 49%"> <?=$aplikasi->alamat?> <?=$aplikasi->no_telpon?></td>
                <td style="text-align: right;    width: 30%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <label style="font-size: 16px; font-weight: bold;">PESERTA UJI KOMPETENSI</label>
    <table style="width: 100%; border-collapse: collapse;" border="1">
    	<tr>
    		<th style="width: 5%; padding: 5px;">NO</th>
    		<th style="width: 35%; padding: 5px;">NAMA LENGKAP</th>
    		<th style="width: 60%; padding: 5px;">CATATAN</th>
    	</tr>
    	<?php 
        
        for($ii=0;$ii<$jumlah_peserta;$ii++){ 
            //foreach ($asesi as $key => $value): ?>
        <tr style="height:70px;">
    		<td style="width: 5%;height: 20px; padding: 5px;text-align: center;"><?= ($ii+1) ?></td>
    		<td style="width: 35%; padding: 5px;"> </td>
    		<td style="width: 60%; padding: 5px;"></td>
    	</tr>    		
        <?php } ?>
    </table>
    <div align="left" style="margin-top: 15px; margin-left: 700px;">
    	<label style="font-size: 14px;"> Jakarta, ...................... </label>
    </div>
    <div align="left" style="margin-top: 75px; margin-left: 703px;">
    	<label style="font-size: 14px;"> (...........................) </label>
    </div>    
</page>	