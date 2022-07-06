<style>
#table_mak02 td,th{
    padding: 1mm;
}
</style>
<?php
if(isset($mak02[0]) && $mak02[0]=='1'){
    $iconmak1 = '<i class="icons-check"></i>';
    $iconmak1a = '<i class="icons-no_check"></i>';
}else{
    $iconmak1 = '<i class="icons-no_check"></i>';
    $iconmak1a = '<i class="icons-check"></i>';
}
if(isset($mak02[1]) && $mak02[1]=='1'){
    $iconmak2 = '<i class="icons-check"></i>';
    $iconmak2a = '<i class="icons-no_check"></i>';
}else{
    $iconmak2 = '<i class="icons-no_check"></i>';
    $iconmak2a = '<i class="icons-check"></i>';
}
if(isset($mak02[2]) && $mak02[2]=='1'){
    $iconmak3 = '<i class="icons-check"></i>';
    $iconmak3a = '<i class="icons-no_check"></i>';
}else{
    $iconmak3 = '<i class="icons-no_check"></i>';
    $iconmak3a = '<i class="icons-check"></i>';
}
?>
<table id="table_mak02" style="width:97.5%;font-size: 11px;border-collapse: collapse;" border="1">
                <tr style="text-align:center;">
                <th style="width: 70%;">Jawablah dengan Ya atau Tidak pertanyaan-pertanyaan berikut ini :</th>
                <th style="width: 10%;">Y</th>
                <th style="width: 10%;">N</th>
                </tr>
	<tr>
		<td style="width: 78%;"> Apakah Proses Banding telah dijelaskan kepada Anda? </td>
        <td  style="width: 10%;text-align: center;"><input hidden type="radio" name="mak02[0]" value="1" <?=(isset($mak02[0]) && $mak02[0]=='1'?'checked':'')?>/><?=$iconmak1?></td>
        <td  style="width: 10%;text-align: center;"><input hidden type="radio" name="mak02[0]" value="0" <?=(isset($mak02[0]) && $mak02[0]=='0'?'checked':'')?>/><?=$iconmak1a?></td>
    </tr>
    <tr>
		<td> Apakah Anda telah mendiskusikan Banding dengan Asesor? </td>
        <td style="width: 10%;text-align: center;"><input hidden type="radio" name="mak02[1]" value="1" <?=(isset($mak02[1]) && $mak02[1]=='1'?'checked':'')?>/><?=$iconmak2?></td>
        <td style="width: 10%;text-align: center;"><input hidden type="radio" name="mak02[1]" value="0" <?=(isset($mak02[1]) && $mak02[1]=='0'?'checked':'')?>/><?=$iconmak2a?></td>
    </tr>
    <tr>
		<td> Apakah Anda mau melibatkan 'orang lain' membantu Anda dalam Proses Banding? </td>
        <td style="width: 10%;text-align: center;"><input hidden type="radio" name="mak02[2]" value="1" <?=(isset($mak02[2]) && $mak02[2]=='1'?'checked':'')?>/><?=$iconmak3?></td>
        <td style="width: 10%;text-align: center;"><input hidden type="radio" name="mak02[2]" value="0" <?=(isset($mak02[2]) && $mak02[2]=='0'?'checked':'')?>/><?=$iconmak3a?></td>
    </tr>
    <tr>
		<td colspan="3"> Banding ini diajukan atas Keputusan Asesmen yang dibuat terhadap Unit Kompetensi berikut : </td>
    </tr>
     <tr>
	 <td colspan="3">
            <select name="mak02a[]" style="width: auto;" multiple hidden >
                <?php
                
                    foreach($unit_kompetensi as $key=>$value){
                        echo('<option '.(in_array($value->id_unit_kompetensi,$mak02a)?'selected':'').' value="'.$value->id_unit_kompetensi.'">'.($key+1).'. '.$value->unit_kompetensi.'</option>');        
                    }
                ?>
            </select><?=(is_array($mak02a)?implode(',',$mak02a):'')?>
        </td>
        
    </tr>
</table>