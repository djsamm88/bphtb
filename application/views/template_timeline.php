<table class="table">
  <thead>
    <th>Tgl Update</th>
    <th>Catatan</th>
    <th>Dari</th>
    <th>Posisi</th>
  </thead>
  <tbody>
    <?php 
      foreach ($all as $key) {
        echo "
          <tr>
            <td>$key->updated_on</td>
            <td>$key->catatan</td>
            <td>".usergroup()[$key->usergrup_sumber]."</td>
            <td>".usergroup()[$key->usergrup_tujuan]."</td>
          </tr>
        ";
      }
    ?>
  </tbody>
</table>