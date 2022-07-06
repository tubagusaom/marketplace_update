<div style="margin: 2px;">
	<div class="x-panel-bwrap">
        <form id="myform" enctype="multipart/form-data" >
            <table class="table-data">
                <tr>
                    <td style="width: 180px;">NIS : </td>
                    <td>

                        <input id="nis" name="nis" style="width: 250px;" class="easyui-textbox" value="<?php echo $data_siswa->nis ; ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Nama Siswa : </td>
                    <td>
                        <input id="nama" name="nama" style="width: 250px;" class="easyui-textbox" value="<?php echo $data_siswa->nama ; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Tahun Angkatan : </td>
                    <td>
                        <input id="batch_id" name="batch_id" style="width: 250px;" class="easyui-textbox" value="<?php echo $data_siswa->batch_name ; ?>" >
                        
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Program Study : </td>
                    <td>
                        <input id="program_id" name="program_id" style="width: 250px;" class="easyui-textbox" value="<?php echo $data_siswa->program_study; ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">S.P.L : </td>
                    <td>
                        <input id="spl" name="spl" style="width: 250px;" class="easyui-textbox" value="<?php echo $data_siswa->spl ; ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Gender : </td>
                    <td>
                       <input id="gender" name="gender" style="width: 250px;" class="easyui-textbox" value="<?php echo $data_siswa->gender ; ?>" >

                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Tempat Lahir : </td>
                    <td>
                        <input id="tempat_lahir" name="tempat_lahir" style="width: 250px;" class="easyui-textbox" value="<?php echo $data_siswa->tempat_lahir ; ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Tanggal Lahir : </td>
                    <td>
                        <input id="tgl_lahir" name="tgl_lahir" style="width: 250px;" class="easyui-datebox" value="<?php echo $data_siswa->tanggal_lahir ; ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Agama : </td>
                    <td>
                        <input id="agama" name="agama" style="width: 250px;" class="easyui-textbox" value="<?php echo $data_siswa->agama ; ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Alamat : </td>
                    <td>
                        <input id="alamat" name="alamat" style="width: 250px;" class="easyui-textbox" value="<?php echo $data_siswa->alamat ; ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Email : </td>
                    <td>
                        <input id="email" name="email" style="width: 250px;" class="easyui-textbox" value="<?php echo $data_siswa->email ; ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Telepon : </td>
                    <td>
                        <input id="telepon" name="telepon" style="width: 250px;" class="easyui-textbox" value="<?php echo $data_siswa->telepon ; ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Orang Tua : </td>
                    <td>
                        <input id="orang_tua" name="orang_tua" style="width: 250px;" class="easyui-textbox" value="<?php echo $data_siswa->orang_tua ; ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Pekerjaan Orang Tua : </td>
                    <td>
                        <input id="kerja_orang_tua" name="kerja_orang_tua" style="width: 250px;" class="easyui-textbox" value="<?php echo $data_siswa->kerja_orang_tua ; ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Foto:
                        
                    </td>
                    <td>
                        <img id="foto" src="<?php echo base_url()."assets/img/siswa/".$data_siswa->foto; ?>">
                    </td>
                    
                </tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
	<?php echo $grid; ?> 
</script>                   