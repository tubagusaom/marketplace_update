<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <div id="tips">
    			<ol class="rounded-list">
    				<li><a href="javascript: void(0)">Biodata Peserta / APL 01</a></li>
    			</ol>
    		</div>
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">No Identitas: </td>
                    <td>
                    
                    <input type="hidden" id="u_date_create" name="u_date_create" value="<?php echo $data->u_date_create ?>">
                    <input type="hidden" id="skema_sertifikasi" name="skema_sertifikasi" value="<?php echo $data->skema_sertifikasi ?>">
                    <input type="hidden" id="pra_asesmen_checked" name="pra_asesmen_checked" value="<?php echo $data->pra_asesmen_checked ?>">
                        <input id="no_identitas" name="no_identitas" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->no_identitas ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">No UJK: </td>
                    <td>
                        <input id="no_uji_kompetensi" name="no_uji_kompetensi" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->no_uji_kompetensi ?>">
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
                    <td style="width: 150px;">File Bukti Pendukung: </td>
                    <td><a href="<?php echo $data->link_download_bukti_pendukung ?>" target="_blank">Download</a>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Pra Asesmen Date: </td>
                    <td>
                        <input id="pra_asesmen_date" name="pra_asesmen_date" style="width: 200px;" class="easyui-datebox" value="<?php echo date('d/m/Y', strtotime($data->pra_asesmen_date)) ?>">
                    </td>
                </tr>
                 
                <tr>
                    <td style="width: 150px;">Hasil Pra Asesmen : </td>
                    <td>
                        <?php echo form_dropdown('pra_asesmen', $pra_asesmen, $data->pra_asesmen, 'id="pra_asesmen" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Pra Asesmen Description : </td>
                    <td>
                        <textarea rows="4" cols="40" name="pra_asesmen_description" id="pra_asesmen_description" ><?php echo $data->pra_asesmen_description ?></textarea>
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
            <table id="apl02asesi"  style="width:97.5%;font-size: 11px;border-collapse: collapse;" border="1">
            <thead>
                <tr><th data-options="field:'code'" style="width: 40%;">KUK(Kriteria Unjuk Kerja)</th>
                <th data-options="field:'code1'" style="width: 27%;">Jenis Bukti</th>
                <th style="width: 5%;text-align: center;">K</th>
                <th style="width: 5%;text-align: center;">BK</th>
                <th style="width: 5%;text-align: center;" >V</th>
                <th style="width: 5%;text-align: center;">A</th>
                <th style="width: 5%;text-align: center;">T</th>
                <th style="width: 5%;text-align: center;">M</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($detail_asesi as $value){
                    if($value['v'] == '1'){
                        $checkedv = 'checked';
                    }else{
                        $checkedv = '';
                    }
                    if($value['a'] == '1'){
                        $checkeda = 'checked';
                    }else{
                        $checkeda = '';
                    }
                    if($value['t'] == '1'){
                        $checkedt = 'checked';
                    }else{
                        $checkedt = '';
                    }
                    if($value['m'] == '1'){
                        $checkedm = 'checked';
                    }else{
                        $checkedm = '';
                    }
                    if($value['is_kompeten']=='k'){
                        echo '<tr><td>'.$value['elemen'].'</td><td>'.$value['jenis_bukti'].'</td>
                        <td style="text-align: center;">K</td><td style="text-align: center;">-</td>
                        <td style="text-align: center;"><input type="checkbox" class="v_all" name="v['.$value['id'].']" '.$checkedv.' /></td>
                        <td style="text-align: center;"><input type="checkbox" class="a_all"  name="a['.$value['id'].']" '.$checkeda.'  /></td>
                        <td style="text-align: center;"><input type="checkbox" class="t_all"  name="t['.$value['id'].']" '.$checkedt.'  /></td>
                        <td style="text-align: center;"><input type="checkbox" class="m_all"  name="m['.$value['id'].']" '.$checkedm.'  /></td>
                        </tr>';    
                    }else{
                        echo '<tr><td>'.$value['elemen'].'</td><td>'.$value['jenis_bukti'].'</td><td style="text-align: center;">-</td><td style="text-align: center;">BK</td>
                        <td style="text-align: center;"><input type="checkbox" class="v_all" name="v['.$value['id'].']" '.$checkedv.' /></td>
                        <td style="text-align: center;"><input type="checkbox" class="a_all"  name="a['.$value['id'].']" '.$checkeda.'  /></td>
                        <td style="text-align: center;"><input type="checkbox" class="t_all"  name="t['.$value['id'].']" '.$checkedt.'  /></td>
                        <td style="text-align: center;"><input type="checkbox" class="m_all"  name="m['.$value['id'].']" '.$checkedm.'  /></td>
                        </tr>';
                    }
                    
                }
                ?>   
            </tbody>  
            </table>
            
        </form>
    </div>
</div>