<div style="margin: 2px;">
	<div class="x-panel-bwrap">
        <form id="myform" enctype="multipart/form-data" >
            <table class="table-data">
                <?php
                    foreach($data_siswa as $value){
                ?>
                <tr>
                    <td style="width: 180px;"><?php echo $value->program_study; ?></td>
                    <td>
                          <?php echo $value->subject_name; ?>    
                                 
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;" colspan="2"><?php echo $value->general; ?></td>
                </tr>
                <?php
                }
                ?>
                <tr>
                    <td style="width: 100px;">: </td>
                    <td>
                        
                    </td>
                </tr>
                

            </table>
        </form>
    </div>
</div>
                   