
<style>
td,th{
    padding: 1mm;
}
</style>

<?php
foreach($daftar_bk as $key_bk=>$value_bk){
?>
<page backtop="12mm" backbottom="10mm" backleft="5mm" backright="15mm" ">
   
    <?php
    echo '<h2>'.$value_bk->nama_lengkap.'</h2>';
    $array_hasil_bk = unserialize($value_bk->mak04);
    ?>
<h4>UNIT KOMPETENSI</h4>
<?php
$noxx =1;
$no_urut=1;
$datax = '';
foreach($unit_kompetensi as $key=>$value){
    if(isset($array_hasil_bk[$key])){
        $kompeten = $array_hasil_bk[$key];    
    }else{
        $kompeten = 'K';
    }
    
    $datax .= '<tr height="500">
    <td style="width:5%;text-align:center"> '.$noxx.'  <br> </td>
    <td style="width:20%;"> '.$value->id_unit_kompetensi.'   <br> </td>
    <td style="width:60%;"> '.$value->unit_kompetensi.'   <br> </td>
    <td style="width:10%;text-align: center;"> '.$kompeten.'   <br> </td>';

        
    
$datax .='</tr>';
$noxx++;    
$no_urut++;
}
?> 

<table style="width:100%;" border="1" cellpadding="3" cellspacing="0" >
    <tr style="font-weight:bold;">
        <td style="width:5%;text-align: center;"> No </td>
        <td style="width:20%;text-align: center;"> KODE UNIT </td>
        <td style="width:60%;text-align: center;"> UNIT KOMPETENSI </td>
         <td style="width:10%;text-align: center;"> K/BK </td>
        
    </tr> 
    <?=$datax?>  
</table>

</page>
<?php
}
?>