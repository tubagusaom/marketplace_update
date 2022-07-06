<style media="screen">
  .rounded-number{
    background:#bfde97;color:#0082b5;padding:2px;border-radius:30%;font-weight: 600;
  }
</style>

<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">


          <div id="tips">
              <ol class="rounded-list">
                  <li>
                    <a href="javascript: void(0)">
                      <font class="rounded-number">1.</font> Saldo
                    </a>
                  </li>
              </ol>
          </div>
          <table class="table-data">

            <tr>
              <td style="width: 180px;">saldo :</td>
              <td>
                <input type="hidden" name="id_member" value="<?=$data->id_member?>">
                <input type="hidden" name="created_when" value="<?php echo $data->created_when ?>">
                Rp <?php echo rupiah($data_member->total_saldo-$saldo_wd->total_withdraw) ?> <br>


              </td>
            </tr>

            <tr>
              <td style="width: 180px;">Total Withdraw :</td>
              <td>
                Rp <?php echo rupiah($data->total_withdraw) ?>
              </td>
            </tr>

            <tr>
              <td style="width: 180px;">Yang harus dibayarkan :</td>
              <td>
                Rp <?php echo rupiah($data->total_withdraw-5500) ?> <br>
                <font style="font-size:10px;color:red;">
                  * Setelah dipotong biaya transfer Rp. 5.500
                </font>
              </td>
            </tr>
          </table>

            <div id="tips">
                <ol class="rounded-list">
                    <li>
                      <a href="javascript: void(0)">
                        <font class="rounded-number">2.</font> Data Merchant
                      </a>
                    </li>
                </ol>
            </div>
            <table class="table-data">
              <tr>
                  <td style="width: 130px;">Merchant : </td>
                  <td>
                      <?php echo $data_member->member ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 130px;">Perorangan/Badan : </td>
                  <td>
                    Badan
                  </td>
              </tr>

              <tr>
                  <td style="width: 130px;">PKP/Non PKP : </td>
                  <td>
                    PKP
                  </td>
              </tr>

              <tr>
                  <td style="width: 130px;">NPWP : </td>
                  <td>
                    <?php echo $data_member->npwp_member ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 130px;">PIC : </td>
                  <td>
                    <?php echo $data_member->nama_pic ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 130px;">HP PIC : </td>
                  <td>
                    <?php echo $data_member->hp_pic ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 130px;">Email PIC : </td>
                  <td>
                    <?php echo $data_member->email_pic ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 130px;">Nama Bank : </td>
                  <td>
                    <?php echo $data_member->nama_bank ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 130px;">No. Rekening : </td>
                  <td>
                    <?php echo $data_member->norek_bank ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 130px;">Pemilik Rekening : </td>
                  <td>
                    <?php echo $data_member->nama_pemilik_bank ?>
                  </td>
              </tr>
            </table>


            <div id="tips">
                <ol class="rounded-list">
                    <li>
                      <a href="javascript: void(0)">
                        <font class="rounded-number">3.</font> Status Withdraw
                      </a>
                    </li>
                </ol>
            </div>
            <table class="table-data">
              <tr>
                  <td style="width: 130px;">Status : </td>
                  <td>

                    <?php
                      if ($data->stts_withdraw == 1) {
                        echo "<b style='color:green'>Withdraw Sudah Dikirim</b>";
                      }else{
                    ?>

                    <select class="" name="stts_withdraw" style="width:200px;">
                      <!-- <option value="" <?=$data->stts_withdraw==''?'selected':''; ?>>-</option> -->
                      <option value="0" <?=$data->stts_withdraw=='0'?'selected':''; ?>>Withdraw</option>
                      <option value="1" <?=$data->stts_withdraw=='1'?'selected':''; ?>>Dikirim</option>
                    </select>
                    <!-- <input type="number" class="easyui-textbox" name="saldo" style="width:200px;"> <br>
                    <font style="font-size:9px;color:red;">
                      * Didapat dari <b>Total Belanja</b> yg sudah dipotong ppn dan pph
                    </font> -->

                    <?php } ?>

                  </td>
              </tr>
            </table>

        </form>
    </div>
</div>
