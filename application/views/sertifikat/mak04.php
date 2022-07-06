 <table class="easyui-datagrid" style="width: 97%;" data-options="nowrap:false,striped:true,rownumbers:true">
            <thead>
                <tr><th data-options="field:'kode_unit',align:'center'" style="width: 20%;">Unit Kompetensi</th>
                <th data-options="field:'nama_unit2'" style="width: 50%;">Unit Kompetensi</th>
                <th data-options="field:'nama_unit3',align:'center'" style="width: 8%;">K</th>
                <th data-options="field:'nama_unit4',align:'center'" style="width: 8%;">BK</th>
                <th data-options="field:'nama_unit5',align:'center'" style="width: 8%;">AL</th>
                
            </thead>
            <tbody>
                <?php
                foreach($unit_kompetensi as $key=>$value){
                        echo '<tr><td>'.$value->id_unit_kompetensi.'</td><td>'.$value->unit_kompetensi.'</td>
                        <td><input type="radio" name="mak04['.$key.']" value="K" '.(isset($mak04[$key]) && $mak04[$key]=='K'?'checked':'').'/></td>
                        <td><input type="radio" name="mak04['.$key.']" value="BK" '.(isset($mak04[$key]) && $mak04[$key]=='BK'?'checked':'').'/></td>
                        <td><input type="radio" name="mak04['.$key.']" value="AL" '.(isset($mak04[$key]) && $mak04[$key]=='AL'?'checked':'').'/></td>
                        </tr>';    
                    }
                ?>   
                
            </tbody> 
            </table>
            <table style="width: 97%;">
                <tr><td style="35%">Umpan balik terhadap pencapaian unjuk kerja :</td>
                    <td style="width: 64%;"><textarea style="width: 100%;" rows="1" name="mak04a[0]"><?php echo (isset($mak04a[0])?$mak04a[0]:''); ?></textarea></td>
                </tr>
                <tr><td style="35%">Identifikasi kesenjangan pencapaian unjuk kerja :</td>
                    <td style="width: 64%;"><textarea style="width: 100%;" rows="1" name="mak04a[1]"><?php echo (isset($mak04a[1])?$mak04a[1]:''); ?></textarea></td>
                </tr>
                <tr><td style="35%">Saran tindak lanjut hasil asesmen :</td>
                    <td style="width: 64%;"><textarea style="width: 100%;" rows="1" name="mak04a[2]"><?php echo (isset($mak04a[2])?$mak04a[2]:''); ?></textarea></td>
                </tr>
                <tr><td style="35%;font-weight: bold;">REKOMENDASI ASESOR :</td>
                    <td style="width: 64%;"><textarea style="width: 100%;" rows="1" name="mak04a[3]"><?php echo (isset($mak04a[3])?$mak04a[3]:''); ?></textarea></td>
                </tr>
                
            </table>