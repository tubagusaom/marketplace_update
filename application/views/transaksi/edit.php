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
                      <font class="rounded-number">1.</font> Data Buyer
                    </a>
                  </li>
              </ol>
          </div>

            <table class="table-data">
              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">Buyer </td>
                  <td>
                      <input type="hidden" name="id_member" value="<?php echo $data->id_member ?>">
                      <input type="hidden" name="id_buyer" value="<?php echo $data->id_buyer ?>">
                      <input type="hidden" name="stts_keranjang" value="<?php echo $data->stts_keranjang ?>">
                      <input type="hidden" name="id_product" value="<?php echo $data->id_product ?>">
                      <input type="hidden" name="jumlah_product" value="<?php echo $data->jumlah_product ?>">
                      <input type="hidden" name="id_transaksi" value="<?php echo $data->id_transaksi ?>">
                      <input type="hidden" name="created_when" value="<?php echo $data->created_when ?>">
                      : <?php echo $data_buyer->nm_buyer ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">Hp </td>
                  <td>
                    : <?php echo $data_buyer->hp_buyer ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">Email </td>
                  <td>
                    : <?php echo $data_buyer->email_buyer ?>
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
                  <td style="width: 150px;text-align:left;padding-left:45px;">Merchant </td>
                  <td>
                    <input type="hidden" name="idm" value="<?=$data_member->id ?>">
                      : <?php echo $data_member->member ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">Perorangan/Badan </td>
                  <td>
                    : Badan
                  </td>
              </tr>

              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">PKP/Non PKP </td>
                  <td>
                    : PKP
                  </td>
              </tr>

              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">NPWP </td>
                  <td>
                    : <?php echo $data_member->npwp_member ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">PIC </td>
                  <td>
                    : <?php echo $data_member->nama_pic ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">HP PIC </td>
                  <td>
                    : <?php echo $data_member->hp_pic ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">Email PIC </td>
                  <td>
                    : <?php echo $data_member->email_pic ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">Nama Bank </td>
                  <td>
                    : <?php echo $data_member->nama_bank ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">No. Rekening </td>
                  <td>
                    : <?php echo $data_member->norek_bank ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">Pemilik Rekening </td>
                  <td>
                    : <?php echo $data_member->nama_pemilik_bank ?>
                  </td>
              </tr>
            </table>

            <div id="tips">
                <ol class="rounded-list">
                    <li>
                      <a href="javascript: void(0)">
                        <font class="rounded-number">3.</font> Data Jasa Pengiriman
                      </a>
                    </li>
                </ol>
            </div>
            <table class="table-data">
              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">Kurir </td>
                  <td>
                    : <?php echo $data_kurir->kurir_pengiriman ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">Estimasi </td>
                  <td>
                    : <?php echo $data_kurir->est_pengiriman ?> Hari
                  </td>
              </tr>

              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">Biaya Kirim </td>
                  <td>
                    : Rp. <?php echo rupiah($data_kurir->biaya_pengiriman) ?>
                  </td>
              </tr>
            </table>

            <div id="tips">
                <ol class="rounded-list">
                    <li>
                      <a href="javascript: void(0)">
                        <font class="rounded-number">4.</font> Data Transaksi
                      </a>
                    </li>
                </ol>
            </div>
            <table class="table-data">

              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;"> <b style="color:blue;"> Bank Tujuan </b> </td>
                  <td>
                    : <?=$data_transaksi->nmbank_tujuan?> VA
                  </td>
              </tr>
              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;"> <b style="color:blue;"> No Rek Tujuan </b> </td>
                  <td>
                    : <?=$data_transaksi->norek_tujuan?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;"> <b style="color:green;"> Total Belanja </b> </td>
                  <td> :
                    <?php
                      $tb = $data_transaksi->total_transaksi - $data_kurir->biaya_pengiriman;
                    ?>

                    Rp. <?php echo rupiah($tb) ?>
                  </td>
              </tr>

              <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">Total Transaksi </td>
                  <td>
                    : Rp. <?php echo rupiah($data_transaksi->total_transaksi) ?>
                  </td>
              </tr>
            </table>

            <div id="tips">
                <ol class="rounded-list">
                    <li>
                      <a href="javascript: void(0)">
                        <font class="rounded-number">5.</font> Saldo Akumulasi
                      </a>
                    </li>
                </ol>
            </div>
            <table class="table-data">

              <?php
                if ($data->stts_pajak == '1') {
              ?>

                <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;"><b>3%</b> Komisi</td>
                  <td> : <?="Rp. ".rupiah($data->komisi); ?></td>
                </tr>

                <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;"><b>10%</b> PPN</td>
                  <td>
                    : <?="Rp. ".rupiah($data->ppn); ?>
                    <input type="hidden" name="ppn" value="<?=$data->ppn?>">
                    <input type="hidden" name="pph" value="<?=$data->pph?>">
                    <input type="hidden" name="saldo_akhir" value="<?=$data->saldo_akhir?>">
                    <input type="hidden" name="stts_pajak" value="<?=$data->stts_pajak?>">
                    <input type="hidden" name="komisi" value="<?=$data->komisi?>">

                    <input type="hidden" name="acuan_stts" value="1">
                  </td>
                </tr>

                <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;"><b>2%</b> PPh 23</td>
                  <td> : <?="Rp. ".rupiah($data->pph); ?></td>
                </tr>

                <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">Saldo Merchant</td>
                  <td> : <?="Rp. ".rupiah($data->saldo_akhir); ?></td>
                </tr>

              <?php }else { ?>

                <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;"><b>3%</b> Komisi</td>
                  <td> : <input type="number" class="easyui-textbox" name="komisi" data-options="required: true"></td>
                </tr>

                <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;"><b>10%</b> PPN</td>
                  <td> : <input type="number" class="easyui-textbox" name="ppn" data-options="required: true"></td>
                </tr>

                <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;"><b>2%</b> PPh 23</td>
                  <td> : <input type="number" class="easyui-textbox" name="pph" data-options="required: true"></td>
                </tr>

                <tr>
                  <td style="width: 150px;text-align:left;padding-left:45px;">Saldo Merchant</td>
                  <td>
                    <input type="hidden" name="acuan_stts" value="0">
                    <input type="hidden" name="stts_pajak" value="1">

                    : <input type="number" class="easyui-textbox" name="saldo_akhir" data-options="required: true"> <br>
                    <font style="font-size:9px;color:red;">
                      * Didapat dari <b style="color:green;">Total Belanja</b> yg sudah dipotong PPN & PPh
                    </font>
                  </td>
                </tr>

              <?php } ?>

            </table>

        </form>
    </div>
</div>
