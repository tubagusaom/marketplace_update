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
                      : <input id="member" name="member" style="width: 300px;" class="easyui-textbox" data-options="required: true">
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
                      : <textarea id="alamat_member" name="alamat_member" class="textarea-tb" style="width: 300px;" rows="3"></textarea>
                  </td>
              </tr>

              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">
                    Provinsi <br>
                    <font style="font-size:10px;"> (Provinsi Toko) </font>
                  </td>
                  <td>
                      <!-- : <input id="id_province_member" name="id_province_member" style="width: 300px;" class="easyui-textbox" data-options="required: true"> -->
                      <!-- : <input data-options="required: true" id="id_province_member" name="id_province_member" style="width: 300px;" > -->
                      <!-- : <textarea id="alamat_member" name="alamat_member" name="name" class="textarea-tb" style="width: 300px;" rows="3"></textarea> -->
                      : <?php echo form_dropdown('id_province_member', $province,'', 'id="id_province_member" style="width:300px;" class="easyui-combobox"  data-options="required: true"'); ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">
                    Kota / Kabupaten <br>
                    <font style="font-size:10px;"> (Kota / Kabupaten Toko) </font>
                  </td>
                  <td>
                      : <?php echo form_dropdown('id_kota_member', $kota,'', 'id="id_kota_member" style="width:300px;" class="easyui-combobox"  data-options="required: true"'); ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">NPWP</td>
                  <td>
                      : <input id="npwp_member" name="npwp_member" style="width: 300px;" class="easyui-numberbox" data-options="required: true">
                  </td>
              </tr>

              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">
                    No Tlp Perusahaan <br>
                    <font style="font-size:10px;"> (no telepon toko) </font>
                  </td>
                  <td>
                      : <input id="tlp_member" name="tlp_member" style="width: 300px;" class="easyui-textbox" data-options="required: true">
                  </td>
              </tr>

              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">
                    Alamat Warehouse
                  </td>
                  <td>
                      <!-- : <input id="alamat_warehouse" name="alamat_warehouse" style="width: 300px;" class="easyui-textbox"> -->
                      : <textarea id="alamat_warehouse" name="alamat_warehouse" name="name" class="textarea-tb" style="width: 300px;" rows="3"></textarea>
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
                      : <input id="nama_bank" name="nama_bank" style="width: 300px;" class="easyui-textbox" data-options="required: true">
                  </td>
              </tr>
              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">No Rekening</td>
                  <td>
                      : <input id="norek_bank" name="norek_bank" style="width: 300px;" class="easyui-numberbox" >
                  </td>
              </tr>
              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">Nama Pemilik</td>
                  <td>
                      : <input id="nama_pemilik_bank" name="nama_pemilik_bank" style="width: 300px;" class="easyui-textbox" >
                  </td>
              </tr>
              <tr>
                  <td style="width: 180px;text-align:left;padding-left:40px;">Cabang</td>
                  <td>
                      : <input id="cabang_bank" name="cabang_bank" style="width: 300px;" class="easyui-textbox" >
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
                        : <input id="nama_pic" name="nama_pic" style="width: 300px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;text-align:left;padding-left:40px;">Jabatan PIC</td>
                    <td>
                        : <input id="jabatan_pic" name="jabatan_pic" style="width: 300px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;text-align:left;padding-left:40px;">HP PIC</td>
                    <td>
                        : <input id="hp_pic" name="hp_pic" style="width: 300px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;text-align:left;padding-left:40px;">Email PIC</td>
                    <td>
                        : <input id="email_member" name="email_member" style="width: 300px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<script type="text/javascript">

<?php
  // echo $province;
?>

// $('#div_kabupaten').hide();

// $("#id_province_member").change(function (){
//
//   var valProv = $("#id_province_member").val();
//   // alert(valProv);
//
//   if (valProv === '') {
//     $('#div_kabupaten').hide();
//   }else {
//     var url = "<?php echo site_url('welcome/get_kota');?>/"+$(this).val();
//     $('#id_kabupaten').load(url);
//     $('#div_kabupaten').show();
//     return false;
//   }
//
// });

// $('#id_province_member').combogrid({
//
//     onChange: function(newVal, oldVal){
//
//     $.ajax({
//         url:'<?php echo base_url(); ?>soal/get_unit',
//         method:'POST',
//         data:{id:newVal},
//         dataType:'JSON',
//         success:function(data){
//             var html = '<div id="select_unit"><select required class="form-control" name="id_unit_kompetensi" id="id_unit_kompetensi">';
//             var i;
//             for(i=0; i<data.length; i++){
//                 html += '<option value="'+data[i].id+'">'+data[i].unit_kompetensi+'</option>';
//             }
//             html += '</select></div>';
//
//             $('#select_unit').remove();
//             $('#div_select_unit').append(html);
//         }
//     });
//
//
//
//     }
// });

</script>
