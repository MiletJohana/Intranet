<?php
include '../../conexion.php';
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
<body style="color:black;background:#f9f9f9">
        <div class="col-md-12">
            <div class="col-md-12" align="center"><br>
                <img src="https://intranet.masterquimica.com/resources/img/Logo_Master.png" width="200">    
                <h4 style="color:black;margin-top: 10px;"> Estimado <i>'.($usu->nom_per).' </i> tenemos el gusto de informarle de que usted <br> ha sido elegido para iniciar un proceso 
                 de selección al cargo '.($usu->nom_carg).' </h4><hr width="700">
            </div>
        </div>
        <div class="col-md-12" align="center">
            <div class="col-md-12">
                <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                    <thead style="color:white;background:#58585C">
                        <tr style="height:40px;">
                            <th tyle="border-radius: 0px 0px 0px 0px; " width="250">Día</th>
                            <th width="250">Hora</th>
                            <th width="250">Preguntar Por:</th>
                            <th width="250">Direccion</th>
                        </tr>
                    </thead>
                    <tbody>
                    <td>
                        <tr align="center">
                            <td width="80">'.$usu->fec_ent.'</td>
                            <td>'.$usu->hor_ent.'</td>
                            <td> Angela Casas </td>
                            <td> Cra. 58 #74A-27 </td>
                        </tr>
                    </td>
                    </tbody>
                </table>
            </div>
            <div ><br>
            <h4 style="color:black;margin-top: 1px;"> Le Recordamos que los datos de la entrevista son los siguientes:
          <br> *Recuerde Traer la copia de su cedula ampliada al 150 % y excelente presentación personal. <br>
               * En dado caso de alguna inquietud o sugerencia, por favor comuníquese 231677 EXT: 160 -161 </h4>                                      
                </a>
            </div>
        <br>
    </div>
</body>
</html>';
break;
case '2':

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
                <img src="https://intranet.masterquimica.com/resources/img/Logo_Master.png" width="200">    
                <h4 style="color:black;margin-top: 10px;"> Usted Tiene una entrevista programada con <i>'.($usu->nom_per).'</i> para el cargo de '.($usu->nom_carg).' </h4><hr width="700">
            </div>
        </div>
        <div class="col-md-12" align="center">
            <div class="col-md-12">
                <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                    <thead style="color:white;background:#58585C">
                        <tr style="height:40px;">
                            <th tyle="border-radius: 0px 0px 0px 0px; " width="250">Día</th>
                            <th width="250">Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                    <td>
                        <tr align="center">
                            <td width="80">'.$usu->fec_ent.'</td>
                            <td>'.$usu->hor_ent.'</td>
                        </tr>
                    </td>
                    </tbody>
                </table>
            </div>
            <div ><br>
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
        
}