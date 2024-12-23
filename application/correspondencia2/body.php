<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
switch ($i) {
    case '1':
        //Nuevo Seguimiento 
    $mail->Body = '
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="stylesheet" href="https://masterquimica.com/subdominios/intranet/resources/css/bootstrap.min.css">
        </head>
        <body style="color:black;">
            <div class="col-12">
                <div class="col-12" align="center">
                <br>
                    <img src="https://masterquimica.com/subdominios/intranet/resources/utils/phpmailer/resources/correspondencia.png" width="300">    
                    <h3 style="color:black"> Usted a creado el seguimiento ' . ($usuM->id_seg) . ' en estado ' . ($usuM->nom_estS) . ' </h3><hr width="540">
                </div>
                
            </div>
            <div class="col-md-12" align="center">
                <div class="col-md-12">
                    <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                        <thead style="color:white;background:#58585C">
                            <tr style="height:40px;">
                                <th width="150">Documento</th>
                                <th width="250"> Proveedor</th>
                                <th width="250">Area Remitida </th>
                                <th width="250">Remitido A:</th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>
                                <tr aling="align="center">
                                    <td>'.$usuM->nom_doc.'</td>
                                    <td>'.$usuM->nom_cli.'</td>
                                    <td>'.$usuMRe->nom_are.'</td>
                                    <td>'.$usuMRe->nom_usu.'</td>
                                </tr>
                            </td>
                        </tbody>
                    </table>
                </div><br>
                <div  style="color:black">
                    <h3>Por favor contactese con el administrador para la entrega de los elementos.</h3><br>
                    <a href="https://intranet.masterquimica.com/">
                        <img src="http://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
                    </a>
                </div><br>
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
        <body style="color:black;background:#f9f9f9">
            <div class="col-12">
                <div class="col-12" align="center">
                <br>
                    <img src="https://masterquimica.com/subdominios/intranet/resources/utils/phpmailer/resources/correspondencia.png" width="300">    
                    <h3 style="color:black">El usuario ' .  $usuM->eml_usu . '  te asigno la siguiente correspondencia ' . ($usuM->id_seg) . ' en estado ' . ($usuM->nom_estS) . '  </h3><hr width="540">
                </div>
            </div>
            <div class="col-12" align="center">
                <div class="col-12">
                    <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                        <thead style="color:white;background:#58585C">
                            <tr style="height:40px;">
                                <th width="150">Documento</th>
                                <th width="250">Proveedor</th>
                                <th width="250">Area Que Remitió </th>
                                <th width="250">Remitido Por:</th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>
                                <tr aling="align="center">
                                    <td>'.$usuM->nom_doc.'</td>
                                    <td>'.$usuM->nom_cli.'</td>
                                    <td>'.$usuM->nom_are.'</td>
                                    <td>'.$usuM->nom_usu.'</td>
                                </tr>
                            </td>
                        </tbody>
                    </table>
                </div><br>
                <div  style="color:black">
                    <h3>Por favor ingrese al aplicativo para administrar el seguimiento .</h3><br>
                    <a href="https://intranet.masterquimica.com/">
                        <img src="http://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
                    </a>
                </div><br>
            </div>
        </body>
    </html>';
    break; 
    case '3':
    //Nuevo Seguimiento 
    $mail->Body = '
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="stylesheet" href="https://masterquimica.com/subdominios/intranet/resources/css/bootstrap.min.css">
        </head>

        <body style="color:black;background:#f9f9f9">
            <div class="col-12">
                <div class="col-12" align="center">
                <br>
                    <img src="https://masterquimica.com/subdominios/intranet/resources/utils/phpmailer/resources/correspondencia.png" width="300">    
                    <h3 style="color:black"> Usted a modificado el seguimiento ' . ($usuM->id_seg) . ' en estado ' . ($usuM->nom_estS) . ' </h3><hr width="540">
                </div>
                
            </div>
            <div class="col-12" align="center">
                <div class="col-12">
                    <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                        <thead style="color:white;background:#58585C">
                            <tr style="height:40px;">
                                <th width="150">Documento</th>
                                <th width="250">Proveedor</th>
                                <th width="250">Area Remitida </th>
                                <th width="250">Remitido A:</th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>
                                <tr aling="align="center">
                                    <td>' . $usuM->nom_doc . '</td>
                                    <td>' . $usuM->nom_cli.  '</td>
                                    <td>' . $usuMRe->nom_are. '</td>
                                    <td>' . $usuMRe->nom_usu. '</td>
                                </tr>
                            </td>
                        </tbody>
                    </table>
                </div><br>
                <div  style="color:black">
                        <h3>Por favor ingrese al aplicativo para administrar el seguimiento .</h3><br>
                        <a href="https://intranet.masterquimica.com/">
                            <img src="http://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
                        </a>
                </div><br>
            </div>
        </body>
    </html>';
    break;
    case '4':
    //al remitente 
    $mail->Body = '
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="stylesheet" href="https://masterquimica.com/subdominios/intranet/resources/css/bootstrap.min.css">
        </head>
        <body style="color:black;background:#f9f9f9">
            <div class="col-12">
                <div class="col-12" align="center">
                    <br>
                    <img src="https://masterquimica.com/subdominios/intranet/resources/utils/phpmailer/resources/correspondencia.png" width="300">    
                    <h3 style="color:black">El usuario ' .  $usuM->eml_usu . ' te asigno la siguiente correspondencia' . ($usuM->id_seg) . ' en estado ' . ($usuM->nom_estS) . '  </h3><hr width="540">
                </div>
            </div>
            <div class="col-12" align="center">
                <div class="col-12">
                <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                    <thead style="color:white;background:#58585C">
                        <tr style="height:40px;">
                            <th width="150">Documento</th>
                            <th width="250"> Proveedor</th>
                            <th width="250">Area Que Remitió </th>
                            <th width="250">Remitido Por:</th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <td>
                        <tr aling="align="center">
                            <td>' . $usuM->nom_doc. '</td>
                            <td>' . $usuM->nom_cli . '</td>
                            <td>' . $usuM->nom_are . '</td>
                            <td>' . $usuM->nom_usu . '</td>
                        </tr>
                    </td>
                        </tbody>
                    </table>
                </div>
                <br>
                    <div style="color:black">
                        <h3>Por favor ingrese al aplicativo para administrar el seguimiento .</h3><br>
                        <a href="https://intranet.masterquimica.com/">
                            <img src="http://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
                        </a>
                    </div>
                <br>
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
            <link rel="stylesheet" href="https://masterquimica.com/subdominios/intranet/resources/css/bootstrap.min.css">
        </head>
    
        <body style="color:black;background:#f9f9f9">
            <div class="col-12">
                <div class="col-12" align="center">
                <br>
                    <img src="https://masterquimica.com/subdominios/intranet/resources/utils/phpmailer/resources/correspondencia.png" width="300">    
                    <h3 style="color:black"> Usted a modificado el seguimiento ' . ($usuM->id_seg) . ' en estado ' . ($usuM->nom_estS) . ' </h3><hr width="540">
                </div>
            </div>
            <div class="col-12" align="center"
                <div class="col-12">
                    <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                        <thead style="color:white;background:#58585C">
                            <tr style="height:40px;">
                                <th width="150">Documento</th>
                                <th width="250">Proveedor</th>
                                <th width="250">Area Remitida </th>
                                <th width="250">Remitido A:</th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>
                                <tr aling="align="center">
                                    <td>'.$usuM->nom_doc.'</td>
                                    <td>'.$usuM->nom_cli.'</td>
                                    <td>'.$usuMRe->nom_are.'</td>
                                    <td>'.$usuMRe->nom_usu.'</td>
                                </tr>
                            </td>
                        </tbody>
                    </table>
                </div><br>
                <div  style="color:black">
                    Por favor ingrese al aplicativo para administrar el seguimiento .
                    <a href="https://intranet.masterquimica.com/">
                        <img src="http://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
                    </a>
                </div><br>
            </div>
        </body>
        </html>';
    break;
    case '6':
    //al remitente 
    $mail->Body = '
    <!DOCTYPE html>
    <html>
       <head>
           <meta charset="utf-8">
           <meta http-equiv="X-UA-Compatible" content="IE=edge">
           <link rel="stylesheet" href="https://masterquimica.com/subdominios/intranet/resources/css/bootstrap.min.css">
       </head>
   
       <body style="color:black;background:#f9f9f9">
           <div class="col-12">
               <div class="col-12" align="center">
               <br>
                   <img src="https://masterquimica.com/subdominios/intranet/resources/utils/phpmailer/resources/correspondencia.png" width="300">    
                   <h3 style="color:black">El usuario ' .  $usuM->eml_usu . '  a modificado el seguimiento ' . ($usuM->id_seg) . ' en estado ' . ($usuM->nom_estS) . '  </h3><hr width="540">
               </div>
           </div>
           <div class="col-12" align="center">
               <div class="col-12">
                   <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                       <thead style="color:white;background:#58585C">
                           <tr style="height:40px;">
                                <th width="150">Documento</th>
                                <th width="250">Proveedor</th>
                                <th width="250">Area Remitida </th>
                                <th width="250">Remitido A:</th></th>
                           </tr>
                       </thead>
                       <tbody>
                            <td>
                                <tr aling="align="center">
                                    <td>' . $usuM->nom_doc. '</td>
                                    <td>' . $usuM->nom_cli . '</td>
                                    <td>' . $usuM->nom_are . '</td>
                                    <td>' . $usuM->nom_usu . '</td>
                                </tr>
                            </td>
                        </tbody>
                    </table>
                </div><br>
                <div  style="color:black">
                    Por favor ingrese al aplicativo para administrar el seguimiento .<br>
                    <a href="https://intranet.masterquimica.com/">
                        <img src="http://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
                    </a>
                </div><br>
            </div>
        </body>
    </html>';
        break;
 /* case '7':
        $mail->Body = '
          <!DOCTYPE html>
          <html>
          <head>
              <meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <link rel="stylesheet" href="https://masterquimica.com/subdominios/intranet/resources/css/bootstrap.min.css">
          </head>
      
          <body style="color:black;background:#f9f9f9">
              <div class="col-12">
                  <div class="col-12" align="center">
                  <br>
                      <img src="https://masterquimica.com/subdominios/intranet/resources/utils/phpmailer/resources/correspondencia.png" width="300">    
                      <h3 style="color:black"> Usted a creado los siguientes seguimientos </h3><hr width="540">
                  </div>
                  
              </div>
              <div class="col-12" align="center">
                  <div class="col-12">
                      <table class="table table-bordered" id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                          <thead style="color:white;background:#58585C">
                              <tr style="height:40px;">
                                  <th style="border-radius: 0px 0px 0px 0px;"># Seguimiento 
                                          <th width="150">Documento</th>
                                          <th width="250"> Proveedor</th>
                                          <th width="250"> Factura en Myprocess </th>
                                          <th width="250">N° Factura:</th></th>
                              </tr>
                          </thead>
                          <tbody>
                          <td>';
        while ($rT = $querytable->fetch(PDO::FETCH_ASSOC)) {
            $mail->Body .= '<tr aling="align="center">
                                          <td width="80">' . $rT["id_seg"] . '</td>
                                          <td>' . $rT["nom_doc"] . '</td>
                                          <td>' . $rT["nom_pro"] . '</td>
                                          <td>' . $rT["conse_fac"] . '</td>
                                          <td>' . $rT["num_facR"] . '</td>
                                          </tr>';
        }
        $mail->Body .= ' </td>
                              </tbody>
                          </table>
                      </div>
                      <br>
                          <div  style="color:black">
                          Por favor ingrese al aplicativo para administrar los seguimientos.
                          </div>
                      <br>
                  </div>
              </body>
              </html>
       ';
        break;
    case '8':
        //al remitente 
        $mail->Body = '
             <!DOCTYPE html>
             <html>
             <head>
                 <meta charset="utf-8">
                 <meta http-equiv="X-UA-Compatible" content="IE=edge">
                 <link rel="stylesheet" href="https://masterquimica.com/subdominios/intranet/resources/css/bootstrap.min.css">
             </head>
         
             <body style="color:black;background:#f9f9f9">
                 <div class="col-12">
                     <div class="col-12" align="center">
                     <br>
                         <img src="https://masterquimica.com/subdominios/intranet/resources/utils/phpmailer/resources/correspondencia.png" width="300">    
                         <h3 style="color:black">El usuario ' .  $usuM->eml_usu . '  a modificado los siguientes seguimientos en estado ' . ($usuM->nom_estS) . '  </h3><hr width="540">
                     </div>
                     
                 </div>
                 <div class="col-12" align="center">
                     <div class="col-12">
                         <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                             <thead style="color:white;background:#58585C">
                                 <tr style="height:40px;">
                                    <th style="border-radius: 0px 0px 0px 0px;"># Seguimiento 
                                    <th width="150">Documento</th>
                                    <th width="250">Proveedor</th>
                                    <th width="250">Factura en Myprocess </th>
                                    <th width="250">N° Factura:</th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <td>';
        while ($rT = $querytable->fetch(PDO::FETCH_ASSOC)) {
            $mail->Body .= '<tr aling="align="center">
                                                <td width="80">' . $rT["id_seg"] . '</td>
                                                <td>' . $rT["nom_doc"] . '</td>
                                                <td>' . $rT["nom_pro"] . '</td>
                                                <td>' . $rT["conse_fac"] . '</td>
                                                <td>' . $rT["num_facR"] . '</td>
                                                </tr>';
        }
        $mail->Body .= ' </td>
                                 </tbody>
                             </table>
                         </div>
                         <br>
                             <div  style="color:black">
                             Por favor ingrese al aplicativo para administrar los seguimientos .
                             </div>
                         <br>
                     </div>
                 </body>
                 </html>
          ';
        break;*/
}
