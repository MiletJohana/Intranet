<?php
sleep(1);
include('../../conexion.php');
if ($_REQUEST) {
      $id_usu   = $_REQUEST['id_usu'];
      $sql = "SELECT * FROM mq_usu WHERE id_usu = '" . $id_usu . "'";
      $query = $conexion->query($sql);

      if ($query->rowCount() > 0) // not available
      {
            echo '0';
      } else {
            echo '1';
      }
}
