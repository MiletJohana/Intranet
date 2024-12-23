<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';

switch ($i) {
    case '1':
    //USUARIO QUE CREA EL PERMISO
    $mail->Body = '
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="stylesheet" href="http://masterquimica.com/subdominios/intranet/resources/css/bootstrap.min.css">
        </head>
        <body style="color:black;background:#f9f9f9">
            <div class="col-md-12">
                <div class="col-md-12" align="center">
                <br>
                    <img src="http://masterquimica.com/subdominios/intranet/resources/img/PERMISOS.png" width="400">    
                    <h3 style="color:black;margin-top: -10px;"> Usted ha modificado su permiso '. ($usu->id_per) .' en estado '. ($usu->nom_estPer).' </h3><hr width="700">
                </div>
            </div>
            <div class="col-md-12" align="center">
                <div class="col-md-12">
                    <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                        <thead style="color:white;background:#58585C">
                            <tr style="height:40px;">
                                <th style="border-radius: 0px 0px 0px 0px;">#
                                <th width="250">Fecha de Ausencia</th>
                                <th width="250">Motivo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>
                                <tr align="center">
                                    <td width="80">'.$usu->id_per.'</td>
                                    <td>'.$usu->fech_aus.'</td>
                                    <td>'.$usu->descrip_per.'</td>
                                </tr>
                            </td
                        </tbody>
                    </table>
                </div>
                <br>
                    <div  style="color:black">
                    <h3 style="color:black;margin-top: 1px;">Por favor ingrese a nuestro aplicativo para administrar sus Permisos</h3>
                        <a href="https://intranet.masterquimica.com/">
                        <img src="http://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
                        </a>
                    </div>
                <br>
            </div>
        </body>
    </html>
         ';
    break;
    case '2':
    //NOTIFICACION A LIDER 
    $mail->Body = '
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="stylesheet" href="http://masterquimica.com/subdominios/intranet/resources/css/bootstrap.min.css">
        </head>
        <body style="color:black;background:#f9f9f9">
            <div class="col-md-12">
                <div class="col-md-12" align="center">
                <br>
                    <img src="http://masterquimica.com/subdominios/intranet/resources/img/PERMISOS.png" width="400">    
                    <h3 style="color:black;margin-top: 10px;"> El Colaborador '.($usu->nom_usu).' Solicitó  Un Permiso   </h3><hr width="700">
                </div>
                
            </div>
            <div class="col-md-12" align="center">
                <div class="col-md-12">
                    <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                        <thead style="color:white;background:#58585C">
                            <tr style="height:40px;">
                                <th style="border-radius: 0px 0px 0px 0px;"># 
                                <th width="150">Fecha De Ausencia</th>
                                <th width="250">Motivo</th>
                                <th width="250">Estado</th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <td>
                            <tr align="center">
                                <td width="80">'.$usu->id_per.'</td>
                                <td>'.$usu->fech_aus.'</td>
                                <td>'.$usu->descrip_per.'</td>
                                <td>'.$usu->nom_estPer.'</td>
                            </tr>
                        </td>
                        </tbody>
                    </table>
                </div>
                <br>
                    <div  style="color:black">
                    <h3 style="color:black;margin-top: 1px;">Por favor ingrese a nuestro aplicativo para administrar los permisos agendados</h3>
                        <a href="https://intranet.masterquimica.com/">
                        <img src="http://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
                        </a>
                    </div>
                <br>
            </div>
        </body>
    </html>
         ';
    break;

    case '3':
    //USUARIO DE TALENTO HUMANO O ADMINISTRADOR CREA EL PERMISO
    $mail->Body = '
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="stylesheet" href="http://masterquimica.com/subdominios/intranet/resources/css/bootstrap.min.css">
        </head>
        
        <body style="color:black;background:#f9f9f9">
            <div class="col-md-12">
                <div class="col-md-12" align="center">
                <br>
                    <img src="http://masterquimica.com/subdominios/intranet/resources/img/PERMISOS.png" width="400">    
                    <h3 style="color:black;margin-top: -10px;"> Usted ha modificado el permiso de '. ($usu->nom_usu).' </h3><hr width="700">
                </div>
            </div>
            <div class="col-md-12" align="center">
                <div class="col-md-12">
                    <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                        <thead style="color:white;background:#58585C">
                            <tr style="height:40px;">
                                <th style="border-radius: 0px 0px 0px 0px;">#
                                        <th width="250">Fecha de Ausencia</th>
                                        <th width="250">Motivo</th>
                            </tr>
                        </thead>
                        <tbody>
                        <td>
                            <tr align="center">
                                <td width="80">'.$usu->id_per.'</td>
                                <td>'.$usu->fech_aus.'</td>
                                <td>'.$usu->descrip_per.'</td>
                            </tr>
                        </td>

                        </tbody>
                    </table>
                </div>
                <br>
                    <div  style="color:black">
                    <h3 style="color:black;margin-top: 1px;">Por favor ingrese a nuestro aplicativo para administrar sus Permisos</h3>
                        <a href="https://intranet.masterquimica.com/">
                        <img src="http://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
                        </a>
                    </div>
                <br>
            </div>
        </body>
    </html>
          ';
    break;
                
    case '4':
    // USUARIO DEL PERMISO QUE SE CREO 
        $mail->Body = '
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <link rel="stylesheet" href="http://masterquimica.com/subdominios/intranet/resources/css/bootstrap.min.css">
            </head>
        <body style="color:black;background:#f9f9f9">
                <div class="col-md-12">
                    <div class="col-md-12" align="center">
                    <br>
                        <img src="http://masterquimica.com/subdominios/intranet/resources/img/PERMISOS.png" width="400">    
                        <h3 style="color:black;margin-top: 10px;"> El Colaborador '.($adm->nom_usu).' solicitó un permiso a tu nombre   </h3><hr width="700">
                    </div>
                    
                </div>
                <div class="col-md-12" align="center">
                    <div class="col-md-12">
                        <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                            <thead style="color:white;background:#58585C">
                                <tr style="height:40px;">
                                    <th style="border-radius: 0px 0px 0px 0px;"># 
                                    <th width="150">Fecha De Ausencia</th>
                                    <th width="250">Motivo</th>
                                    <th width="250">Estado</th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <td>
                                <tr align="center">
                                    <td width="80">'.$usu->id_per.'</td>
                                    <td>'.$usu->fech_aus.'</td>
                                    <td>'.$usu->descrip_per.'</td>
                                    <td>'.$usu->nom_estPer.'</td>
                                </tr>
                            </td>
                            </tbody>
                        </table>
                    </div>
                    <br>
                        <div  style="color:black">
                        <h3 style="color:black;margin-top: 1px;">Por favor ingrese a nuestro aplicativo para administrar los permisos agendados</h3>
                            <a href="https://intranet.masterquimica.com/">
                            <img src="http://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
                            </a>
                        </div>
                    <br>
                </div>
            </body>
        </html>
            ';
        break;
        case '5':
        //NOTIFICACION A LIDER 
        $mail->Body = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="stylesheet" href="http://masterquimica.com/subdominios/intranet/resources/css/bootstrap.min.css">
        </head>
        
        <body style="color:black;background:#f9f9f9">
            <div class="col-md-12">
                <div class="col-md-12" align="center">
                <br>
                    <img src="http://masterquimica.com/subdominios/intranet/resources/img/PERMISOS.png" width="400">    
                    <h3 style="color:black;margin-top: 10px;"> Usted modifico el permiso del colaborador '.($usu->nom_usu).' a estado '.($usu->nom_estPer).'  </h3><hr width="700">
                </div>
                
            </div>
            <div class="col-md-12" align="center">
                <div class="col-md-12">
                    <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                        <thead style="color:white;background:#58585C">
                            <tr style="height:40px;">
                                <th style="border-radius: 0px 0px 0px 0px;"># 
                                        <th width="150">Fecha De Ausencia</th>
                                        <th width="250">Motivo</th>
                                        <th width="250">Estado</th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <td>
                           <tr align="center">
                               <td width="80">'.$usu->id_per.'</td>
                               <td>'.$usu->fech_aus.'</td>
                               <td>'.$usu->descrip_per.'</td>
                               <td>'.$usu->nom_estPer.'</td>
                           </tr>
                        </td>
                        </tbody>
                    </table>
                </div>
                <br>
                   <div  style="color:black">
                     <h3 style="color:black;margin-top: 1px;">Por favor ingrese a nuestro aplicativo para administrar los permisos agendados</h3>
                       <a href="https://intranet.masterquimica.com/">
                       <img src="http://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
                       </a>
                   </div>
                <br>
            </div>
        </body>
    </html>
    ';
   break;
   case '6':
        //NOTIFICACION A LIDER 
        $mail->Body = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="stylesheet" href="http://masterquimica.com/subdominios/intranet/resources/css/bootstrap.min.css">
        </head>
        
        <body style="color:black;background:#f9f9f9">
            <div class="col-md-12">
                <div class="col-md-12" align="center">
                <br>
                    <img src="http://masterquimica.com/subdominios/intranet/resources/img/PERMISOS.png" width="400">    
                    <h3 style="color:black;margin-top: 10px;"> El Lider '.($lid->nom_usu).' modificó tu permiso a estado '.($usu->nom_estPer).'  </h3><hr width="700">
                </div>
                
            </div>
            <div class="col-md-12" align="center">
                <div class="col-md-12">
                    <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                        <thead style="color:white;background:#58585C">
                            <tr style="height:40px;">
                                <th style="border-radius: 0px 0px 0px 0px;"># 
                                        <th width="150">Fecha De Ausencia</th>
                                        <th width="250">Motivo</th>
                                        <th width="250">Estado</th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <td>
                           <tr align="center">
                               <td width="80">'.$usu->id_per.'</td>
                               <td>'.$usu->fech_aus.'</td>
                               <td>'.$usu->descrip_per.'</td>
                               <td>'.$usu->nom_estPer.'</td>
                           </tr>
                        </td>
                        </tbody>
                    </table>
                </div>
                <br>
                   <div  style="color:black">
                     <h3 style="color:black;margin-top: 1px;">Por favor ingrese a nuestro aplicativo para administrar los permisos agendados</h3>
                       <a href="https://intranet.masterquimica.com/">
                       <img src="http://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
                       </a>
                   </div>
                <br>
            </div>
        </body>
    </html>
    ';
   break;
}
?>