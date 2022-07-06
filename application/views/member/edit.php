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
                      : <input id="member" name="member" value="<?=$data->member?>" style="width: 300px;" class="easyui-textbox" data-options="required: true">
                      <input type="hidden" name="id_group_member" value="9">
                  </td>
              </tr>

              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">
                    Alamat Perusahaan <br>
                    <font style="font-size:10px;"> (Alamat Toko) </font>
                  </td>
                  <td>
                      <!-- : <input id="alamat_member" name="alamat_member" style="width: 300px;" class="easyui-textbox" data-options="required: true"> -->
                      : <textarea id="alamat_member" name="alamat_member" class="textarea-tb" style="width: 300px;" rows="3"><?=$data->alamat_member?></textarea>
                  </td>
              </tr>

              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">NPWP</td>
                  <td>
                      : <input id="npwp_member" name="npwp_member" value="<?=$data->npwp_member?>" style="width: 300px;" class="easyui-numberbox" data-options="required: true">
                      <input type="hidden" name="id_province_member" value="<?=$data->id_province_member?>">
                      <input type="hidden" name="id_kabupaten_member" value="<?=$data->id_kabupaten_member?>">
                  </td>
              </tr>

              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">
                    No Tlp Perusahaan <br>
                    <font style="font-size:10px;"> (no telepon toko) </font>
                  </td>
                  <td>
                      : <input id="tlp_member" name="tlp_member" value="<?=$data->tlp_member?>" style="width: 300px;" class="easyui-textbox" data-options="required: true">
                  </td>
              </tr>

              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">
                    Alamat Warehouse
                  </td>
                  <td>
                      <!-- : <input id="alamat_warehouse" name="alamat_warehouse" style="width: 300px;" class="easyui-textbox"> -->
                      : <textarea id="alamat_warehouse" name="alamat_warehouse" class="textarea-tb" style="width: 300px;" rows="3"><?=$data->alamat_warehouse?></textarea>
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
                      : <input id="nama_bank" name="nama_bank" value="<?=$detail_member->nama_bank?>" style="width: 300px;" class="easyui-textbox" data-options="required: true">
                  </td>
              </tr>
              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">No Rekening</td>
                  <td>
                      : <input id="norek_bank" name="norek_bank" value="<?=$detail_member->norek_bank?>" style="width: 300px;" class="easyui-numberbox" >
                  </td>
              </tr>
              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">Nama Pemilik</td>
                  <td>
                      : <input id="nama_pemilik_bank" name="nama_pemilik_bank" value="<?=$detail_member->nama_pemilik_bank?>" style="width: 300px;" class="easyui-textbox" >
                  </td>
              </tr>
              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">Cabang</td>
                  <td>
                      : <input id="cabang_bank" name="cabang_bank" value="<?=$detail_member->cabang_bank?>" style="width: 300px;" class="easyui-textbox" >
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
                        : <input id="nama_pic" name="nama_pic" value="<?=$detail_member->nama_pic?>" style="width: 300px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;text-align:left;padding-left:40px;">Jabatan PIC</td>
                    <td>
                        : <input id="jabatan_pic" name="jabatan_pic" value="<?=$detail_member->jabatan_pic?>" style="width: 300px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;text-align:left;padding-left:40px;">HP PIC</td>
                    <td>
                        : <input id="hp_pic" name="hp_pic" value="<?=$detail_member->hp_pic?>" style="width: 300px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;text-align:left;padding-left:40px;">Email PIC</td>
                    <td>
                        : <input id="email_member" name="email_member" value="<?=$data->email_member?>" style="width: 300px;" class="easyui-textbox" data-options="required: true">
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
                foreach ($file_member as $key => $files) {
                  $linkFile = "<a href='javascript:void(0);' onclick='buka(\"" . @$files->nama_file . "\");'> Lihat " . limit_string($files->nama_dokumen,10) . "</a>";
              ?>

              <tr>
                <td style="width: 180px;text-align:left;padding-left:40px;"><?=strtoupper($files->nama_dokumen)?></td>
                <td>
                  : <b onclick='hapusFile($(this))' style='cursor:pointer;color:red;'>Hapus</b> | <input type='hidden' name='file_upload[]' class='form-control input-field' value='<?=$files->nama_file?>' /> <?=$linkFile?>
                </td>
              </tr>

              <?php } ?>
            </table>

            <div id="tips">
                <ol class="rounded-list">
                    <li>
                      <a href="javascript: void(0)">
                        <b>Unggah Dokumen</b>
                      </a>
                    </li>
                </ol>
            </div>

            <table class="table-data">
              <tr>
                <td style="width: 180px;text-align:left;padding-left:40px;border-bottom: 1px solid #999;">NPWP</td>
                <td style="border-bottom: 1px solid #999;">
                  : <input accept="image/*" type="file" id="npwp" class="form-control input-sm uploadData" required />
                  <div id="npwpdiv"></div>
                </td>
              </tr>

              <tr>
                <td style="width: 180px;text-align:left;padding-left:40px;border-bottom: 1px solid #999;">KTP</td>
                <td style="border-bottom: 1px solid #999;">
                  : <input accept="image/*" type="file" id="ktp" class="form-control input-sm uploadData" required />
                  <div id="ktpdiv"></div>
                </td>
              </tr>

              <tr style="">
                <td style="width: 180px;text-align:left;padding-left:40px;border-bottom: 1px solid #999;">NIB</td>
                <td style="border-bottom: 1px solid #999;">
                  : <input accept="image/*" type="file" id="nib" class="form-control input-sm uploadData" required />
                  <div id="nibdiv"></div>
                </td>
              </tr>
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
