<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <div id="tips">
                <ol class="rounded-list">
                    <li><a href="javascript: void(0)">Data Mahasiswa</a></li>
                </ol>
            </div>
            <table class="table-data">
                <input type="hidden" name="status_jadwal" value="0">
                <input type="hidden" name="id_prodi" id="id_prodi" value="<?=$id_prodi?>" />

                <tr>
                    <td>Nama Jadwal : </td>
                    <td>
                        <input id="jadual" name="jadual" style="width: 280px;" class="easyui-textbox" data-options="required: true" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Angkatan : </td>
                    <td>
                        <?php echo form_dropdown('id_angkatan', $angkatan,'', 'id="id_angkatan" style="width:250px;" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>

                <tr>
                    <td>Kelas : </td>
                    <td>
                        <input id="kelas_calon" name="kelas" style="width: 280px;" class="easyui-textbox" data-options="required: true" >
                    </td>
                </tr>
                <tr>
                    <td>Semester : </td>
                    <td>
                        <input id="semester_calon" name="semester" style="width: 280px;" class="easyui-textbox" data-options="required: true" >
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <a id="btn" href="#" onclick="cari_mahasiswa()" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Peview Mahasiswa</a>
                    </td>
                </tr>

        </table>
        <div id="div_mahasiswa"><div id="dd_mahasiswa"></div></div>
        <div id="tips">
                <ol class="rounded-list">
                    <li><a href="javascript: void(0)">Data pengajuan jadwal</a></li>
                </ol>
            </div>
            <table class="table-data">
                <tr>
                    <td style="width: 100px;">Tanggal Mulai : </td>
                    <td>
                        <input id="tanggal" name="tanggal" style="width: 250px;" class="easyui-datebox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Tanggal Akhir : </td>
                    <td>
                        <input id="tanggal_akhir" name="tanggal_akhir" style="width: 250px;" class="easyui-datebox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Jumlah Asesi : </td>
                    <td>
                        <input id="jumlah_asesi" name="jumlah_asesi" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
function ch_all_mahasiswa(){
    if($("#v_all_mhs").is(':checked')){
        $('.v_all_mhs').prop("checked", true);
    }else{
        $('.v_all_mhs').prop("checked", false);
    }
}
function cari_mahasiswa(){
       var base_url = "<?= base_url(); ?>";
       // angkatan = $('#id_angkatan').combobox('getValue');
       kelas_calon = $('#kelas_calon').val();
       semester_calon = $('#semester_calon').val();
       prodi = $('#id_prodi').val();

        $.ajax({
            type: 'post',
            url: base_url + 'jadwal_asesmen/mahasiswa/',
            // data: {id_angkatan: angkatan,kelas_calon: kelas_calon,semester_calon: semester_calon,prodi:prodi},
            data: {kelas_calon: kelas_calon,semester_calon: semester_calon,prodi:prodi},
            cache: false,
            success: function (data) {
                $('#dd_mahasiswa').remove();
                $('#div_mahasiswa').append('<div id="dd_mahasiswa">'+data+'</div>');
            }
        });
    }
</script>
