  <div style="padding: 5px;">  <div id="p" class="easyui-panel" title="Dashboard Report Student" 
            style="width:auto;height:450px;padding:10px;background:#fafafa;"
            data-options="closable:false,
                    collapsible:false,minimizable:false,maximizable:false">
        <h3>INSTRUKTUR REPORT</h3>
        <?php
            foreach($query as $value){
                echo "Status ".$value['status']." | Total ".$value['total'].' Instruktur<br/>';
            }
        ?>
        <br />
        <h3>LOG BOOK INSTRUKTUR</h3>
        <table class="easyui-datagrid" style="width:auto;height:auto">
        <thead>
        <tr><th data-options="field:'code5',width:100,align:'center'">Instruktur Code</th>
        <th data-options="field:'code6'">Instruktur Name</th>
        <th data-options="field:'code',width:100,align:'center'">Instructor Hours</th>
         </thead>
        <tbody>
        <?php
            foreach($query_jam_terbang as $value){
                echo "<tr>
                <td>".$value['instruktur_code']."</td>
                <td>".$value['instruktur_name']."</td>
                <td>".$value['total_hours']."</td>
                </tr>";
            }
        ?>
        </tbody>
        </table>
        
    </div></div>