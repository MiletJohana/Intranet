<?php
sleep(1);
include('../../conexion.php');
if ($_REQUEST) {
      $id_cli   = $_REQUEST['id_cli'];
      $sql = "SELECT * FROM mq_clie WHERE id_cli = '" . $id_cli . "'";
      $query = $conexion->query($sql);

      if ($query->rowCount() > 0) // not available
      {
            echo '0';
      } else {
            echo '1';
      }
}
