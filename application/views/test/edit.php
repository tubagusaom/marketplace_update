<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" >
            <table class="table-data">
                <tr>
                    <td style="width: 100px;">Category : </td>
                    <td>
                        <?php echo form_dropdown('subject_category', $subject_category, $data->subject_category, 'id="subject_category" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Base : </td>
                    <td>
                        <?php echo form_dropdown('base', $base, $data->base, 'id="base" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Test Date : </td>
                    <td>
                        <input value="<?php echo date('d/m/Y', strtotime($data->schedule_date)) ?>" id="schedule_date" name="schedule_date" style="width: 150px;" class="easyui-datebox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;">Instructur Name : </td>
                    <td>
                        <input id="instruktur_id" name="instruktur_id" value="<?php echo $data->instruktur_id ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;">From Time : </td>
                    <td>
                        <input value="<?php echo $data->from_time ?>"  id="from_time" name="from_time" style="width: 150px;" class="easyui-textbox" data-options="required: true" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;">To Time : </td>
                    <td>
                        <input value="<?php echo $data->to_time ?>"  id="to_time" name="to_time" style="width: 150px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr id="tr_plane">
                    <td style="width: 180px;">Aircraft : </td>
                    <td>
                        <input id="plane_id" name="plane_id" value="<?php echo $data->plane_id ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;">Student Name : </td>
                    <td>
                        <input id="siswa_id" name="siswa_id" value="<?php echo $data->siswa_id ?>" >
                    </td>
                </tr>
                <tr id="tr_from">
                    <td style="width: 180px;">Depart : </td>
                    <td>
                        <input id="from_airport" name="from_airport" value="<?php echo $data->from_airport ?>" >
                    </td>
                </tr>
                <tr id="tr_to">
                    <td style="width: 180px;">Arrival : </td>
                    <td>
                        <input id="to_airport" name="to_airport" value="<?php echo $data->to_airport ?>" >
                    </td>
                </tr>
                
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
<?php
echo $siswa_grid;
echo $instruktur_grid;
echo $from_airport_grid;
echo $to_airport_grid;
echo $plane_grid;

?>
</script>