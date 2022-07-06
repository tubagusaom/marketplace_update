<div class="decoration"></div>
<h4 class="uppercase bolder color-blue-dark center-text">
  data kurir
</h4>

<div class="decoration"></div>

<div class="">

  <div class="clear"></div>

  <form action="<?=base_url()?>kurir/ubah" method="post">

  <table class="table-borders-dark">
    <tr>
      <th class="bg-night-dark" width="12%">No</th>
      <th class="bg-night-dark">Kurir</th>
      <th class="bg-night-dark">Status</th>
    </tr>

    <?php
      foreach ($kurir as $key => $data) {

    ?>

    <tr>
      <td><?=$key+1?></td>
      <td>
        <?php
          if ($data == 'jne') {
            echo "JNE";
          }elseif ($data == 'tiki') {
            echo "TIKI";
          }else {
            echo "POS INDONESIA";
          }
        ?>
      </td>
      <td>
        <input type="checkbox" name="jasakirim[<?=$key?>]" value="<?=$data?>" <?=$seller_member[$key] == $data ? 'checked':'' ?>>
      </td>
    </tr>

    <?php } ?>

    <tr>
      <td colspan="3">
        <b class="bottom-0 left-text left-15">
          Checklis untuk mengaktifkan jasa pengiriman <font style="color:red;">*</font>
        </b>

        <div class="decoration decoration-margins top-10"></div>
        <div class="content demo-buttons">

          <input type="hidden" name="idseller" value="<?=$id_member?>">

          <input type="submit" name="submit" value="Update Kurir" class="button button-xs button-full button-round button-orange" style="cursor:pointer;">
        </div>
      </td>
    </tr>


  </table>

  </form>
</div>
