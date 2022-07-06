<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" action="<?php echo $url ?>">

            <table class="table-data">
                <tr>
                    <td style="width: 140px;">Nama : </td>
                    <td>
                        <input id="nama_kontak" name="nama_kontak" style="width: 250px;" class="easyui-textbox">
                    </td>
                </tr>
               <tr>
                    <td style="width: 140px;">Email : </td>
                    <td>
                        <input id="email_kontak" name="email_kontak" style="width: 250px;" class="easyui-textbox">
                    </td>
                </tr>
                <tr>
                     <td style="width: 140px;">Subject : </td>
                     <td>
                         <input id="subject_kontak" name="subject_kontak" style="width: 250px;" class="easyui-textbox">
                     </td>
                 </tr>
                <tr>
                    <td style="width: 100px;">Message : </td>
                    <td>
                        <textarea rows="4" cols="40" name="message_kontak" id="message_kontak" ></textarea>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>