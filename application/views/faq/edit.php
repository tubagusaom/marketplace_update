<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">Pertanyaan : </td>
                    <td>
                        <textarea id="pertanyaan" name="pertanyaan" style="width: 250px;" data-options="required: true"><?php echo $data->pertanyaan ?></textarea>    
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Jawaban: </td>
                    <td>
                        <textarea id="jawaban" name="jawaban" style="width: 250px;" data-options="required: true"><?php echo $data->jawaban ?></textarea>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script>
    $(function(){
        $("#jawaban").cleditor({
        width:550, height:230
    });
    })
</script>