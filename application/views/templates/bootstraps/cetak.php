  <div style="padding: 5px;">  <div id="p" class="easyui-panel" title="Schedule Aeroflyer Institute" 
            style="width:auto;height:450px;padding:10px;background:#fafafa;"
            data-options="closable:false,
                    collapsible:false,minimizable:false,maximizable:false">
        <h3>SCHEDULE AEROFLYER INSTITUTE</h3>
        
       <div class="well"><h4>FLYING SCHEDULE</h4></div> 
                
                <div class="table-responsive" style="background-color: white;">
                  <table class="table" border="1">
                  
                    <tr><th>STUDENT NAME</th><th>SCHEDULE DATE</th><th>A/C REG</th><th>INSTRUKTUR</th>
                    <th>PERIODE</th><th>AIRCRAFT</th></tr>
                    <?php
                        foreach($schedule_flying as $value){
                            echo '<tr><td>'.$value['nama'].'</td><td>'.$value['schedule_date'].'</td>
                            <td>'.$value['acreg'].'</td>
                            <td>'.$value['instruktur_name'].'</td>
                            <td>'.$value['waktu'].'</td><td>'.$value['plane_name'].'</td></tr>';
                        }
                    ?>	
                  </table>
                </div>
                <div class="well"><h4>GROUND SCHEDULE</h4></div>
                <div class="table-responsive" style="background-color: white;">
                  <table class="table" border="1">
                  
                    <tr><th>STUDENT NAME</th><th>SCHEDULE DATE</th><th>ROOM</th><th>INSTRUKTUR</th>
                    <th>PERIODE</th></tr>
                    <?php
                        foreach($schedule_ground as $value){
                            echo '<tr><td>'.$value['nama'].'</td><td>'.$value['schedule_date'].'</td>
                            <td>'.$value['room_name'].'</td>
                            <td>'.$value['instruktur_name'].'</td>
                            <td>'.$value['waktu'].'</td></tr>';
                        }
                    ?>	
                  </table>
                </div>
                <div class="well"><h4>SIMULATOR SCHEDULE</h4></div>
                <div class="table-responsive" style="background-color: white;margin-bottom: 100px;">
                  <table class="table" border="1">
                  
                    <tr><th>STUDENT NAME</th><th>SCHEDULE DATE</th><th>INSTRUKTUR</th>
                    <th>PERIODE</th><th>ROOM</th><th>AIRCRAFT</th></tr>
                    <?php
                        foreach($schedule_simulator as $value){
                            echo '<tr><td>'.$value['nama'].'</td>
                            <td>'.$value['schedule_date'].'</td>
                            <td>'.$value['instruktur_name'].'</td>
                            <td>'.$value['waktu'].'</td>
                            <td>'.$value['room_name'].'</td>
                            <td>'.$value['plane_name'].'</td></tr>';
                        }
                    ?>	
                  </table>
                  
                </div> 
    </div></div>