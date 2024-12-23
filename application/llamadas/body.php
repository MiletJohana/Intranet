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
            <link rel="stylesheet" href="https://masterquimica.com/subdominios/intranet/resources/css/bootstrap.min.css">
        </head>
        <body style="color:black;">
            <div class="col-md-12">
                <div class="col-md-12" align="center">
                <br>
                    <img src="https://masterquimica.com/subdominios/intranet/resources/img/llamadasinternas.png" width="300">    
                    <h4 style="color:black"> Te informamos que realizaste una llamada al colaborador  ' . ($rem->nom_usu) . ' </h4><hr width="540">
                </div>
                
            </div>
            <div class="col-md-12" align="center">
                <div class="col-md-12">
                    <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;width: 663px">
                        <thead style="color:white;background:#58585C">
                            <tr>
                                <th width="150">Hora</th>
                                <th width="250">Observación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr align="center">
                                <td>' . $usu->fec_llam . '</td>
                                <td>' . $usu->ob_llam . '</td>    
                            </tr>';
            $mail->Body .= '
                        </tbody>
                    </table>
                </div>
            </div>
            <p style="margin: 39px 133px 40px 149px;" align="center">
                Por favor ingrese al aplicativo para administrar la llamada.
            </p>
            <div style="color:black" align="center">
                <a href="https://intranet.masterquimica.com/">
                    <img src="https://intranet.masterquimica.com/resources/img/LOGO.png" style="width: 50px;">
                </a>
            </div>
        </body>
        </html>';
        break;
        case '2':
        //al remitente 
        $mail->Body = '
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <link rel="stylesheet" href="https://masterquimica.com/subdominios/intranet/resources/css/bootstrap.min.css">
            </head>

            <body style="color:black;">
                <div class="col-md-12">
                    <div class="col-md-12" align="center">
                    <br>
                        <img src="https://masterquimica.com/subdominios/intranet/resources/img/llamadasinternas.png" width="300">    
                        <h4 style="color:black"> Te informamos que el colaborador ' . ($usu->nom_usu) .' te realizó una llamada </h4><hr width="540">
                    </div>
                    
                </div>
                <div class="col-md-12" align="center">
                    <div class="col-md-12">
                        <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;width: 663px">
                            <thead style="color:white;background:#58585C">
                                <tr>
                                    <th width="150">Hora</th>
                                    <th width="250">Observación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td>' . $usu->fec_llam . '</td>
                                    <td>' . $usu->ob_llam . '</td>    
                                </tr>';
                $mail->Body .= '
                            </tbody>
                        </table>
                    </div>
                </div>
                <p style="margin: 39px 133px 40px 149px;" align="center">
                    Por favor ingrese al aplicativo para administrar la llamada.
                </p>
                <div style="color:black" align="center">
                    <a href="https://intranet.masterquimica.com/">
                        <img src="https://intranet.masterquimica.com/resources/img/LOGO.png" style="width: 50px;">
                    </a>
                </div>
                </body>
            </html>';
    break;
}?>
