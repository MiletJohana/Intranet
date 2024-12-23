<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
$año = date("Y");
switch ($i) {
case '1':
$mail->Body = '
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>

<body style="color:black; font-family: Roboto; font-size: 1.3em;">
    <div style="margin-top: 3em;margin-bottom: 3em;margin-left: 7em;margin-right: 7em;">
        <div>
            <div>
                <div style="text-align: center; margin: 3em;">
                    <img style="width:15em;" src="https://intranet.masterquimica.com/resources/librerias/img/mastercasa.png">
                </div>
                <p>
                    Buen día, Estimado(a) '. ($com->nom_con) .',<br><br>
                    Agradecemos su tiempo recordandole que su necesidad
                    es nuestra prioridad, a continuación relaciono las conclusiones de nuestra reunión: 
                    <br><br>
                    '. ($com->concl_agen) .'
                    <br><br>
                </p>
                <p style="color:red;">Agradecemos que nos ayude
                    respondiendo una pequeña encuesta, presiona el boton para empezar
                </p>

                <div style="text-align: center;">
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSdMQ8wTJMb7md_64aSmjC6GHrERblmFXM0wg0HTh9g7rB5QPQ/viewform"
                        target="_blank">
                        <img src="https://intranet.masterquimica.com/resources/img/boton_mq.png" style="width: 200px;">
                    </a>
                </div>
            </div>
        </div>
        <table>
            <td width="40%" style="background-color:transparent;">
                <p>
                    <span style="font-weight:bold;">'.strtoupperb .$com->nom_usu.'</span><br>
                    '.strtoupper($com->nom_car).' <br>
                    PBX: 231 6377 ext. '.($com->ext_usu) .'<br>
                    <a href=" '.($com->eml_usu).'">
                        '.($com->eml_usu).'
                    </a>
                </p>
            </td>
            <td></td>
        </table>
    </div>
    <div style="margin-top:3em;margin-bottom: 3em;margin-left: 7em;margin-right: 7em;">
        <div >
            <div>
                <p style="color: grey;"><small>© ' . $año . ' por Master Química S.A.S.</small></p>
            </div>
        </div>
    </div>
</body>
</html>';
break;
case '2':
    $mail->Body = '<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>

<body style="color:black; font-family: Roboto; font-size: 1.3em;">
    <div style="margin-top: 3em;margin-bottom: 3em; margin-left: 7em; margin-right: 7em;">
        <div>
            <div>
                <div style="text-align: center; margin: 3em;">
                    <img style="width:15em;" src="https://intranet.masterquimica.com/resources/librerias/img/mastercasa.png">
                </div>
                <p>
                    Buen día,
                    <br><br>
                    A continuación se relacionan las conclusiones de la visita #'. ($com->id_agen) .' al cliente: '.
                    ($cli->nom_cli) .' el día: '.($com->fec_cre) .'
                    <br><br>
                    <span style="background-color: #dbdbdb; padding: .2em; border-radius: .25rem;">
                        '. ($com->concl_agen) .'
                    </span>
                    <br><br>
                    Observaciones:
                    <br><br>
                    <span style="background-color: #dbdbdb; padding: .2em; border-radius: .25rem;">
                        '. ($com->obs_agen) .'
                    </span>
                    <br><br>
                    Datos Adicionales:
                    <br><br>';
                    if($com->nom_con != ''){
                        $mail->Body .= ' <li>Contacto:<i>'.($com->nom_con).'</i> </li>';
                    }
                    if($cli->tel_cli != ''){
                        $mail->Body .= ' <li>Telefono:<i>'.($cli->tel_cli).'</i></li>';
                    }
                    if($com->eml_con != ''){
                        $mail->Body .= ' <li>Correo:<i>'.($com->eml_con).'</i></li>';
                    }
                    $mail->Body .= '          
                </p>
            </div>
        </div>
    </div>
    <div style="margin-top: 3em; margin-bottom: 3em; margin-left: 7em; margin-right: 7em;">
        <div >
            <div>
                <p style="color: grey;"><small>© ' . $año . ' por Master Química S.A.S.</small></p>
            </div>
        </div>
    </div>
</body>
</html>';
break;
}
?>