<style media="screen">
  .textarea-tb{
    border: 1px solid #95B8E7;
    border-radius: 5px;
    vertical-align:middle;
  }
</style>

<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">

          <div id="tips">
              <ol class="rounded-list">
                  <li>
                    <a href="javascript: void(0)">
                      <b>INFORMASI MERCHANT</b>
                    </a>
                  </li>
              </ol>
          </div>

          <table class="table-data">
              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">
                    Nama Perusahaan <br>
                    <font style="font-size:10px;"> (Nama Toko) </font>
                  </td>
                  <td>
                      : <?=$data->member?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">
                    Alamat Perusahaan <br>
                    <font style="font-size:10px;"> (Alamat Toko) </font>
                  </td>
                  <td>
                      : <?=$data->alamat_member?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">NPWP</td>
                  <td>
                      : <?=$data->npwp_member?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">
                    No Tlp Perusahaan <br>
                    <font style="font-size:10px;"> (no telepon toko) </font>
                  </td>
                  <td>
                      : <?=$data->tlp_member?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">
                    Alamat Warehouse
                  </td>
                  <td>
                      : <?=$data->alamat_warehouse?>
                  </td>
              </tr>
          </table>

          <div id="tips">
              <ol class="rounded-list">
                  <li>
                    <a href="javascript: void(0)">
                      <b>DATA BANK PEMBAYARAN</b>
                    </a>
                  </li>
              </ol>
          </div>

          <table class="table-data">
              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">Nama Bank</td>
                  <td>
                      : <?=$detail_member->nama_bank?>
                  </td>
              </tr>
              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">No Rekening</td>
                  <td>
                      : <?=$detail_member->norek_bank?>
                  </td>
              </tr>
              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">Nama Pemilik</td>
                  <td>
                      : <?=$detail_member->nama_pemilik_bank?>
                  </td>
              </tr>
              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">Cabang</td>
                  <td>
                      : <?=$detail_member->cabang_bank?>
                  </td>
              </tr>
          </table>

          <div id="tips">
              <ol class="rounded-list">
                  <li>
                    <a href="javascript: void(0)">
                      <b>INFORMASI BAGIAN KEUANGAN</b>
                    </a>
                  </li>
              </ol>
          </div>

            <table class="table-data">
                <tr>
                    <td style="width: 180px;text-align:left;padding-left:40px;">Nama PIC</td>
                    <td>
                        : <?=$detail_member->nama_pic?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;text-align:left;padding-left:40px;">Jabatan PIC</td>
                    <td>
                        : <?=$detail_member->jabatan_pic?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;text-align:left;padding-left:40px;">HP PIC</td>
                    <td>
                        : <?=$detail_member->hp_pic?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;text-align:left;padding-left:40px;">Email PIC</td>
                    <td>
                        : <?=$data->email_member?>
                    </td>
                </tr>
            </table>

            <div id="tips">
                <ol class="rounded-list">
                    <li>
                      <a href="javascript: void(0)">
                        <b>File Dokumen</b>
                      </a>
                    </li>
                </ol>
            </div>

            <table>
              <?php
                $total_fm = count($file_member);

                if ($total_fm > 0) {

                foreach ($file_member as $key => $files) {
                  $linkFile = "<a href='javascript:void(0);' onclick='buka(\"" . @$files->nama_file . "\");'> Lihat " . limit_string($files->nama_dokumen,10) . "</a>";
              ?>

              <tr>
                <td style="width: 180px;text-align:left;padding-left:40px;"><?=strtoupper($files->nama_dokumen)?></td>
                <td>
                  : <?=$linkFile?>
                </td>
              </tr>

              <?php
                  };

                }else {
                  echo "<div style='text-align:center;color:red;'>FILE DOKUMEN BELUM DIUPLOAD</div>";
                }
              ?>
            </table>

        </form>
    </div>
</div>

<div id="vFile" >
    <input type="hidden">
</div>

<script type="text/javascript">

  var idMember = '<?=$data->id?>';

  $(document).ready(function(){
    upload_file_ajax("member/upload_ajax/npwp/"+idMember,"npwp","npwp");
    upload_file_ajax("member/upload_ajax/ktp/"+idMember,"ktp","ktp");
    upload_file_ajax("member/upload_ajax/nib/"+idMember,"nib","nib");
  });

  var baseUrl = '<?=base_url()?>';

  function upload_file_ajax (toUrl,stringDiv,stringReturnName){
   $('#'+stringDiv).on('change', function (e) {

       //alert(stringDiv);
       e.preventDefault();
       var urlTarget = baseUrl+toUrl;
       var f = $('#'+stringDiv);
       var listFiles = f[0].files;
       var formData = new FormData();
       formData.append('file', listFiles[0]);
       // $('#myOverlay').show();
       // $('#loadingGIF').show();
       $.ajax({
         url: urlTarget+'/'+stringDiv,
         type: 'POST',
         data: formData,
         processData: false,
         contentType: false,
         success: function (data) {
          data = JSON.parse(data);
          if(data.error){
           // $('#myOverlay').hide();
           // $('#loadingGIF').hide();
           $(stringDiv+"div").val("");
           alert(data.error);
           //alert('dasd');
       }else{
           var txt = "<div style='padding-left:10px;'><b onclick='hapusFile($(this))' style='cursor:pointer;color:red;'>Hapus</b> <input type='text' name='file_upload[]' class='form-control input-field' value='" + data.upload_data.file_name + "' readonly /><input type='hidden' name='jenis_file[]' value='"+stringDiv+"' /></div>";
           $("#"+stringDiv+"div").append(txt);
           // $('#myOverlay').hide();
           // $('#loadingGIF').hide();
       }
   },
   error: function (request, status, error) {
      alert(request.responseText);
      // $('#myOverlay').hide();
      // $('#loadingGIF').hide();
  }
});
       return false;
   });
}

function hapusFile(e){
 // $('#myOverlay').show();
 // $('#loadingGIF').show();
 objectSebelumnya = e.next();
     //console.log(objectSebelumnya[0].value);

     $.ajax({
      url: baseUrl+'member/hapus_file',
      type: 'POST',
      data: 'nama_file='+objectSebelumnya[0].value,
      success: function () {
         $('#myOverlay').hide();
         $('#loadingGIF').hide();
         return false;
     },
     error: function (request, status, error) {
         alert(request.responseText);
         $('#myOverlay').hide();
         $('#loadingGIF').hide();
     }
 });
     objectBerikutnya = objectSebelumnya.next();
     objectSebelumnya.remove();
     objectBerikutnya.remove();
     e.remove();
 }


 function buka(data) {
     $('#vFile').empty();
     $('#vFile').dialog({
         title: 'View File ' + data,
         width: 900,
         height: 500,
         closed: true,
         cache: false,
         modal: true
     });

     $('#vFile').dialog('open');
     $('#vFile').dialog('refresh', baseUrl + 'member/show_file?nmfile=' + data);
             //return false;
  }

</script>
