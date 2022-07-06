<style>
td,th{
    padding: 1mm;
}
</style>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm" ">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
                <td style="text-align: left;    width: 34%;font-weight: lighter;"><?=$aplikasi->nama_unit?></td>
                
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 20%"><?=$aplikasi->singkatan_unit?> :
                </td>
                <td style="text-align: left;    width: 35%"> <?=$aplikasi->alamat?> <?=$aplikasi->no_telpon?></td>
                <td style="text-align: right;    width: 45%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <h4> DATA PERMOHONAN UJI KOMPETENSI </h4>
	<table style="width:100%;font-size: 11px;" border="1" cellpadding="1" cellspacing="1">
    <tr><th>Nama Lengkap</th><th>NO Uji Kompetensi</th><th>Telpon</th>
    <th>Email</th><th>Skema</th><th>Tanggal Registrasi</th></tr>
     <?php
        foreach($data_asesi as $value){
            echo '<tr>
            <td style="width:20%;">'.$value->nama_lengkap.'</td>
            <td style="width:15%;text-align:center;">'.$value->no_uji_kompetensi.'</td>
            <td style="width:15%;">'.$value->telp.'</td>
            <td style="width:20%;">'.$value->email.'</td>
            <td style="width:15%;">'.$value->skema.'</td>
            <td style="width:15%;">'.$value->u_date_create.'</td></tr>';
        }
        ?>
     </table>
</page>    
