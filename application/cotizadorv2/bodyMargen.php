<?php
include '../../conexion.php';
switch ($i) {
    case '1':
    $mail->Body = '
        <!DOCTYPE html>
        <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
    </head>
        <body style="color:black; font-family: Roboto; font-size: 1.3em;">
            <div style="margin-top:3em;margin-bottom: 0em;margin-left: 3em;margin-right:7em;">
                <div style="text-align: center">
                    <img style="max-width:350px;" src="https://intranet.masterquimica.com/resources/img/COTIZACIONES.png">
                </div>
                <p style="margin: 39px 49px 40px 71px;">
                    Buen día,  <br><br>
                    El colaborador <strong>'.($coti->nom_usu).'</strong> necesita aprobación de la cotización <strong>N#'.($coti->id_coti).' </strong> del cliente <strong>'.($coti->nom_cli).'</strong>
                    con los siguientes productos dentro del margen
                </p>

                <div class="col-md-12" align="center">
                    <div class="col-md-12">
                        <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                            <thead style="color:white;background:#58585C">
                                    <tr style="height:40px;">
                                        <th width="100" style="border-radius: 0px 0px 0px 0px;"> Nombre 
                                        <th width="100"> Precio</th>
                                        <th width="100"> Margen</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <td>';
                                    while ($rP = $queryPro->fetch(PDO::FETCH_ASSOC)) {
                                        $mail->Body .= '<tr aling="align="center">
                                                            <td>'. $rP["nom_pro_cot"] .'</td>
                                                            <td>'. $rP["pre_cot"] .'</td>
                                                            <td>'. $rP["margen"] .'</td>
                                                        </tr>';
                                    }
                                    $mail->Body .= ' </td>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <p style="margin: 39px 133px 40px 149px;" align="center">
                        Por favor ingrese al aplicativo para administrar la cotización .
                </p>
                <div class="col-md-12" style="color:black" align="center">
                        <a href="https://intranet.masterquimica.com/application/cotizadorv2/EmailMargen?id_coti='.($coti->id_coti).'&action=aproMargen">
                            <img src="https://intranet.masterquimica.com/resources/img/aprobarMarg.png" style="width:123px !important;">
                        </a>            
                        <a href="https://intranet.masterquimica.com/application/cotizadorv2/EmailMargen?id_coti='.($coti->id_coti).'&action=rechaMargen"">
                            <img src="https://intranet.masterquimica.com/resources/img/rechazarMarg.png" style="width:123px !important;">
                        </a>
                </div>
            </div>
        </body>
    </html>
    ';
    break;
    case '2':
        $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
            </head>
            <body style="color:black; font-family: Roboto; font-size: 1.3em;">
                <div style="margin-top:3em;margin-bottom: 0em;margin-left: 3em;margin-right:7em;">
                    <div style="text-align: center">
                        <img style="max-width:350px;" src="https://intranet.masterquimica.com/resources/img/COTIZACIONES.png">
                    </div>
                </div>
                <p style="margin: 39px 49px 40px 71px;">
                    Buen día, <strong>'.($coti->nom_usu).'</strong><br><br>
                    Le informamos que su cotización N#'.($coti->id_coti).' del cliente '.($coti->nom_cli).' esta en estado <strong><i>Pendiente por aprobación</i></strong>, 
                    se enviará un correo de confirmación cuando esta cotización este Aprobada.
                </p>
            </body>
            </html>';
    break;
    case '3':
        $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
            </head>
            <body style="color:black; font-family: Roboto; font-size: 1.3em;">
                    <div style="margin-top: 3em;margin-bottom: 3em;margin-left:15em;margin-right:15em;">
                        <div style="text-align: center">
                            <img style="max-width:350px;" src="https://intranet.masterquimica.com/resources/img/COTIZACIONES.png">
                        </div>
                    </div>
                    <p style="margin: 33px 287px 42px 302px">
                        Buen día, <strong>'.($coti->nom_usu).'</strong><br><br>
                        Le informamos que usted <strong><i>Aprobó</i></strong>, la Cotización N#'.($coti->id_coti).' . del cliente <strong>'.($coti->nom_cli).'</strong>
                        con los siguientes productos.
                    </p>
                    <div class="col-md-12" align="center">
                        <div class="col-md-12">
                            <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                                <thead style="color:white;background:#58585C">
                                        <tr style="height:40px;">
                                            <th width="100" style="border-radius: 0px 0px 0px 0px;"> Nombre 
                                            <th width="100"> Precio</th>
                                            <th width="100"> Margen</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <td>';
                                        while ($rP = $queryPro->fetch(PDO::FETCH_ASSOC)) {
                                            $mail->Body .= '<tr aling="align="center">
                                                                <td >'. $rP["nom_pro_cot"] .'</td>
                                                                <td>' . $rP["pre_cot"] . '</td>
                                                                <td>' . $rP["margen"] . '</td>
                                                            </tr>';
                                        }
                                        $mail->Body .= ' </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br><br>
                    <div class="col-md-12" align="center">
                        <a href="https://intranet.masterquimica.com/">
                            <img src="https://intranet.masterquimica.com/resources/img/LOGO.png" style="width: 50px !important;">
                        </a>
                    </div>
            </body>
            </html>';
    break;
    case '4':
        $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
            </head>
            <body style="color:black; font-family: Roboto; font-size: 1.3em;">
                <div style="margin-top: 3em;margin-bottom: 3em;margin-left:15em;margin-right:15em;">
                    <div style="text-align: center">
                        <img style="max-width:350px;" src="https://intranet.masterquimica.com/resources/img/COTIZACIONES.png">
                    </div>
                    <p style="margin: 39px 49px 40px 71px;">
                        Buen día, <strong>'.($coti->nom_usu).'</strong><br><br>
                        Le informamos que su Cotización <strong> N#'.($coti->id_coti).'</strong> del cliente <strong>'.($coti->nom_cli).'</strong> esta en estado <strong><i>Aprobado</i></strong>, 
                        Por favor ingrese al aplicativo para administrar la cotización
                    </p>
                    <div class="col-md-12" align="center">
                        <a href="https://intranet.masterquimica.com/">
                            <img src="https://intranet.masterquimica.com/resources/img/LOGO.png" style="width: 50px !important;">
                        </a>
                    </div>
            </body>
            </html>';
    break;
    case '5':
        $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
            </head>
            <body style="color:black; font-family: Roboto; font-size: 1.3em;">
                <div style="margin-top: 3em;margin-bottom: 3em;margin-left:15em;margin-right:15em;">
                    <div style="text-align: center">
                        <img style="max-width:350px;" src="https://intranet.masterquimica.com/resources/img/COTIZACIONES.png">
                    </div>
                    <p style="margin: 28px 45px 42px 52px;">
                        Buen día, <strong>'.($coti->nom_usu).'</strong> <br><br>
                        Le informamos que usted <strong><i>Rehazó</i></strong>, la Cotización <strong> N#'.($coti->id_coti).' .</strong> del cliente  <strong>'.($coti->nom_cli).'</strong>
                        con los siguientes productos.
                    </p>
                    <div class="col-md-12" align="center">
                        <div class="col-md-12">
                            <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                                <thead style="color:white;background:#58585C">
                                        <tr style="height:40px;">
                                            <th width="100" style="border-radius: 0px 0px 0px 0px;"> Nombre 
                                            <th width="100"> Precio</th>
                                            <th width="100"> Margen</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <td>';
                                        while ($rP = $queryPro->fetch(PDO::FETCH_ASSOC)) {
                                            $mail->Body .= '<tr aling="align="center">
                                                                <td >'. $rP["nom_pro_cot"] . '</td>
                                                                <td>' . $rP["pre_cot"] . '</td>
                                                                <td>' . $rP["margen"] . '</td>
                                                            </tr>';
                                        }
                                        $mail->Body .= ' </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p align="center"> Por favor ingrese al aplicativo para administrar la cotización </p>
                    <div class="col-md-12" align="center">
                        <a href="https://intranet.masterquimica.com/">
                            <img src="https://intranet.masterquimica.com/resources/img/LOGO.png" style="width: 50px !important;">
                        </a>
                    </div>
            </body>
            </html>';
    break;
    case '6':
        $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
            </head>
            <body style="color:black; font-family: Roboto; font-size: 1.3em;">
                <div style="margin-top: 3em;margin-bottom: 3em;margin-left:15em;margin-right:15em;">
                    <div style="text-align: center">
                        <img style="max-width:350px;" src="https://intranet.masterquimica.com/resources/img/COTIZACIONES.png">
                    </div>
                    <p style="margin: 39px 49px 40px 71px;">
                        Buen día, <strong>'.($coti->nom_usu).' </strong><br><br>
                        Le informamos que su Cotización <strong> N#'.($coti->id_coti).'</strong> del cliente <strong>'.($coti->nom_cli).'</strong> fue <strong><i>Rechazada</i></strong>, 
                        Por favor revise los precios de su cotización e ingrese al aplicativo para administrar su cotización.
                    </p><div class="col-md-12" align="center">
                    <div class="col-md-12" align="center">
                        <a href="https://intranet.masterquimica.com/">
                            <img src="https://intranet.masterquimica.com/resources/img/LOGO.png" style="width: 50px !important;">
                        </a>
                    </div>
            </body>
            </html>';
    break;
    case '7':
        $mail->Body = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
        </head>
        <body style="color:black; font-family: Roboto; font-size: 1.3em;">
            <div style="margin-top: 3em;margin-bottom: 3em;margin-left:15em;margin-right:15em;">
                <div style="text-align: center">
                    <img style="max-width:350px;" src="https://intranet.masterquimica.com/resources/img/COTIZACIONES.png">
                </div>
                <p style="margin: 39px 49px 40px 71px;">
                    Buen día, <strong> </strong><br><br>
                    Le informamos que usted comento el motivo de rechazo de la cotizacion <strong> N# '.($coti->id_coti).'</strong> del cliente <strong>'.($coti->nom_cli).'</strong>
                </p>
                <p style="margin: 39px 49px 40px 71px;"><strong><i>Comentario:</i></p></strong>
                <span style="background-color: #dbdbdb; padding: .2em; border-radius: .25rem;margin-left: 71px;">
                '. ($com->desc_rechazo) .'
            </span>
        </body>
        </html>';
    break;
    case '8':
        $mail->Body = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
        </head>
        <body style="color:black; font-family: Roboto; font-size: 1.3em;">
            <div style="margin-top: 3em;margin-bottom: 3em;margin-left:15em;margin-right:15em;">
                <div style="text-align: center">
                    <img style="max-width:350px;" src="https://intranet.masterquimica.com/resources/img/COTIZACIONES.png">
                </div>
                <p style="margin: 39px 49px 40px 71px;">
                    Buen día, <strong>'.($coti->nom_usu).' </strong><br><br>
                    Enviamos el motivo de rechazo de la cotizacion <strong> N# '.($coti->id_coti).'</strong> del cliente <strong>'.($coti->nom_cli).'</strong>,
                    Por favor revise los precios de su cotización e ingrese al aplicativo para administrar su cotización. 
                </p>
                <p style="margin: 39px 49px 40px 71px;"><strong><i>Comentario:</i></p></strong>
                <span style="background-color: #dbdbdb; padding: .2em; border-radius: .25rem;margin-left: 71px;">
                '. ($com->desc_rechazo) .'
            </span>
        </body>
        </html>';

    break;
}?>