<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" enctype="multipart/form-data" action="<?php echo $url ?>">
        <div id="tips">
    			<ol class="rounded-list">
    				<li><a href="javascript: void(0)">Ticket Support</a></li>
    			</ol>
    		</div>
            <table class="table-data">
                <tr>
                    <td style="width: 100px;">Title : </td>
                    <td>
                        <?php echo $data->title ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Date : </td>
                    <td>
                        <?php echo $data->created_when ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Message : </td>
                    
                    <td>
                        <?php echo $data->message ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Attachment : </td>
                    <td>
                        <a target="_blank" href="<?php echo base_url().'assets/files/pesan/'.$data->attachment ;?>" ><?=$data->attachment?></a> 
                </tr>				
            </table>
            <div id="tips">
    			<ol class="rounded-list">
    				<li><a href="javascript: void(0)">Replied</a></li>
    			</ol>
            </div>
            <?php
                if(count($pesan) > 0){
                    echo' <table class="table-data">';
                    foreach($pesan as $key=>$value){
                        if($value->attachment != ""){
                            $link = '/ <a target="_blank" href="'.base_url().'assets/files/pesan/'.$value->attachment.'" >'.$value->attachment.'</a>';
                        }else{
                            $link = "";
                        }
                        echo '<tr><td style="font-weight:bold;width: 140px;text-align:right;">'.$value->nama_user.'</td><td>'.$value->message.'</td></tr>';
                        echo '<tr><td style="font-weight:bold;width: 140px;text-align:right;"></td><td>'.$value->created_when.$link.'</td></tr>';
                    }
                    echo'</table>';
            ?>
                
            <?php
                }else{
                    echo "<h4>Tidak Ada Pesan Balik";
                }
            ?>
            <div id="tips">
    			<ol class="rounded-list">
    				<li><a href="javascript: void(0)">Form Reply</a></li>
    			</ol>
            </div>
            
                <table class="table-data">
                <tr>
                    <td style="width: 100px;">Message : </td>
                    
                    <td><input type="hidden" id="title" name="title" style="width: 250px;" value="1" >
                        <input type="hidden" name="parent_id" id="parent_id" value="<?=$parent_id?>" />
                        <input type="hidden" name="status_read_recepient" id="status_read_recepient" value="0" />
                        <input type="hidden" name="status_ticket" id="status_ticket" value="1" />
                        <input type="hidden" name="sender_id" id="sender_id" value="<?=$sender_id?>"  />
                        <input type="hidden" name="reciepent_id" id="reciepent_id" value="<?=$recepient?>"  />
                    
                        <textarea name="message" id="message" rows="4" cols="40"></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Attachment : </td>
                    <td>
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 250px;" data-options="buttonText: 'Pilih File'" />
                        <input type="hidden" name="foto_hidden" id="foto_hidden" /> 
                </tr>
                				
            </table>
    		
        </form>
    </div>
</div>
<script>
function reply_comment(){
    
}
</script>

