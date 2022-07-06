<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" enctype="multipart/form-data" action="<?php echo $url ?>">
            <div id="tips">
    			<ol class="rounded-list">
    				<li><a href="javascript: void(0)">Profil Pribadi</a></li>
    			</ol>
    		</div>
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">No Identitas: </td>
                    <td>
                        <input type="hidden" id="u_date_create" name="u_date_create" value="<?php echo $data->u_date_create ?>">
                        <input type="hidden" id="skema_sertifikasi" name="skema_sertifikasi" value="<?php echo $data->skema_sertifikasi ?>" />
                        <input id="no_identitas" name="no_identitas" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->no_identitas ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">No UJK: </td>
                    <td>
                        <input readonly="true" id="no_uji_kompetensi" name="no_uji_kompetensi" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->no_uji_kompetensi ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Nama Lengkap: </td>
                    <td>
                        <input id="nama_lengkap" name="nama_lengkap" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->nama_lengkap ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Telpon : </td>
                    <td>
                        <input id="telp" name="telp" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->telp ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Email: </td>
                    <td>
                        <input id="skema" name="email" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->email ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Tempat Lahir: </td>
                    <td>
                        <input id="tempat_lahir" name="tempat_lahir" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->tempat_lahir ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Tanggal Lahir: </td>
                    <td>
                        <input id="tgl_lahir" name="tgl_lahir" style="width: 200px;" class="easyui-datebox" value="<?php echo date('d/m/Y', strtotime($data->tgl_lahir)) ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Jenis Kelamin: </td>
                    <td>
                        <?php echo form_dropdown('jenis_kelamin', $jenis_kelamin, $data->jenis_kelamin, 'id="jenis_kelamin" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Alamat: </td>
                    <td>
                        <textarea rows="4" cols="40" name="alamat" id="alamat" ><?php echo $data->alamat ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Pra Asesmen Checked: </td>
                    <td>
                        <input id="pra_asesmen_checked" name="pra_asesmen_checked" style="width: 200px;"  value="<?php echo $data->pra_asesmen_checked; ?>" readonly="true">
                    </td>
                </tr>
                
               
            </table>
            <div id="tips">
    			<ol class="rounded-list">
    				<li><a href="javascript: void(0)">Hasil Pra Asesmen</a></li>
    			</ol>
    		</div>
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">Rekomendasi Pra Asesmen: </td>
                    <td>
                    <?php
                        if($data->pra_asesmen =='1'){
                            $hasil_pra = 'Lanjut';
                        }else if($data->pra_asesmen =='2'){
                            $hasil_pra = '<b>Tidak Lanjut</b> (Perbaharui nama bukti pendukung atau Upload ulang pada revisi file bukti pendukung)';
                        }else{
                            $hasil_pra = 'Belum Ada Hasil';
                        }
                    ?>
                    <?=$hasil_pra?></td>
                </tr>
                <tr>
                    <td style="width: 150px;">Pra Asesmen Description: </td>
                    <input type="hidden" value="<?=$data->pra_asesmen_description?>" name="pra_asesmen_description" id="pra_asesmen_description" />
                    <td><?=$data->pra_asesmen_description?></td>
                </tr>
                
            </table>
             <div id="tips">
    			<ol class="rounded-list">
    				<li><a href="javascript: void(0)">Bukti-bukti Pendukung</a></li>
    			</ol>
    		</div>
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">Perbaharui Nama Bukti Pendukung (pisahkan dengan tanda baca koma ',' Contoh Ijazah,Sertifikat,CV ): </td>
                    <td><input type="text" value="<?=$jenis_bukti?>" class="easyui-textbox" id="nama_bukti_pendukung" style="width: 250px;"/>
                    <a id="reload_jenis_bukti" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-reload'" style="width:80px">Reload</a>
        
                        
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Bukti Pendukung: </td>
                    <td>
                        <a href="<?=base_url().'pra_asesmen/download/'.$data->id?>" target="_blank">Download</a>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Revisi File Bukti Pendukung: </td>
                    <td><?php
                            if($data->file_revisi_pra != ""){
                        ?>
                        <a href="<?=base_url().'pra_asesmen/download/'.$data->id.'/revisi'?>" target="_blank">Download</a>
                        <?php
                            }
                        ?>
                        
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 250px;" data-options="buttonText: 'Pilih File'">
                       
                        <input type="hidden" name="file_bukti_pendukung" value="<?=$data->file_bukti_pendukung?>" />
                        <input type="hidden" id="file_bukti_pendukung2"  name="file_bukti_pendukung2"/>
                    </td>
                </tr>
            </table>
            
            <div id="tips">
    			<ol class="rounded-list">
    				<li><a href="javascript: void(0)">Asesmen Mandiri / APL 02</a></li>
    			</ol>
    		</div>
          <style>
            #apl02asesi td,th{
                padding: 1mm;
            }
            </style>
            <table class="easyui-datagrid" style="width: 99%;" data-options="nowrap:false,striped:true,fitColumns:true">
            <thead>
                <tr><th data-options="field:'code4',align:'center'" style="width: 5%;">No</th>
                <th data-options="field:'code'" style="width: 52.5%;">KUK(Kriteria Unjuk Kerja)</th>
                <th data-options="field:'code1'" style="width: 32%;">Nama Bukti Pendukung</th>
                <th data-options="field:'code2',align:'center'" style="width: 5%;">K</th>
                <th data-options="field:'code3',align:'center'" style="width: 5%;">BK</th></tr>
            </thead>
            <tbody>
                <?php
                $option = array();
                foreach($detail_asesi as $key=>$value){
                    $s = $value['id'];
                    $k = $value['jenis_bukti'];
                    $combo =str_replace("jenis_bukti[]","jenis_bukti[$s]",$combo_jenis_bukti);
                    $combo =str_replace('<option value="'.$k.'">','<option value="'.$k.'" selected>',$combo);
                    //if($value['is_kompeten']=='k'){
                        echo '<tr><td>'.($key+1).'</td><td>'.$value['elemen'].'</td><td>'.$combo.'</td><td><input type="radio" class="is_kompeten" name="is_kompeten['.$s.']" '.($value['is_kompeten']=="k"?"checked='true'":"").' value="k"/></td><td><input type="radio" class="is_kompeten" name="is_kompeten['.$s.']" '.($value['is_kompeten']=="bk"?"checked='true'":"").' value="bk"/></td></tr>';    
                    //}else{
                      //  echo '<tr><td>'.($key+1).'</td><td>'.$value['elemen'].'</td><td>'.$combo.'</td><td><input type="radio" name="is_kompeten['.$value['id'].']" value="k" /></td><td><input value="bk" type="radio" name="is_kompeten['.$value['id'].']" checked /></td></tr>';
                    //}
                }
                ?>   
            </tbody> 
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
<?php
echo $pra_asesmen_grid;
?>
$(function(){
     $('#reload_jenis_bukti').click(function(){
        $('.jenis_bukti option').remove();
        var nama_bukti_pendukung = $('#nama_bukti_pendukung').val();
        var array_nama_bukti_pendukung = nama_bukti_pendukung.split(',');
        //console.log(array_nama_bukti_pendukung);
        $.each(array_nama_bukti_pendukung, function( index, value ) {
          $('.jenis_bukti').append($('<option>', {value:value, text:value}));
        });
        
        alert('Reload Jenis Bukti');
})
    
})
var nama_asesor = '<?php echo $nama_asesor?>';
var id_asesor = '<?php echo $data->pra_asesmen_checked?>';
//console.log(id_asesor);
if(id_asesor != '0'){
    $("#pra_asesmen_checked").combogrid('setValue',{id:id_asesor,nama_user:nama_asesor});
}
</script>