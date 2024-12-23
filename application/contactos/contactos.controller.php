<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
function validar($value)
{
    if ($value == '' || is_null($value)) {
        return 'NULL';
    } else {
        return $value;
    }
}

function contDis($value)
{
    if ($value == 1) {
        return 'Si';
    } else if ($value == 2) {
        return 'No';
    }
}
if (isset($_POST['actionCont'])) {
    switch ($_POST['actionCont']) {
        case 'addContacto':
            $sqlAddCont = "INSERT INTO contactos
                    (nom_cont, 
                    eml_cont, 
                    car_cont, 
                    tel_cont, 
                    id_cli,
                    id_usu)
                    VALUES
                    ('" . $_POST['nom_cont'] . "',
                    '" . $_POST['eml_cont'] . "',
                    '" . $_POST['car_cont'] . "',
                    " . validar($_POST['tel_cont']) . ",
                    " . validar($_POST['id_cli']) . ",
                    $sesion_id)";
            $queryAddCont = $conexion->query($sqlAddCont);

            if ($queryAddCont != null) {
                echo "Contacto creado correctamente";
            } else {
                printf("Errormessage: %s\n", $conexion->error);
                echo $sqlAddCont;
            }
            break;
        case 'updateContacto':
            $sqlSelCont = "SELECT con.* FROM contactos AS con
            INNER JOIN mq_clientes AS cli
            ON con.id_cli = cli.id_cli
            WHERE cli.id_cli = " . $_POST['id_cli'] .
                " GROUP BY con.id_cont";
            $querySelCont = $conexion->query($sqlSelCont);
            for ($i = 0; $i < $querySelCont->rowCount(); $i++) {
                $sqlUpdCont = "UPDATE contactos SET 
                        nom_cont = '" . $_POST['nom_cont' . $i] . "', 
                        eml_cont = '" . $_POST['eml_cont' . $i] . "', 
                        car_cont = '" . validar($_POST['car_cont' . $i]) . "', 
                        tel_cont = " . validar($_POST['tel_cont' . $i]) . ",
                        cont_desh = '" . contDis($_POST['cont_desh' . $i]) . "'
                        WHERE id_cont = " . $_POST['id_cont' . $i];
                $queryUpdCont = $conexion->query($sqlUpdCont);
                if ($i == 1) {
                    //echo $sqlUpdCont;
                }
            }

            if ($queryUpdCont != null) {
                echo "Contactos actualizados correctamente";
            } else {
                printf("Errormessage: %s\n", $conexion->error);
                echo $sqlSelCont;
            }
            break;
        case 'updateContacto2':
            $sqlUpdCont = "UPDATE contactos SET 
                            nom_cont = '" . $_POST['nom_cont'] . "', 
                            eml_cont = '" . $_POST['eml_cont'] . "', 
                            car_cont = '" . validar($_POST['car_cont']) . "', 
                            tel_cont = " . validar($_POST['tel_cont']) . ",
                            cont_desh = '" . contDis($_POST['cont_desh']) . "'
                            WHERE id_cont = " . $_POST['id_cont'];
            $queryUpdCont = $conexion->query($sqlUpdCont);

            if ($queryUpdCont != null) {
                echo "Contacto actualizado correctamente";
            } else {
                printf("Errormessage: %s\n", $conexion->error);
                echo $sqlSelCont;
            }
            break;
    }
}
