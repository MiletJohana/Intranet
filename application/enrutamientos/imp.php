<?php 
include "../../conexion.php";
$sql5="SELECT * from mq_enrt where num_enr=".$_GET["num_enr"];
$query5=$conexion->query($sql5);
if ($query5->rowCount()>0) {
$sql1="SELECT
en.num_ord,
en.num_dlg,
dl.dir_dlg,
dl.obs_dlg,
dl.dil_des,
dl.est_dlg,
cl.id_cli,
dl.tel_dlg,
dl.hor_dlg,
cl.nom_cli,
dl.con_dlg
FROM mq_clientes cl, mq_diligencias dl,mq_dilig_x_enrt en
WHERE cl.id_cli = dl.id_cli 
AND dl.num_dlg=en.num_dlg 
AND en.num_enr=".$_GET["num_enr"]."
order by num_ord";
$query=$conexion->query($sql1);
$sql2="SELECT * from mq_enrt,mq_usu where mq_enrt.usu_upt = usuario AND num_enr=".$_GET["num_enr"] ;
$query2=$conexion->query($sql2);
$enrt=$query2->fetch(PDO::FETCH_ASSOC);
$sql4="SELECT est_enr from mq_enrt where num_enr=".$_GET["num_enr"];
$query4=$conexion->query($sql4);
$usu=$query4->fetch(PDO::FETCH_ASSOC);
if($usu["est_enr"]=='NUEVA')
{
$sql3="UPDATE mq_enrt set est_enr='NUEVA' where num_enr=".$_GET["num_enr"];
$query3=$conexion->query($sql3);
}

date_default_timezone_set("America/Bogota");
$hor_act=date("Y-m-d h:i:sa");
$html='<head>
    <meta charset="ISO-8859-1">
    <link rel="stylesheet" href="../../resources/librerias/css/style.css" media="all" />
    </head>
    <body>
		<header class="clearfix">
      <div align="left" id="logo">
        <img src="../../resources/img/Logo Master Química.png" width="130">
      </div>
    <table >
      <tr>
        <th width="25%" style="text-align: left;"> 
          <div id="project" style="font-size:100%;">
                    <div><span>RESPONSABLE: </span>'.$enrt["nom_usu"].'</div>
                    <div><span>ENRUTAMIENTO: </span>'.$enrt["num_enr"].'</div>                   
                    <div><span>FECHA:</span> '.$hor_act.'</div>
                </div> 
          </th>
          <th width="50%" align="center">
          </th>
          <th width="25%" style="text-align: right;"> 
               <div id="company" class="clearfix" style="font-size:100%">
              <div>Master Quimica S.A.S</div>
              <div>Cra 58 # 74a-27<br /></div>
              <div>2316377</div>
              <div><a href="masterquimica@masterquimica.com">masterquimica@masterquimica.com</a></div>
              <div><a href="http://www.masterquimica.com/">www.masterquimica.com</a></div>
            </div>
          </th>
      </tr>
    </table>
    </header>
    <main>
      <table border="1" style="font-size:100%;">
        <thead>
          <tr>
            <th class="qty" style="font-size:100%;width:10px;border-style:none;"></th>
            <th style="width:100px;">Cliente</th>
            <th style="width:100px;">Direccion</th>
            <th style="width:100px;">Contacto</th>
            <th style="width:90px;">Telefono</th>
            <th style="width:100px;">Horario</th>
            <th style="width:200px;">Descripcion</th>
            <th style="width:200px;">Observacion</th>
          </tr>
        </thead>
        <tbody>';
while($r=$query->fetch(PDO::FETCH_ASSOC))
{
$html.='<tr>
            <td class="desc" style="border-style:none; font-size:80%;background-color:white">'.$r["num_ord"].'</td>
            <td class="desc" style="font-size:90%">'.$r["nom_cli"].'</td>
            <td class="desc" style="font-size:90%">'.$r["dir_dlg"].'</td>
            <td class="desc" style="font-size:90%">'.$r["con_dlg"].'</td>
            <td class="desc" style="font-size:90%">'.$r["tel_dlg"].'</td>
            <td class="desc" style="font-size:90%">'.$r["hor_dlg"].'</td>
            <td class="desc" style="font-size:90%">'.$r["dil_des"].'</td>
            <td class="desc" style="font-size:90%">'.$r["obs_dlg"].'</td>
        </tr>';
}
$html.='</tbody>
      </table>
    </main>
    </body>';
require_once "../../resources/utils/phppdf/vendor/autoload.php";

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',
                        'format'=>'A4-L',
                        'setAutoTopMargin' => '',
                        'setAutoBottomMargin' => ''
                      ]);

$mpdf->allow_charset_conversion=true;
$mpdf->charset_in='UTF-8';
$mpdf->WriteHTML($html);
$mpdf->SetHTMLFooter('
<table width="100%" style="font-size:80%;">
    <tr>
        <td width="25%" style="text-align: left;font-size:90%;background-color:white ">Enrutamiento '.$_GET["num_enr"].'<br><br><br>Página {PAGENO}/{nbpg}</td>
        <td width="25%" style="text-align: right;background-color:white" >Entregado por:________________________<br><br><br>.</td>
        <td width="25%" style="text-align: right;background-color:white" >Recibido por:________________________<br><br><br>.</td>
        <td width="25%" style="text-align: right;background-color:white" >CC:________________________<br><br><br>Placa:________________________</td>
    </tr>

</table>');
$mpdf->Output("enrutamiento.pdf",'I');
}else{

echo"<script>alert('No existe la ruta ".$_GET['num_enr']."'); 
            window.location.href='../index.php';
            </script>";
}
?>
