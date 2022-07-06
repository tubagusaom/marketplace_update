<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">Title : </td>
                    <td>
                        <input id="title" name="title" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->title ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Headline : </td>
                    <td>
                        <textarea name="headline" id="headline" rows="2" cols="35">
                        <?php echo $data->headline ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Content : </td>
                    <td>
                        <textarea name="content" id="content" rows="2" cols="35">
                        <?php echo $data->content ?>
                        </textarea>
                        
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Category : </td>
                    <td>
                        <input id="category" name="category" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->category ?>">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>