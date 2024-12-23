<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
$sqlEma="SELECT est.id_est, cli.nom_cli, sol.id_sol, cli.id_cli, us.nom_usu, sol.fec_sol, est.nom_est, cli.ase_com , sol.obser_perm
FROM mq_usu us, cre_estadosol est, mq_clie cli,cre_solicitud sol
WHERE cli.ase_com= us.id_usu 
AND sol.id_est=est.id_est
AND cli.id_cli=sol.id_cli";
if($_POST['action']!='add'){
    $sqlEma.=" AND sol.id_sol=".$_POST['id_sol']." ORDER BY sol.id_sol DESC";
}
$queryEma=$conexion->query($sqlEma);
$queryEma2=$conexion->query($sqlEma);
while ($r=$queryEma->fetch(PDO::FETCH_OBJ)){
    $ema=$r;
    break;
}
$sqlNom="SELECT us.nom_usu,us.eml_usu
FROM mq_usu us, cre_solicitud sol
WHERE sol.id_usu=us.id_usu";
$queryNom=$conexion->query($sqlNom);
while ($r=$queryNom->fetch(PDO::FETCH_OBJ)){
    $nom=$r;
    break;
}
$sqlCon="SELECT us.nom_usu, us.eml_usu
FROM mq_usu us
WHERE id_rol=200";
$queryCon=$conexion->query($sqlCon);
while ($r=$queryCon->fetch(PDO::FETCH_OBJ)){
    $con=$r;
    break;
}
$sqlTe="SELECT us.nom_usu, us.eml_usu
FROM mq_usu us
WHERE id_rol=300";
$queryTe=$conexion->query($sqlTe);
while ($r=$queryTe->fetch(PDO::FETCH_OBJ)){
    $te=$r;
    break;
}

$sqlsac="SELECT sol.id_sol, es.id_est ,es.nom_est, cli.id_cli, cli.nom_cli, sol.fec_sol, cli.ase_com , us.nom_usu,sol.id_usu,sol.obser_perm
FROM cre_solicitud sol, cre_estadosol es, mq_clie cli, mq_usu us
WHERE sol.id_est=es.id_est
AND cli.id_cli=sol.id_cli
AND cli.ase_com= us.id_usu";
if((isset($_POST['action']) && $_POST['action']=='add')){
 $sqlsac.=" ORDER BY sol.id_sol DESC";
}else{
 $sqlsac.=" AND sol.id_sol=".$_POST['id_sol'];
}
$querysac=$conexion->query($sqlsac);
while($rSac=$querysac->fetch(PDO::FETCH_OBJ)){
    $sac=$rSac;
    break;
}
$sqlUsac="SELECT us.eml_usu, us.nom_usu, us.id_rol
FROM mq_usu us
WHERE us.id_usu=$sac->id_usu";
$queryUsac=$conexion->query($sqlUsac);
while ($rUsac=$queryUsac->fetch(PDO::FETCH_OBJ)){
    $usac=$rUsac;
    break;
}


switch ($i) {
    case '1':
    //Sac Nueva Solicitud
        $mail->Body = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
        </head>
        
        <body style="color:black;background:#f9f9f9">
            <div class="col-md-12">
                <div class="col-md-12" align="center">
                <br>
                    <img src="https://intranet.masterquimica.com/resources/img/solicitud_credito.png" width="300">    
                    <h3 style="color:black"> Usted ha modificado la solicitud '. ($sac->id_sol) .' en estado  '. ($sac->nom_est) .' </h3><hr width="540">
                </div>
                
            </div>
            <div class="col-md-12" align="center">
                <div class="col-md-12">
                    <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                        <thead style="color:white;background:#58585C">
                            <tr style="height:40px;">
                                <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                                        <th width="150">Cliente</th>
                                        <th width="250">Fecha de Creación</th>
                                        <th width="250">Asesor Comercial</th></th>
                            </tr>
                        </thead>
                        <tbody>
        
                        <td>
                                    <tr align="center">
                                        <td width="80">'.$sac->id_sol.'</td>
                                        <td>'.$sac->nom_cli.'</td>
                                        <td>'.$sac->fec_sol.'</td>
                                        <td>'.$sac->nom_usu.'</td>
                                    </tr>
                        </td>
                        </tbody>
                    </table>
                </div>
                <br>
                    <div  style="color:black">
                        
                    </div>
                <br>
            </div>
        </body>
        </html>
 ';
        break;
      
      case '2':
    //solicitud nueva  llega a Natalia 
        $mail->Body = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
        </head>
        
        <body style="color:black;background:#f9f9f9">
            <div class="col-md-12">
                <div class="col-md-12" align="center">
                <br>
                    <img src="https://intranet.masterquimica.com/resources/img/solicitud_credito.png" width="300">    
                    <h3 style="color:black"> La solicitud  '. ($sac->id_sol) .'  se ha modificado en estado  '. ($sac->nom_est).' </h3><hr width="540">
                </div>
                
            </div>
            <div class="col-md-12" align="center">
                <div class="col-md-12">
                    <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                        <thead style="color:white;background:#58585C">
                            <tr style="height:40px;">
                                <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                                        <th width="150">Cliente</th>
                                        <th width="250">Fecha de Creación</th>
                                        <th width="250">Asesor Comercial</th>
                                        <th width="250">Estado </th></th>
                            </tr>
                        </thead>
                        <tbody>
        
                 <td>
                                    <tr align="center">
                                        <td width="80">'.$sac->id_sol.'</td>
                                        <td>'. $sac->nom_cli.'</td>
                                        <td>'.$sac->fec_sol.'</td>
                                        <td>'.$sac->nom_usu.'</td>
                                        <td>'.$sac->nom_est.'</td>
                                    </tr>
                        </td>

                        </tbody>
                    </table>
                </div>
                <br>
                    <div  style="color:black">
                        
                    </div>
                <br>
            </div>
        </body>
        </html>
            ';

        break;
        case '3':
        //modifica natalia  ; nueva a pendiente  
            $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
            </head>
            
            <body style="color:black;background:#f9f9f9">
                <div class="col-md-12">
                    <div class="col-md-12" align="center">
                    <br>
                        <img src="https://intranet.masterquimica.com/resources/img/solicitud_credito.png" width="300">    
                        <h3 style="color:black"> Usted ha modificado la solicitud  '. ( $sac->id_sol ) .'en estado '. ( $sac->nom_est ) .' </h3><hr width="540">
                    </div>
                    
                </div>
                <div class="col-md-12" align="center">
                    <div class="col-md-12">
                        <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                            <thead style="color:white;background:#58585C">
                                <tr style="height:40px;">
                                    <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                                            <th width="150">Cliente</th>
                                            <th width="250">Fecha de Creación</th>
                                            <th width="250">Asesor Comercial</th></th>
                                            
                                </tr>
                            </thead>
                            <tbody>
            
                                <td>';
                             while($rE2=$queryEma2->fetch(PDO::FETCH_ASSOC)){
                                $mail->Body .= ' <tr align="center">
                                                <td width="80">'.$rE2["id_sol"].'</td>
                                                <td>'.$rE2["nom_cli"].'</td>
                                                <td>'.$rE2["fec_sol"].'</td>
                                                <td>'.$rE2["nom_usu"].'</td>
                                            </tr>';
                                        } 
                                $mail->Body .=' </td>
                                    
                            </tbody>
                        </table>
                    </div>
                    <br>
                        <div  style="color:black">

                        </div>
                    <br>
                </div>
            </body>
            </html>
                ';
    
            break;         
            case '4':
            //modifica natalia  ; nueva a pendiente - se muestra a tesoreria 
                $mail->Body = '
                 <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
            </head>
            
            <body style="color:black;background:#f9f9f9">
                <div class="col-md-12">
                    <div class="col-md-12" align="center">
                    <br>
                        <img src="https://intranet.masterquimica.com/resources/img/solicitud_credito.png" width="300">    
                        <h3 style="color:black"> La solicitud  '. ($sac->id_sol) .'  se ha modificado en estado  '. ($sac->nom_est) .' </h3><hr width="540">
                    </div>
                    
                </div>
                <div class="col-md-12" align="center">
                <div class="col-md-12">
                    <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                        <thead style="color:white;background:#58585C">
                            <tr style="height:40px;">
                                <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                                        <th width="150">Cliente</th>
                                        <th width="250">Fecha de Creación</th>
                                        <th width="250">Asesor Comercial</th>
                                        <th width="250">Estado </th></th>
                            </tr>
                        </thead>
                        <tbody>
        
                            <td>';
                            while($rE2=$queryEma2->fetch(PDO::FETCH_ASSOC)){
                            $mail->Body.= '<tr align="center">
                                                <td width="80">'.$rE2["id_sol"].'</td>
                                                <td>'.$rE2["nom_cli"].'</td>
                                                <td>'.$rE2["fec_sol"].'</td>
                                                <td>'.$rE2["nom_usu"].'</td>
                                                <td>'.$rE2["nom_est"].'</td>
                                            
                                          </tr>';
                                     } 
                 $mail->Body .=' </td>
                                
                        </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </body>
            </html>
                    ';
        
                break;             
                case '5':
                //modifica tesoreria ; pendiente - aprobado- se muestra a tesoreria 
                    $mail->Body = '
                     <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
                </head>
                
                <body style="color:black;background:#f9f9f9">
                    <div class="col-md-12">
                        <div class="col-md-12" align="center">
                        <br>
                            <img src="https://intranet.masterquimica.com/resources/img/solicitud_credito.png" width="300">    
                            <h3 style="color:black"> Usted ha modificado la solicitud '. ($sac->id_sol) .' en estado '. ($sac->nom_est) .' </h3><hr width="540">
                        </div>
                        
                    </div>
                    <div class="col-md-12" align="center">
                    <div class="col-md-12">
                        <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                            <thead style="color:white;background:#58585C">
                                <tr style="height:40px;">
                                    <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                                            <th width="150">Cliente</th>
                                            <th width="250">Fecha de Creación</th>
                                            <th width="250">Asesor Comercial</th>
                                            <th width="250">Estado </th></th>
                                </tr>
                            </thead>
                            <tbody>
            
                                <td>';
                                while($rE2=$queryEma2->fetch(PDO::FETCH_ASSOC)){
                                    $mail->Body.= ' <tr align="center">
                                                        <td width="80">'.$rE2["id_sol"].'</td>
                                                        <td>'.$rE2["nom_cli"].'</td>
                                                        <td>'.$rE2["fec_sol"].'</td>
                                                        <td>'.$rE2["nom_usu"].'</td>
                                                        <td>'.$rE2["nom_est"].'</td>
                                                
                                                     </tr>';
                                        } 
                                    $mail->Body .=' </td>
                                    
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </body>
            </html>
                        ';
            
                    break;  
                    
             case '6':
            //modifica tesoreria ; pendiente  aprobado remite a sac  
                $mail->Body = '
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
                </head>
                
                <body style="color:black;background:#f9f9f9">
                    <div class="col-md-12">
                        <div class="col-md-12" align="center">
                        <br>
                            <img src="https://intranet.masterquimica.com/resources/img/solicitud_credito.png" width="300">    
                            <h2 style="color:black"><h3 style="color:black"> La solicitud  '. ($sac->id_sol) .'  se ha modificado en estado '. ($sac->nom_est).' </h3><hr width="540">
                        </div>
                        
                    </div>
                    <div class="col-md-12" align="center">
                    <div class="col-md-12">
                        <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                            <thead style="color:white;background:#58585C">
                                <tr style="height:40px;">
                                    <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                                            <th width="150">Cliente</th>
                                            <th width="250">Fecha de Creación</th>
                                            <th width="250">Asesor Comercial</th>
                                            <th width="250">Estado </th></th>
                                </tr>
                            </thead>
                            <tbody>
            
                                <td>';
                                while($rE2=$queryEma2->fetch(PDO::FETCH_ASSOC)){
                                    $mail->Body.= '<tr align="center">
                                                <td width="80">'.$rE2["id_sol"].'</td>
                                                <td>'.$rE2["nom_cli"].'</td>
                                                <td>'.$rE2["fec_sol"].'</td>
                                                <td>'.$rE2["nom_usu"].'</td>
                                                <td>'.$rE2["nom_est"].'</td>
                                                
                                            </tr>';
                                        } 
                                        $mail->Body .='</td>
                                    
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </body>
            </html>
                    ';
                break;  

                case '7':
                //modifica tesoreria ; pendiente a rechazado- se muestra a tesoreria 
                    $mail->Body = '
                     <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
                </head>
                
                <body style="color:black;background:#f9f9f9">
                    <div class="col-md-12">
                        <div class="col-md-12" align="center">
                        <br>
                            <img src="https://intranet.masterquimica.com/resources/img/solicitud_credito.png" width="300">    
                            <h3 style="color:black"> Usted ha modificado la solicitud '. ($sac->id_sol) .' en estado '. ($sac->nom_est) .' </h3><hr width="540">
                        </div>
                        
                    </div>
                    <div class="col-md-12" align="center">
                    <div class="col-md-12">
                        <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                            <thead style="color:white;background:#58585C">
                                <tr style="height:40px;">
                                    <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                                            <th width="150">Cliente</th>
                                            <th width="250">Fecha de Creación</th>
                                            <th width="250">Asesor Comercial</th>
                                            <th width="250">Estado </th></th>
                                </tr>
                            </thead>
                            <tbody>
            
                                <td>';
                                 while($rE2=$queryEma2->fetch(PDO::FETCH_ASSOC)){
                                            $mail->Body.= '<tr align="center">
                                                <td width="80">'.$rE2["id_sol"].'</td>
                                                <td>'.$rE2["nom_cli"].'</td>
                                                <td>'.$rE2["fec_sol"].'</td>
                                                <td>'.$rE2["nom_usu"].'</td>
                                                <td>'.$rE2["nom_est"].'</td>
                                                
                                            </tr>';
                                        } 
                                        $mail->Body .='</td>
                                    
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </body>
            </html>
           ';
            
                    break;  
                    
             case '8':
            //modifica tesoreria ; pendiente-rechazado remite a sac  
                $mail->Body = '
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
                </head>
                
                <body style="color:black;background:#f9f9f9">
                    <div class="col-md-12">
                        <div class="col-md-12" align="center">
                        <br>
                            <img src="https://intranet.masterquimica.com/resources/img/solicitud_credito.png" width="300">    
                            <h3 style="color:black"> La solicitud  '. ($sac->id_sol) .'  se ha modificado en estado '. ($sac->nom_est) .' </h3><hr width="540">
                        </div>
                        
                    </div>
                    <div class="col-md-12" align="center">
                    <div class="col-md-12">
                        <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                            <thead style="color:white;background:#58585C">
                                <tr style="height:40px;">
                                    <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                                            <th width="150">Cliente</th>
                                            <th width="250">Fecha de Creación</th>
                                            <th width="250">Asesor Comercial</th>
                                            <th width="250">Estado </th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>';
                                      while($rE2=$queryEma2->fetch(PDO::FETCH_ASSOC)){
                                        $mail->Body.= '<tr align="center">
                                                        <td width="80">'.$rE2["id_sol"].'</td>
                                                        <td>'.$rE2["nom_cli"].'</td>
                                                        <td>'.$rE2["fec_sol"].'</td>
                                                        <td>'.$rE2["nom_usu"].'</td>
                                                        <td>'.$rE2["nom_est"].'</td>
                                                
                                            </tr>';
                                        } 
                $mail->Body .='</td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </body>
            </html>
                    ';
                break;  

                case '9':
                //modifica tesoreria ; edicion Sac o edicion cont muestra tesoreria 
                    $mail->Body = '
                   
                      <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
                </head>
                
                <body style="color:black;background:#f9f9f9">
                    <div class="col-md-12">
                        <div class="col-md-12" align="center">
                        <br>
                            <img src="https://intranet.masterquimica.com/resources/img/solicitud_credito.png" width="300">    
                            <h3 style="color:black"> Usted ha modificado la solicitud '. ($sac->id_sol) .' en estado  '. ($sac->nom_est) .' </h3><hr width="540">
                        </div>
                        
                    </div>
                    <div class="col-md-12" align="center">
                    <div class="col-md-12">
                        <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                            <thead style="color:white;background:#58585C">
                                <tr style="height:40px;">
                                    <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                                            <th width="150">Cliente</th>
                                            <th width="250">Fecha de Creación</th>
                                            <th width="250">Asesor Comercial</th>
                                            <th width="250">Estado </th>
                                            <th width="250">Observación </th></th>
                                </tr>
                            </thead>
                            <tbody>
            
                                  <td>';
                                           while($rE2=$queryEma2->fetch(PDO::FETCH_ASSOC)){
                                            $mail->Body.= '<tr align="center">
                                                                <td width="80">'.$rE2["id_sol"].'</td>
                                                                <td>'.$rE2["nom_cli"].'</td>
                                                                <td>'.$rE2["fec_sol"].'</td>
                                                                <td>'.$rE2["nom_usu"].'</td>
                                                                <td>'.$rE2["nom_est"].'</td> 
                                                                <td>'.$rE2["obser_perm"].'</td> 
                                                          </tr>';
                                                        } 
                  $mail->Body .='</td>
                                    
                            </tbody>
                        </table>
                    </div>
                </div>
            </body>
            </html>';
            
                    break;  
                case '10':
            //modifica tesoreria ; edicion sac muestra sac
                $mail->Body = '
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
                </head>
                
                <body style="color:black;background:#f9f9f9">
                    <div class="col-md-12">
                        <div class="col-md-12" align="center">
                        <br>
                            <img src="https://intranet.masterquimica.com/resources/img/solicitud_credito.png" width="300">    
                            <h3 style="color:black"> La solicitud  '. ($sac->id_sol) .'  se ha modificado en estado'. ($sac->nom_est) .' </h3><hr width="540">
                        </div>
                        
                    </div>
                    <div class="col-md-12" align="center">
                    <div class="col-md-12">
                        <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                            <thead style="color:white;background:#58585C">
                                <tr style="height:40px;">
                                    <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                                            <th width="150">Cliente</th>
                                            <th width="250">Fecha de Creación</th>
                                            <th width="250">Asesor Comercial</th>
                                            <th width="250">Estado </th>
                                            <th width="250">Observación </th></th>
                                </tr>
                            </thead>
                            <tbody>
            
                                <td>';
                                     while($rE2=$queryEma2->fetch(PDO::FETCH_ASSOC)){
                                        $mail->Body.= '<tr align="center">
                                                            <td width="80">'.$rE2["id_sol"].'</td>
                                                            <td>'.$rE2["nom_cli"].'</td>
                                                            <td>'.$rE2["fec_sol"].'</td>
                                                            <td>'.$rE2["nom_usu"].'</td>
                                                            <td>'.$rE2["nom_est"].'</td>
                                                            <td>'.$rE2["obser_perm"].'</td> 

                                            </tr>';
                                        } 
                $mail->Body .='</td>
                                    
                            </tbody>
                        </table>
                    </div>
                    <br>
                        <div  style="color:black">
                            
                        </div>
                    <br>
                </div>
            </body>
            </html>
                    ';
                break;   
                case '11':
                //modifica tesoreria ; edicion cont muestra tesoreria 
                    $mail->Body = '
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
                </head>
                
                <body style="color:black;background:#f9f9f9">
                    <div class="col-md-12">
                        <div class="col-md-12" align="center">
                        <br>
                            <img src="https://intranet.masterquimica.com/resources/img/solicitud_credito.png" width="300">    
                            <h3 style="color:black"> Usted ha modificado la solicitud'. ($sac->id_sol) .'en estado  '. ($sac->nom_est) .' </h3><hr width="540">
                        </div>
                        
                    </div>
                    <div class="col-md-12" align="center">
                    <div class="col-md-12">
                        <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                            <thead style="color:white;background:#58585C">
                                <tr style="height:40px;">
                                    <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                                            <th width="150">Cliente</th>
                                            <th width="250">Fecha de Creación</th>
                                            <th width="250">Asesor Comercial</th>
                                            <th width="250">Estado </th>
                                            <th width="250">Observación </th></th>
                                </tr>
                            </thead>
                            <tbody>
            
                                <td>';
                                while($rE2=$queryEma2->fetch(PDO::FETCH_ASSOC)){
                                $mail->Body.= ' <tr align="center">
                                                    <td width="80">'.$rE2["id_sol"].'</td>
                                                    <td>'.$rE2["nom_cli"].'</td>
                                                    <td>'.$rE2["fec_sol"].'</td>
                                                    <td>'.$rE2["nom_usu"].'</td>
                                                    <td>'.$rE2["nom_est"].'</td>
                                                    <td>'.$rE2["obser_perm"].'</td> 
                                                
                                            </tr>';
                                        } 
                $mail->Body .='</td>
                                    
                            </tbody>
                        </table>
                    </div>
                    <br>
                        <div  style="color:black">
                            
                        </div>
                    <br>
                </div>
            </body>
            </html>
                        ';
                    break;  
                case '12':
            //modifica tesoreria ; muestra edicion cont remite a sac  
                $mail->Body = '
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
                </head>
                
                <body style="color:black;background:#f9f9f9">
                    <div class="col-md-12">
                        <div class="col-md-12" align="center">
                        <br>
                            <img src="https://intranet.masterquimica.com/resources/img/solicitud_credito.png" width="300">    
                            <h3 style="color:black"> La solicitud  '. ($sac->id_sol) .'  se ha modificado en estado '. ($sac->nom_est) .' </h3><hr width="540">
                        </div>
                        
                    </div>
                    <div class="col-md-12" align="center">
                    <div class="col-md-12">
                        <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                            <thead style="color:white;background:#58585C">
                                <tr style="height:40px;">
                                    <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                                            <th width="150">Cliente</th>
                                            <th width="250">Fecha de Creación</th>
                                            <th width="250">Asesor Comercial</th>
                                            <th width="250">Estado </th>
                                            <th width="250">Observación </th></th>
                                </tr>
                            </thead>
                            <tbody>
            
                                <td>';
                                        while($rE2=$queryEma2->fetch(PDO::FETCH_ASSOC)){
                                            $mail->Body.= '<tr align="center">
                                                <td width="80">'.$rE2["id_sol"].'</td>
                                                <td>'.$rE2["nom_cli"].'</td>
                                                <td>'.$rE2["fec_sol"].'</td>
                                                <td>'.$rE2["nom_usu"].'</td>
                                                <td>'.$rE2["nom_est"].'</td>
                                                <td>'.$rE2["obser_perm"].'</td>
                                            </tr>';
                                        } 
                $mail->Body .='</td>
                                    
                            </tbody>
                        </table>
                    </div>
                    <br>
                        <div  style="color:black">
                            
                        </div>
                    <br>
                </div>
            </body>
            </html>
                    ';
                break;   
                

          case '13':
        //modifica sac ; muestra la solicitud editada muestra a sac  
            $mail->Body = '
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
                </head>
                
                <body style="color:black;background:#f9f9f9">
                    <div class="col-md-12">
                        <div class="col-md-12" align="center">
                        <br>
                            <img src="https://intranet.masterquimica.com/resources/img/solicitud_credito.png" width="300">    
                            <h3 style="color:black"> Usted ha modificado la solicitud '. ($sac->id_sol) .' en estado  '. ($sac->nom_est).' </h3><hr width="540">
                        </div>
                        
                    </div>
                    <div class="col-md-12" align="center">
                    <div class="col-md-12">
                        <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                            <thead style="color:white;background:#58585C">
                                <tr style="height:40px;">
                                    <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                                            <th width="150">Cliente</th>
                                            <th width="250">Fecha de Creación</th>
                                            <th width="250">Asesor Comercial</th>
                                            <th width="250">Estado </th>
                                            <th width="250">Observación </th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <<td>';
                                while($rE2=$queryEma2->fetch(PDO::FETCH_ASSOC)){
                                    $mail->Body.= '<tr align="center">
                                        <td width="80">'.$rE2["id_sol"].'</td>
                                        <td>'.$rE2["nom_cli"].'</td>
                                        <td>'.$rE2["fec_sol"].'</td>
                                        <td>'.$rE2["nom_usu"].'</td>
                                        <td>'.$rE2["nom_est"].'</td>
                                        <td>'.$rE2["obser_perm"].'</td>
                                        
                                        
                                    </tr>';
                                } 
        $mail->Body .='</td>
                                    
                            </tbody>
                        </table>
                    </div>
                    <br>
                        <div  style="color:black">
                            
                        </div>
                    <br>
                </div>
            </body>
            </html>
            ';
            case '14':
            //modifica sac ; muestra la solicitud editada muestra a contabilidad  
                $mail->Body = '
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <meta charset="utf-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
                    </head>
                    
                    <body style="color:black;background:#f9f9f9">
                        <div class="col-md-12">
                            <div class="col-md-12" align="center">
                            <br>
                                <img src="https://intranet.masterquimica.com/resources/img/solicitud_credito.png" width="300">    
                                <h3 style="color:black"> La solicitud  '. ($sac->id_sol) .'  se ha modificado en estado '. ($sac->nom_est).' </h3><hr width="540">
                            </div>
                            
                        </div>
                        <div class="col-md-12" align="center">
                        <div class="col-md-12">
                            <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                                <thead style="color:white;background:#58585C">
                                    <tr style="height:40px;">
                                        <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                                                <th width="150">Cliente</th>
                                                <th width="250">Fecha de Creación</th>
                                                <th width="250">Asesor Comercial</th>
                                                <th width="250">Estado </th>
                                                <th width="250">Observación </th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <td>';
                                while($rE2=$queryEma2->fetch(PDO::FETCH_ASSOC)){
                                    $mail->Body.= '<tr align="center">
                                        <td width="80">'.$rE2["id_sol"].'</td>
                                        <td>'.$rE2["nom_cli"].'</td>
                                        <td>'.$rE2["fec_sol"].'</td>
                                        <td>'.$rE2["nom_usu"].'</td>
                                        <td>'.$rE2["nom_est"].'</td>
                                        <td>'.$rE2["obser_perm"].'</td>
                                        
                                    </tr>';
                                } 
        $mail->Body .='</td>
                                        
                                </tbody>
                            </table>
                        </div>
                        <br>
                            <div  style="color:black">
                                
                            </div>
                        <br>
                    </div>
                </body>
                </html>
                ';
                case '15':
                //modifica cont ; solicitud editada muestra a tesoreria
                    $mail->Body = '
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <meta charset="utf-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
                        </head>
                        
                        <body style="color:black;background:#f9f9f9">
                            <div class="col-md-12">
                                <div class="col-md-12" align="center">
                                <br>
                                    <img src="https://intranet.masterquimica.com/resources/img/solicitud_credito.png" width="300">    
                                    <h3 style="color:black"> Usted ha modificado la solicitud '. ($sac->id_sol). '  en estado  '. ($sac->nom_est).' </h3><hr width="540">
                                </div>
                                
                            </div>
                            <div class="col-md-12" align="center">
                            <div class="col-md-12">
                                <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                                    <thead style="color:white;background:#58585C">
                                        <tr style="height:40px;">
                                            <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                                                    <th width="150">Cliente</th>
                                                    <th width="250">Fecha de Creación</th>
                                                    <th width="250">Asesor Comercial</th>
                                                    <th width="250">Estado </th>
                                                    <th width="250">Observación </th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <td>
                                    <tr align="center">
                                        <td width="80">'.$sac->id_sol.'</td>
                                        <td>'.$sac->nom_cli.'</td>
                                        <td>'.$sac->fec_sol.'</td>
                                        <td>'.$sac->nom_usu.'</td>
                                        <td>'.$sac->obser_perm.'</td>
                                    </tr>
                        </td>
                                            
                                    </tbody>
                                </table>
                            </div>
                            <br>
                                <div  style="color:black">
                                    
                                </div>
                            <br>
                        </div>
                    </body>
                    </html>
                    ';
                    case '16':
                    //modifica con ; solicitud editada muestra a tesoreria   
                        $mail->Body = '
                            <!DOCTYPE html>
                            <html>
                            <head>
                                <meta charset="utf-8">
                                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap.min.css">
                            </head>
                            
                            <body style="color:black;background:#f9f9f9">
                                <div class="col-md-12">
                                    <div class="col-md-12" align="center">
                                    <br>
                                        <img src="https://intranet.masterquimica.com/resources/img/solicitud_credito.png" width="300">    
                                        <h3 style="color:black"> La solicitud  '. ($sac->id_sol) .'  se ha modificado en estado  '. ($sac->nom_est).' </h3><hr width="540">
                                    </div>
                                    
                                </div>
                                <div class="col-md-12" align="center">
                                <div class="col-md-12">
                                    <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                                        <thead style="color:white;background:#58585C">
                                            <tr style="height:40px;">
                                                <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                                                        <th width="150">Cliente</th>
                                                        <th width="250">Fecha de Creación</th>
                                                        <th width="250">Asesor Comercial</th>
                                                        <th width="250">Estado </th>
                                                        <th width="250">Observación </th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <td>
                                    <tr align="center">
                                        <td width="80">'.$sac->id_sol.'</td>
                                        <td>'.$sac->nom_cli.'</td>
                                        <td>'.$sac->fec_sol.'</td>
                                        <td>'.$sac->nom_usu.'</td>
                                        <td>'.$sac->nom_est.'</td>
                                        <td>'.$sac->obser_perm.'</td>
                                    </tr>
                        </td>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                    <div  style="color:black">
                                        
                                    </div>
                                <br>
                            </div>
                        </body>
                        </html>
                        ';

    }