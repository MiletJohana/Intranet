<?php
    include "../../conexion_fenaseo.php";

    if($_POST['resp'] == 'color'){
        $sqlColor = "SELECT * FROM wpgb_escala_colores;";
        $queryColor = $conexion->query($sqlColor);

        if($queryColor != null){
            $result = [];
            while ($rowColor = $queryColor->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $rowColor;
            }
            echo json_encode($result);
        }
    }