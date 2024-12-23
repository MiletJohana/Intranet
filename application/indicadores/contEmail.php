<?php
include "../../conexion.php";
include '../../resources/template/credentials.php';
switch ($i) {
case '1':
//USUARIO QUE CREA EL DESCUENTO (TALENTO HUMANO Y PUNTO DE VENTA )
$mail->Body = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body style="color:black;background:#FFFFFF">
    <div class="col-md-12">
        <div class="col-md-12" align="center"><br>
            <img src="https://masterquimica.com/subdominios/intranet/resources/img/Descuentos.png" width="400">    
            <h3 style="color:black;margin-top: -10px;"> Usted ha modificado el descuento de '.($usuS->nom_usu).'</h3><hr width="700">
        </div>
    </div>
    <div class="col-md-12" align="center">
        <div class="col-md-12">
            <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                <thead style="color:white;background:#58585C">
                    <tr style="height:40px;">
                        <th tyle="border-radius: 0px 0px 0px 0px; " width="250">Tipo De descuento</th>
                        <th width="250">Solicitante</th>
                        <th width="250">Estado</th>
                    </tr>
                </thead>
                <tbody>
                <td>
                    <tr align="center">
                        <td width="80">'.$usuS->tip_desc.'</td>
                        <td>'.$usuS->nom_usu.'</td>
                        <td>'.$usuS->nom_est.'</td>
                    </tr>
                </td>
                </tbody>
            </table>
        </div><br>
        <div  style="color:black">
        <h3 style="color:black;margin-top: 1px;">Por favor ingrese a nuestro aplicativo para administrar Descuentos de Nomina</h3>
            <a href="https://intranet.masterquimica.com/">
            <img src="https://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
            </a>
        </div><br>
    </div>
</body>
</html>
        ';
break;

case '2':
//NOTIFICACION A LA PERSONA QUE SOLICITO EL DESCUENTO 
$mail->Body = '
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body style="color:black;background:#FFFFFF">
    <div class="col-md-12">
        <div class="col-md-12" align="center"><br>
            <img src="https://masterquimica.com/subdominios/intranet/resources/img/Descuentos.png" width="400">    
            <h3 style="color:black;margin-top: -10px;">  Usted ha solicitado un descuento con un valor '.($usuS->val_desc).' </h3><hr width="700">
        </div>
    </div>
    <div class="col-md-12" align="center">
        <div class="col-md-12">
            <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                <thead style="color:white;background:#58585C">
                    <tr style="height:40px;">
                        <th tyle="border-radius: 0px 0px 0px 0px; " width="250">Tipo De descuento</th>
                        <th width="250">Cantidad De Cuotas</th>
                        <th width="250">Total </th>
                        <th width="250">Estado</th>
                        <th width="250">Tipo de descuento</th>
                        <th width="250">Descripción </th>
                        <th width="250">Creador</th>
                    </tr>
                </thead>
                <tbody>
                <td>
                    <tr align="center">
                    <td >'.$usuS->tip_desc.'</td>
                    <td>'.($usuS->cuo_des).'</td>
                    <td>'.($usuS->val_desc).'</td>
                    <td>'.$usuS->nom_est.'</td>
                    <td>'.$usuS->tip_desc.'</td>
                    <td>'.$usuS->otro_tip_desc.'</td>
                    <td>'.$usu->nom_usu.'</td>
                    </tr>
                </td>
                </tbody>
            </table>
        </div>
            <div>
            <h4  style="color:black;"><i>Recuerde que autoriza a <b>MASTER QUIMICA S.A.S</b> para que de conformidad con el <b> Articulo 18 de la ley 1429 de 2010 </b>,
            <br> deduzca de su salario  la suma <ins> '.($usuS->val_desc).'.</ins> Dejo constancia igualmentede que mi EMPLEADOR ha observado en el presente <br> descuento 
             lo previsto en la norma citada y que presente descuento no se encuentra incluido dentro de los DESCUENTOS <br> PROHIBIDOS de que trata la ley en mención.
             En caso de mi retiro, AUTORIZO que el saldo adecuado sea descontando <br> de mi Liquidación Final de prestaciones Sociales, salarios, vacaciones, auxilios legales y extralegales </i></h4>
            <h4 style="color:black;margin-top: 1px;">Por favor ingrese a nuestro aplicativo para administrar sus Descuentos De Nomina </h4>                        
            
            <a href="https://intranet.masterquimica.com/">
            <img src="https://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
                </a>
            </div><br>
    </div>
</body>
</html>
';
break;

case '3':
//USUARIO DE TALENTO HUMANO O ADMINISTRADOR EDITA EL DESCUENTO
$mail->Body = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body style="color:black;background:#f9f9f9">
    <div class="col-md-12">
        <div class="col-md-12" align="center">
        <br>
            <img src="https://masterquimica.com/subdominios/intranet/resources/img/Descuentos.png" width="400">    
            <h3 style="color:black;margin-top: -10px;"> Usted ha modificado el Descuento de '. ($usuS->nom_usu).' </h3><hr width="700">
        </div>
    </div>
    <div class="col-md-12" align="center">
        <div class="col-md-12">
            <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                <thead style="color:white;background:#58585C">
                    <tr style="height:40px;">
                        <th tyle="border-radius: 0px 0px 0px 0px; " width="250">Tipo De descuento</th>
                        <th width="250">Solicitante</th>
                        <th width="250">Estado</th>
                    </tr>
                </thead>
                <tbody>
                <td>
                    <tr align="center">
                        <td width="80">'.$usuS->tip_desc.'</td>
                        <td>'.$usuS->nom_usu.'</td>
                        <td>'.$usuS->nom_est.'</td>
                    </tr>
                </td>
                </tbody>
            </table>
        </div>
        <br>
            <div  style="color:black">
            <h3 style="color:black;margin-top: 1px;">Por favor ingrese a nuestro aplicativo para administrar sus Permisos</h3>
                <a href="https://intranet.masterquimica.com/">
                <img src="https://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
                </a>
            </div>
        <br>
    </div>
</body>
</html>
        ';
break;
                
case '4':
// USUARIO A QUIEN LE MODIFCARON EL DESCUENTO  
$mail->Body = '
<!DOCTYPE html>
<<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body style="color:black;background:#f9f9f9">
        <div class="col-md-12">
            <div class="col-md-12" align="center"><br>
                <img src="https://masterquimica.com/subdominios/intranet/resources/img/Descuentos.png" width="400">    
                <h3 style="color:black;margin-top: 10px;"> El Colaborador '.($usu->nom_usu).' Edito su descuento de nomina </h3><hr width="700">
            </div>
        </div>
        <div class="col-md-12" align="center">
            <div class="col-md-12">
                <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                    <thead style="color:white;background:#58585C">
                        <tr style="height:40px;">
                            <th tyle="border-radius: 0px 0px 0px 0px; " width="250">Tipo De descuento</th>
                            <th width="250">Cantidad De Cuotas </th>
                            <th width="250">Total </th>
                            <th width="250">Estado</th>
                            <th width="250">Creador</th>
                        </tr>
                    </thead>
                    <tbody>
                    <td>
                        <tr align="center">
                            <td width="80">'.$usuS->tip_desc.'</td>
                            <td>'.$usuS->cuo_des.'</td>
                            <td>'.$usuS->val_desc.'</td>
                            <td>'.$usuS->nom_est.'</td>
                            <td>'.$usu->nom_usu.'</td>
                        </tr>
                    </td>
                    </tbody>
                </table>
            </div>
            <div ><br>
            <h4 style="color:black;margin-top: 1px;">Por favor ingrese a nuestro aplicativo para administrar sus Descuentos De Nomina</h4>                        <a href="https://intranet.masterquimica.com/">
            <img src="https://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
                </a>
            </div>

        <br>
    </div>
</body>
</html>
    ';
break;

case '5':
//NOTIFICACION  DE APROBADO O RECHAZADO 
$mail->Body = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body style="color:black;background:#f9f9f9">
    <div class="col-md-12">
        <div class="col-md-12" align="center">
        <br>
            <img src="https://masterquimica.com/subdominios/intranet/resources/img/Descuentos.png" width="400">    
            <h3 style="color:black;margin-top: 10px;"> Usted ha modificado el permiso de '. ($usuS->nom_usu).' en estado '.($usuS->nom_est).'</h3><hr width="700">
        </div>
        
    </div>
    <div class="col-md-12" align="center">
    <div class="col-md-12">
        <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
            <thead style="color:white;background:#58585C">
                <tr style="height:40px;">
                    <th tyle="border-radius: 0px 0px 0px 0px; " width="250">Tipo De descuento</th>
                    <th width="250">Cantidad De Cuotas </th>
                    <th width="250">Total </th>
                    <th width="250">Estado</th>
                    <th width="250">Creador</th>
                </tr>
            </thead>
            <tbody>
            <td>
                <tr align="center">
                    <td width="80">'.$usuS->tip_desc.'</td>
                    <td>'.$usuS->cuo_des.'</td>
                    <td>'.$usuS->val_desc.'</td>
                    <td>'.$usuS->nom_est.'</td>
                    <td>'.$usu->nom_usu.'</td>
                </tr>
            </td>
            </tbody>
        </table>
    </div>
    <div ><br>
    <h4 style="color:black;margin-top: 1px;">Por favor ingrese a nuestro aplicativo para administrar sus Descuentos De Nomina</h4>                        <a href="https://intranet.masterquimica.com/">
    <img src="https://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
        </a>
    </div><br>
</div>
</body>
</html>
';
break;
case '6':
//NOTIFICACION A LA PERSONA QUE PIDIO EL PERMISO DE APROBADO O RECHAZADO  
$mail->Body = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body style="color:black;background:#f9f9f9">
        <div class="col-md-12">
            <div class="col-md-12" align="center"><br>
                <img src="https://masterquimica.com/subdominios/intranet/resources/img/Descuentos.png" width="400">    
                <h3 style="color:black;margin-top: 10px;"> El Colaborador '.($usu->nom_usu).' Edito su descuento de nomina a estado '.($usuS->nom_est).' </h3><hr width="700">
            </div>
        </div>
        <div class="col-md-12" align="center">
            <div class="col-md-12">
                <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                    <thead style="color:white;background:#58585C">
                        <tr style="height:40px;">
                            <th tyle="border-radius: 0px 0px 0px 0px; " width="250">Tipo De descuento</th>
                            <th width="250">Cantidad De Cuotas </th>
                            <th width="250">Total </th>
                            <th width="250">Estado</th>
                            <th width="250">Creador</th>
                        </tr>
                    </thead>
                    <tbody>
                    <td>
                    <tr align="center">
                        <td width="80">'.$usuS->tip_desc.'</td>
                        <td>'.$usuS->cuo_des.'</td>
                        <td>'.$usuS->val_desc.'</td>
                        <td>'.$usuS->nom_est.'</td>
                        <td>'.$usu->nom_usu.'</td>
                    </tr>
                    </td>
                    </tbody>
                </table>
            </div>
            <div ><br>
            <h4 style="color:black;margin-top: 1px;">Por favor ingrese a nuestro aplicativo para administrar sus Descuentos De Nomina</h4>                        <a href="https://intranet.masterquimica.com/">
            <img src="https://masterquimica.com/subdominios/intranet/resources/img/LOGO.png" style="width: 50px;">
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