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
                <td style="text-align: left;    width: 44%;font-weight: lighter;">Lembaga Sertifikasi Profesi Home Depo</td>
                
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 20%">LSP Home Depo :
                </td>
                <td style="text-align: left;    width: 35%"> Komplek PTB Blok I/Q No.12 Jln. Kelapa Dua Wetan, Ciracas 021-29383868</td>
                <td style="text-align: right;    width: 45%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
<h4>BERITA ACARA PELAKSANAAN UJI KOMPETENSI</h4>
<table style="width:97%;border-collapse: collapse;" border="1"  >
    <thead>
        <tr><th style="width: 52%;">Nama Peserta Uji</th>
        <th style="width: 25%;">Rekomendasi Asesor</th>
        <th style="width: 15%;">Sertifikat</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($asesi_kompeten as $value){
                if($value->rekomendasi_asesor=='1'){
                    $rekomendasi = 'Kompeten';
                }else if($value->rekomendasi_asesor=='2'){
                    $rekomendasi = 'Belum Kompeten';
                }else{
                    $rekomendasi = '-';
                }
                echo '<tr><td>'.$value->nama_lengkap.'</td><td>'.$rekomendasi.'</td>
                <td style="text-align:center;">
                </td>
                </tr>';    
            }
        ?>   
    </tbody> 
    </table>
</page>