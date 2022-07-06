<style>
#table_mak05 td,th{
    padding: 1mm;
}
</style>
<table id="table_mak05" style="width:97.5%;font-size: 11px;border-collapse: collapse;" border="1">
  <tr align="center">
    <td rowspan="2" style="width:45%;">Komponen</td>
    <td colspan="2" style="width:16%;">Hasil</td>
    <td rowspan="2" style="width:49%;">Catatan / Komentar Asesi</td>
  </tr>
  
  <tr align="center">
    <td style="width:8%;text-align: center;">Ya</td>
    <td style="width:8%;text-align: center;">Tidak</td>
  </tr>
  
  <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">1. </td>
        <td style="width:95%;">Saya mendapatkan penjelasan yang cukup memadai mengenai proses asesmen/uji kompetensi </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;text-align: center;">
     <input hidden type="radio" name="mak05[0]" value="1" <?=(isset($mak05[0]) && $mak05[0]=='1'?'checked':'')?>/>
     <?=(isset($mak05[0]) && $mak05[0]=='1'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?></td>
    <td style="width:8%;text-align: center;"> 
    <input hidden type="radio" name="mak05[0]" value="0" <?=(isset($mak05[0]) && $mak05[0]=='0'?'checked':'')?>/>
     <?=(isset($mak05[0]) && $mak05[0]=='0'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?>
     </td>
    <td style="width:49%;"><textarea hidden name="mak05a[0]" style="width: 100%;height: 100%;"><?=(isset($mak05a[0])?$mak05a[0]:'')?></textarea>
    <?=(isset($mak05a[0])?$mak05a[0]:'')?></td>
   </tr>
   <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">2. </td>
        <td style="width:95%;">Asesor memberikan kesempatan untuk mendiskusikan/ menegosiasikan metoda, 
        instrumen dan sumber asesmen serta jadwal asesmen </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;text-align: center;"><?=(isset($mak05[1]) && $mak05[1]=='1'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?>
     <input hidden type="radio" name="mak05[1]" value="1" <?=(isset($mak05[1]) && $mak05[1]=='1'?'checked':'')?>/></td>
    <td style="width:8%;text-align: center;"><?=(isset($mak05[1]) && $mak05[1]=='0'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?>
    <input hidden type="radio" name="mak05[1]" value="0" <?=(isset($mak05[1]) && $mak05[1]=='0'?'checked':'')?>/></td>
    <td style="width:49%;"><?=(isset($mak05a[1])?$mak05a[1]:'')?>
    <textarea hidden name="mak05a[1]" style="width: 100%;height: 100%;"><?=(isset($mak05a[1])?$mak05a[1]:'')?></textarea></td>
   </tr>
   <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">3. </td>
        <td style="width:95%;">Asesor berusaha menggali seluruh bukti pendukung yang sesuai dengan latar belakang pelatihan dan pengalaman yang saya miliki </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;text-align: center;"><?=(isset($mak05[2]) && $mak05[2]=='1'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?><input hidden type="radio" name="mak05[2]" value="1" <?=(isset($mak05[2]) && $mak05[2]=='1'?'checked':'')?>/></td>
    <td style="width:8%;text-align: center;"><?=(isset($mak05[2]) && $mak05[2]=='0'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?><input hidden type="radio" name="mak05[2]" value="0" <?=(isset($mak05[2]) && $mak05[2]=='0'?'checked':'')?>/></td>
    <td style="width:49%;"><?=(isset($mak05a[2])?$mak05a[2]:'')?><textarea hidden name="mak05a[2]" style="width: 100%;height: 100%;"><?=(isset($mak05a[2])?$mak05a[2]:'')?></textarea></td>
   </tr>
  <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">4. </td>
        <td style="width:95%;">Saya mendapatkan jaminan kerahasiaan hasil asesmen serta penjelasan penanganan dokumen asesmen </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;text-align: center;"><?=(isset($mak05[3]) && $mak05[3]=='1'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?><input hidden type="radio" name="mak05[3]" value="1" <?=(isset($mak05[3]) && $mak05[3]=='1'?'checked':'')?>/></td>
    <td style="width:8%;text-align: center;"><?=(isset($mak05[3]) && $mak05[3]=='0'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?><input hidden type="radio" name="mak05[3]" value="0" <?=(isset($mak05[3]) && $mak05[3]=='0'?'checked':'')?>/></td>
    <td style="width:49%;"><?=(isset($mak05a[3])?$mak05a[3]:'')?><textarea hidden name="mak05a[3]" style="width: 100%;height: 100%;"><?=(isset($mak05a[3])?$mak05a[3]:'')?></textarea></td>
   </tr>
   <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">5. </td>
        <td style="width:95%;">Saya sepenuhnya diberikan kesempatan untuk mendemonstrasikan kompetensi yang saya miliki selama asesmen </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;text-align: center;"><?=(isset($mak05[4]) && $mak05[4]=='1'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?><input hidden type="radio" name="mak05[4]" value="1" <?=(isset($mak05[4]) && $mak05[4]=='1'?'checked':'')?>/></td>
    <td style="width:8%;text-align: center;"><?=(isset($mak05[4]) && $mak05[4]=='0'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?><input hidden type="radio" name="mak05[4]" value="0" <?=(isset($mak05[4]) && $mak05[4]=='0'?'checked':'')?>/></td>
    <td style="width:49%;"><?=(isset($mak05a[4])?$mak05a[4]:'')?><textarea hidden name="mak05a[4]" style="width: 100%;height: 100%;"><?=(isset($mak05a[4])?$mak05a[4]:'')?></textarea></td>
   </tr>
   <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">6. </td>
        <td style="width:95%;">Saya mendapatkan penjelasan yang memadai mengenai keputusan asesmen </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;text-align: center;"><?=(isset($mak05[5]) && $mak05[5]=='1'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?><input hidden type="radio" name="mak05[5]" value="1" <?=(isset($mak05[5]) && $mak05[5]=='1'?'checked':'')?>/></td>
    <td style="width:8%;text-align: center;"><?=(isset($mak05[5]) && $mak05[5]=='0'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?><input hidden type="radio" name="mak05[5]" value="0" <?=(isset($mak05[5]) && $mak05[5]=='0'?'checked':'')?>/></td>
    <td style="width:49%;"><?=(isset($mak05a[5])?$mak05a[5]:'')?><textarea hidden name="mak05a[5]" style="width: 100%;height: 100%;"><?=(isset($mak05a[5])?$mak05a[5]:'')?></textarea></td>
   </tr>
   <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">7. </td>
        <td style="width:95%;">Asesor memberikan umpan balik yang mendukung setelah asesmen serta tindak lanjutnya </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;text-align: center;"><?=(isset($mak05[6]) && $mak05[6]=='1'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?><input hidden type="radio" name="mak05[6]" value="1" <?=(isset($mak05[6]) && $mak05[6]=='1'?'checked':'')?>/></td>
    <td style="width:8%;text-align: center;"><?=(isset($mak05[6]) && $mak05[6]=='0'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?><input hidden type="radio" name="mak05[6]" value="0" <?=(isset($mak05[6]) && $mak05[6]=='0'?'checked':'')?>/></td>
    <td style="width:49%;"><?=(isset($mak05a[6])?$mak05a[6]:'')?><textarea hidden name="mak05a[6]" style="width: 100%;height: 100%;"><?=(isset($mak05a[6])?$mak05a[6]:'')?></textarea></td>
   </tr>
   <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">8. </td>
        <td style="width:95%;">Asesor menggunakan keterampilan komunikasi yang efektif selama asesmen </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;text-align: center;"><?=(isset($mak05[7]) && $mak05[7]=='1'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?><input hidden type="radio" name="mak05[7]" value="1" <?=(isset($mak05[7]) && $mak05[7]=='1'?'checked':'')?>/></td>
    <td style="width:8%;text-align: center;"><?=(isset($mak05[7]) && $mak05[7]=='0'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?><input hidden type="radio" name="mak05[7]" value="7" <?=(isset($mak05[7]) && $mak05[7]=='0'?'checked':'')?>/></td>
    <td style="width:49%;"><?=(isset($mak05a[7])?$mak05a[7]:'')?><textarea hidden name="mak05a[7]" style="width: 100%;height: 100%;"><?=(isset($mak05a[7])?$mak05a[7]:'')?></textarea></td>
   </tr>
    <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">9. </td>
        <td style="width:95%;">Asesor bersama saya menandatangani semua dokumen hasil asesmen </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;text-align: center;"><?=(isset($mak05[8]) && $mak05[8]=='1'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?><input hidden type="radio" name="mak05[8]" value="1" <?=(isset($mak05[8]) && $mak05[8]=='1'?'checked':'')?>/></td>
    <td style="width:8%;text-align: center;"><?=(isset($mak05[8]) && $mak05[8]=='0'?'<i class="icons-check"></i>':'<i class="icons-no_check"></i>')?><input hidden type="radio" name="mak05[8]" value="0" <?=(isset($mak05[8]) && $mak05[8]=='0'?'checked':'')?>/></td>
    <td style="width:49%;"><?=(isset($mak05a[8])?$mak05a[8]:'')?><textarea hidden name="mak05a[8]" style="width: 100%;height: 100%;"><?=(isset($mak05a[8])?$mak05a[8]:'')?></textarea></td>
   </tr>
</table>