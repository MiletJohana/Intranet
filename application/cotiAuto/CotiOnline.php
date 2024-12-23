<?php
include "../../conexion.php";
function fechaCastellano($fecha)
{
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $numeroDia . " de " . $nombreMes . " de " . $anio;
}
$sql3 = "SELECT * ,DATE(fec_coti) as creacion, cot_cotizaciones.id_usu as id_usuario
            FROM cot_cotizaciones,mq_clientes,contactos,cot_ciudad,cot_ema_est
            where cot_cotizaciones.id_cli= mq_clientes.id_cli 
            AND contactos.id_cont = cot_cotizaciones.id_cont
            AND cot_cotizaciones.id_ciu=cot_ciudad.id_ciu
            AND cot_cotizaciones.id_ema=cot_ema_est.id_ema
            AND id_coti=" . $_GET['id_coti'];
$sql3.=" GROUP BY id_coti";
$query3 = $conexion->query($sql3);
$datoscot = $query3->fetch(PDO::FETCH_ASSOC);
$sql4 = "SELECT * from cot_pro_x_cot, cot_productos  where cot_pro_x_cot.cod_pro=cot_productos.cod_pro AND id_coti=" . $_GET['id_coti'];
$query4 = $conexion->query($sql4);
$hor_cot = fechaCastellano($datoscot['creacion']);
//echo $sql3;
$sql5 = "SELECT * FROM contactos WHERE id_cli=(SELECT id_cli from cot_cotizaciones where id_coti=" . $_GET['id_coti'];
$sql5 .= " ) AND id_cont=" . $_GET['xont'];
$query5 = $conexion->query($sql5);
$contactocot = $query5->fetch(PDO::FETCH_ASSOC);
$cedAse = $datoscot['ced_ase'];
$sql11 = "SELECT * from mq_usu where id_usu=". $datoscot['id_usuario'];
$query11 = $conexion->query($sql11);
//echo $sql11;
$cotizanteCoti = $query11->fetch(PDO::FETCH_ASSOC);
if ($datoscot["ced_ase"] != null) {
    $sql6 = "SELECT * from mq_usu, cot_tip_cotizador where id_usu=" . $_GET['asc'];
    $sql6 .= " AND mq_usu.id_car=cot_tip_cotizador.id_car";
    $query6 = $conexion->query($sql6);
    //echo $sql6;
    $cotizador = $query6->fetch(PDO::FETCH_ASSOC);
}
$totaliva = ($datoscot['cost_cot'] * 0.19) + ($datoscot['cost_cot']);
$totaliva = str_replace(".", ",", $totaliva);
$totaliva = intval($totaliva);
$sqlMov = "SELECT mov.id_coti , mov.nom_estado, mov.nom_usu FROM cot_x_mov mov, cot_cotizaciones cot 
    WHERE mov.id_coti=cot.id_coti
     and mov.id_coti=" . $_GET['id_coti'];
$queryMov = $conexion->query($sqlMov);

$sqlNom="SELECT cot.id_coti, cot.doc_coti, cot.id_cli , cot.id_usu , cot.id_ema , cot.ced_ase , cot.ced_sac , ema.nom_ema,
cot.id_cont, cont.nom_cont, cont.tel_cont, cont.eml_cont , cli.nom_cli, us.nom_usu, us.eml_usu, us.id_car
FROM cot_cotizaciones cot , cot_ema_est ema, contactos cont , mq_clientes cli , mq_usu us
WHERE cot.id_cli=cli.id_cli
AND cot.id_cont =cont.id_cont
AND cot.id_usu=us.id_usu
AND cot.id_ema=ema.id_ema";
$sqlNom.=" AND cot.id_coti=".$_GET['id_coti'];
$sqlNom.=" GROUP by cot.id_coti";
$queryNom=$conexion->query($sqlNom);
$usu=$queryNom->fetch(PDO::FETCH_ASSOC);

?>
<div clas="row" width="100%" border="0" cellspacing="0" cellpadding="0" >
    <div class="col-11" style="margin: 28px 28px 0px 50px;background: #DEDDDD; border-radius: 10px" align="center">
            <br>
            <p> Si está de acuerdo con esta propuesta seleccione el botón Aprobar.
                Si presenta alguna inquietud seleccione el botón Comentar y pronto se comunicara un asesor con usted.
            </p>
            <table align="center">
                <tr>
                    <td>
                        <button id="btnAprob" type="button" class="btn btn-danger" onclick="estadosCot('<?php echo $_GET['id_coti']; ?>',1)" <?php if ($datoscot["id_ema"] == 2 || $datoscot["id_ema"] == 3) {echo 'style="visibility:hidden;"';}?> > Aprobar</button>
                    </td>
                    <td width="5%"> </td>
                    <td>
                        <button id="btnRecha" type="button" class="btn btn-danger" onclick="estadosCot('<?php echo $_GET['id_coti']; ?>',2);" <?php if ($datoscot["id_ema"] == 2 || $datoscot["id_ema"] == 3) {echo 'style="visibility:hidden;"';}?>>Rechazar</button>
                    </td>
                    
                </tr>
            </table>
            <br>
    </div>
</div>
<div class="invoice-box">
    <div class="invoice-container-left">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td width="13px">
                        <div class="UserDetails">
                            <div class="UserLogo">
                                <img src="https://intranet.masterquimica.com/resources/librerias/img/mastercasa.png" style="height: 118px;margin: 0px 0px 0px 23px;">
                            </div>
                        </div>
                    </td>
                 <!--<td width="280px">
                        <div class="CustomerDetails">
                            <div class="UserLogo">
                                <img src="https://intranet.masterquimica.com/resources/librerias/img/iso.jpg" style="height: 154px;margin: 0px 63px 0px 0px;">
                            </div>
                        </div>
                    </td>-->
                </tr>
            </tbody>
        </table>
        <table class="Container" style="margin: 4px 0px 8px 62px;">
            <tr>
                <td width="100%" style="text-align: left; line-height:1.5;background-color:transparent; ">
                    <div id="project">
                        <?php echo $datoscot["nom_ciu"] . ''; ?>, <?php echo '' . $hor_cot; ?><br><br>
                        <?php echo $cotizanteCoti["nom_cns"] . '-' . str_pad($datoscot["cns_coti"], 4, "0", STR_PAD_LEFT); ?><br><br>
                        Señor(a): <?php echo $contactocot["nom_cont"] . $contactocot["ape1_cont"]; ?><br>
                        Cargo: <?php echo $contactocot["car_cont"]; ?>
                        <p style="font-weight:Bold;">
                            <?php echo $datoscot["nom_cli"]; ?></p>
                        Tel:<?php echo $contactocot["tel_cont"]; ?><br>
                        mail: <?php echo $contactocot["eml_cont"]; ?> <br><br>
                    </div>
                </td>
                <td id="selloaprob" style="visibility:hidden;">
                    <div>
                        <img src="https://intranet.masterquimica.com/resources/img/selloAprob.png" style="height: 260px;margin: 0px 0px 0px 0px;">
                    </div>
                </td>
                <?php if ($datoscot["id_ema"] == 2) { ?>
                    <td>
                        <div>
                            <img src="https://intranet.masterquimica.com/resources/img/selloAprob.png" style="height: 260px;margin: 0px 0px 0px 0px;">
                        </div>
                    </td>
                <?php } ?>

                <td id="selloRech" style="visibility:hidden;">
                    <div>
                        <img src="https://intranet.masterquimica.com/resources/img/selloRecha.png" style="height: 260px;margin: 0x 100px 0px 0px;">
                    </div>
                </td>
                <?php if ($datoscot["id_ema"] == 3) { ?>
                    <td>
                        <div>
                            <img src="https://intranet.masterquimica.com/resources/img/selloRecha.png" style="height: 260px;margin: 0px 100px 0px 0px;">
                        </div>
                    </td>
                <?php } ?>
            </tr>
        </table>
        <div>
            <a class='flotante' onclick="crearComentario('<?php if(isset($_GET['ux'])){echo $_GET['ux'];}else{echo $_GET['xont'];}?>','<?php echo $_GET['id_coti']; ?>', '<?php if(isset($_GET['ux'])){echo 1;}else{echo 2;}?>','<?php if(isset($_GET['ux'])){echo $usu['nom_usu'];}else{echo $usu['nom_cont'];}?>', '<?php echo $_GET['xont'];?>',' <?php echo $_GET['asc'];?>');" data-bs-toggle="modal" data-bs-target="#mediumModal">
                <img src='https://intranet.masterquimica.com/resources/img/botonMQ.png' style="height: 85px">
            </a>
        </div>
        <table class="Container" style="margin: 0px 0px 17px 34px;" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>
                    <div>
                        Apreciado señor(a):<br><br>
                        De acuerdo con su solicitud nos permitimos cotizar los siquientes productos:
                    </div>
                </td>
            </tr>
        </table>
        <div class="Container" style="margin-left: 10px">
            <table class="TableDocumentDetail">
            <?php if (isset($datoscot) && ($datoscot['id_tip_cot']==4 || $datoscot['id_tip_cot']==7 || $datoscot['id_tip_cot']==8 || $datoscot['id_tip_cot']==10)){?>
                <thead>
                    <tr>
                        <th style=" background-color: #58585c;   color: white;">
                            Ref.
                        </th>
                        <th style=" background-color: #58585c;   color: white;">
                            Descripción
                        </th>
                        <th style=" background-color: #58585c;   color: white;">
                            Valor Unitario
                        </th>
                        <th style=" background-color: #58585c;   color: white;">
                            Valor de empaque
                        </th>
                        <th style=" background-color: #58585c;   color: white;">
                            Cantidad
                        </th>
                        <th style=" background-color: #58585c;   color: white;">
                            Total
                        </th>
                    </tr>
                </thead>
            <?php } else if (isset($datoscot) && ($datoscot['id_tip_cot']==2)) {?>
                <thead>
                    <tr>
                        <th style=" background-color: #A00A00;   color: white;">
                            Ref.
                        </th>
                        <th style=" background-color: #A00A00;   color: white;">
                            Descripción
                        </th>
                        <th style=" background-color: #A00A00;   color: white;">
                            Valor Unitario
                        </th>
                        <th style=" background-color: #A00A00;   color: white;">
                            Valor de empaque
                        </th>
                        <th style=" background-color: #A00A00;   color: white;">
                            Cantidad
                        </th>
                        <th style=" background-color: #A00A00;   color: white;">
                            Total
                        </th>
                    </tr>
                </thead>
            <?php } ?>
                
                <tbody>
                    <?php while ($r = $query4->fetch(PDO::FETCH_ASSOC)) {
                        $sqlP = "SELECT can_emp FROM cot_productos WHERE cod_pro=" . $r['cod_pro'];
                        $queryP = $conexion->query($sqlP);
                        $rP = $queryP->fetch(PDO::FETCH_ASSOC);
                        $valorTotal = $r["pre_cot"] * $r["can_com"] * $rP['can_emp'];
                        $valorTotalIva = (($r["pre_cot"] * $r["can_com"]) * $rP['can_emp'] * 0.19) + ($r["pre_cot"] * $r["can_com"] * $rP['can_emp']); ?>
                        <tr>
                            <td style="text-align: center;width:15%; background-color:transparent;">
                                <div>
                                    <img style="max-width:100px;" src="../../documentos/cotizador/images/<?php echo $r["img_pro"]; ?>">
                                </div>
                                <p><?php echo $r["cod_ref"]; ?></p>
                            </td>
                            <td style="width:35%;background-color:transparent; text-align:justify;">
                                <strong style="margin: 0px 18px 0px 14px;"><?php echo $r["nom_pro_cot"]; ?></strong>
                                <br>
                                <p style="margin: 0px 18px 0px 14px;"><?php echo $r["des_pro_cot"]; ?></p>
                                <br>
                                <?php if ($r['obs_prod'] != '') { ?>
                                    <br><br>
                                    <p style="margin: 0px 18px 0px 14px;">** <?php echo $r["obs_prod"]; ?></p>
                                <?php } ?>
                                <p style="margin: 0px 18px 0px 14px;"><strong>UNIDAD DE EMPAQUE:</strong> <?php echo $r["und_emp"] . ' ' . $r["can_emp"]; ?></p>
                                <?php if ($r["sin_dev"] == 1) { ?>
                                    <p style="color:red;margin: 0px 18px 0px 14px;">No se aceptan devoluciones</p>
                                <?php } ?>
                                <?php $valorUn = ($r["pre_cot"] * $rP['can_emp']);
                                $valorUni = round($valorUn);
                                $punt = '.';
                                $pos = strpos($r['pre_cot'], $punt);
                                if ($pos === false) {
                                    $pos = 0;
                                }
                                $precio = str_replace('.', ',', $r['pre_cot']);
                                if (strlen($valorUni) > 6) { ?>
                            </td>
                            <td style="word-wrap:normal; white-space:nowrap;width:15%;text-align:center;background-color:transparent">
                                $ <?php echo substr($precio, 0 - $pos, -6 - $pos) . "'" . substr($precio, -6 - $pos, -3 - $pos) . "." . substr($precio, -3 - $pos); ?>
                            </td>
                        <?php } else { ?>
                            </td>
                            <td style="word-wrap:normal; white-space:nowrap;width:15%;text-align:center;background-color:transparent">
                                $ <?php echo substr($precio, 0 - $pos, -3 - $pos) . "." . substr($precio, -3 - $pos); ?>
                            </td>
                        <?php } ?>
                        <?php if (strlen($r['pre_cot']) > 6) { ?>
                            <td style="word-wrap:normal; white-space:nowrap;width:15%;text-align:center;background-color:transparent">
                                $ <?php echo substr($valorUni, 0, -6) . "'" . substr($valorUni, -6, -3) . "." . substr($valorUni, -3); ?>
                            </td>
                        <?php } else { ?>
                            <td style="word-wrap:normal; white-space:nowrap;width:15%;text-align:center;background-color:transparent">
                                $ <?php echo substr($valorUni, -0, -3) . "." . substr($valorUni, -3); ?>
                            </td>
                        <?php } ?>
                        <td style="word-wrap:normal; white-space:nowrap;width:8%;text-align:center;background-color:transparent">
                            <?php echo $r["can_com"]; ?>
                        </td>
                        <?php if (strlen($valorTotal) > 6) { ?>
                            <td style="word-wrap:normal; white-space:nowrap;width:15%;text-align:center;background-color:transparent">
                                $ <?php echo substr($valorTotal, 0, -6) . "'" . substr($valorTotal, -6, -3) . '.' . substr($valorTotal, -3); ?>
                            </td>
                        </tr>
                    <?php } else { ?>
                        <td style="word-wrap:normal; white-space:nowrap;width:15%;text-align:center;background-color:transparent">
                            $ <?php echo substr($valorTotal, 0, -3) . "." . substr($valorTotal, -3); ?>
                        </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                <tr>
                <tr>
                    <td colspan="2" style="background-color:transparent;visibility:hidden"></td>
                    <?php if ($datoscot['cot_iva'] == 1) { ?>
                        <td colspan="2" style="background-color:transparent;" align="center">Total sin IVA</td>
                    <?php } else { ?>
                        <td colspan="2" style="background-color:transparent;" align="center">Total </td>
                    <?php } ?>
                    <?php if (strlen($datoscot['cost_cot']) > 6) { ?>
                        <td colspan="2" align="center" style="background-color:transparent;">
                            $ <?php echo substr($datoscot['cost_cot'], 0, -6) . "'" . substr($datoscot['cost_cot'], -6, -3) . '.' . substr($datoscot['cost_cot'], -3); ?>
                        </td>
                </tr>
            <? } else { ?>
                <td colspan="2" align="center" style="background-color:transparent;">
                    $ <?php echo substr($datoscot['cost_cot'], 0, -3) . "." . substr($datoscot['cost_cot'], -3) ?>
                </td>
                </tr>
            <?php } ?>
            <?php if ($datoscot['cot_iva'] == 1) { ?>
                <tr>
                <tr>
                    <td colspan="2" style="background-color:transparent; visibility:hidden"></td>
                    <td colspan="2" style="background-color:transparent;" align="center">Total con IVA</td>
                    <?php if (strlen($totaliva) > 6) { ?>
                        <td colspan="2" align="center" style="background-color:transparent;">
                            $ <?php echo substr($totaliva, 0, -6) . "'" . substr($totaliva, -6, -3) . '.' . substr($totaliva, -3); ?>
                        </td>
                </tr>
            <?php } else { ?>
                <td colspan="2" align="center" style="background-color:transparent;">
                    $ <?php echo substr($totaliva, 0, -3) . "." . substr($totaliva, -3); ?>
                </td>
                </tr>
            <?php } ?>
            </tr>
        <?php } ?>
        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php if (isset($cotizanteCoti) && ($cotizanteCoti['id_car'] == 5 || $cotizanteCoti['id_car'] == 6 || $cotizanteCoti['id_car'] == 16)) { ?>
    <p style="color:black;margin: 33px 0px 25px 33px;">CONDICIONES COMERCIALES :</p>
    <table style="align-content:left;line-height:1.5;font-size:16px;font-style:Arial;margin: 0px 0px 0px 65px;" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td style="background-color:transparent;">
                Tiempo de entrega:<br>
                Forma de pago:<br>
                Validez de la Oferta:<br>
                I.V.A:
            </td>
            <td width="5%"></td>
            <td width="75%" style="background-color:transparent;">
                <?php echo ($datoscot["dia_ent"]); ?><br>
                <?php echo $datoscot["for_pag"]; ?><br>
                ** <?php echo $datoscot["val_cot"]; ?><br>
                19% No Incluido
            </td>
        </tr>
    </table>
    <?php if (isset($datoscot) && ($datoscot['id_tip_cot']==4 || $datoscot['id_tip_cot']==7 || $datoscot['id_tip_cot']==8 || $datoscot['id_tip_cot']==10)){?>
    <table style="font-size:16px;font-style:Arial;background-color:transparent;margin: 50px 0px 15px 73px;" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="3%" style="background-color:transparent;"></td>
            <td style="line-height:1.5;background-color:transparent;" align="justify">
                Notas:<br><br>
                <ul>
                    <li>*Si el pedido es inferior a $400.000 se cobra el valor de transporte: $11000 +IVA</li>
                    <li>*Si el pedido es despachado fuera de Bogotá será pactado con el cliente la forma de pago del flete.</li>
                    <li>**Siempre y cuando no haya incrementos del proveedor o variaciones mayores al 15% en el precio del dólar, petróleo o materia prima de los productos.</li>
                    <li>*Producto sujeto a retraso en entrega por factores externos con los fabricantes.</li>
                </ul>
                <br>
                <ul>
                    <i>Productos de importación 40 a 65 días para entrega</i>
                </ul>
            </td>
        </tr>
    </table>
    <?php }else if (isset($datoscot) && ($datoscot['id_tip_cot']==2)) { ?>
        <table style="font-size:16px;font-style:Arial;background-color:transparent;margin: 50px 0px 15px 73px;" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr><td width="3%"style="background-color:transparent;" >
                </td>
                <td tyle="line-height:1.5;background-color:transparent;" align="justify">
                    Notas:<br><br>
                    <ul>
                        <li> Este precio incluye máximo hasta tres tintas en el logotipo, la elaboración del arte y el clisé.Si la frecuencia de  compra es  menor  a 4 meses se realizará un cobro  único de $160.000 en factura posterior</li>
                        <li> Existe un margen de tolerancia del 10%  en rollos de más o menos en la impresión.</li>
                        <li>En impresión por adhesivo: el área de impresión no debe ser mayor al 30% del ancho de la cinta, también se debe tener presente que la leyenda va impresa a lo largo de la cinta y debe tener una medida de 15 cm mínimo y 37 máximo.</li>
                        <li>El tiempo de entrega para la cinta impresa es de 8 días hábiles a partir de aprobado el arte.</li>
                        <li>La cantidad mínima a elaborar son 144 rollos.</li>
                    </ul>
                </td>
            </tr>
        </table>
    <?php }?>
    <table style="font-size:16px;font-style:Arial;background-color:transparent;margin: 0px 31px 25px 59px;" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td style="text-align:left;background-color:transparent;">
                <p style="letter-spacing:0.1px;">
                    Solicitamos enviar sus órdenes de compra al correo electrónico <a href="<?php echo $cotizanteCoti["eml_usu"]; ?>"><?php echo $cotizanteCoti["eml_usu"]; ?></a> nos permite ser más ágiles en la grabación del pedido y ejercer <br> controles inherentes al proceso.
                </p>
            </td>
        </tr>
    </table>
    <table style="font-size:16px;font-style:Arial;background-color:transparent;margin: 0px 31px 25px 59px;" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td style="text-align:left;background-color:transparent;">
                <p>
                    Cualquier inquietud o requerimiento adicional con gusto le atenderemos. <br><br>
                    Atentamente,
                </p>
            </td>
        </tr>
    </table>
<?php } else { ?>
    <p style="color:black;font-size:16px;font-style:Arial;margin: 33px 0px 25px 33px;">CONDICIONES COMERCIALES :</p>
    <table style="align-content: left;line-height:1.5;font-size:16px;font-style:Arial;margin: 0px 0px 0px 65px;" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td style="background-color:transparent;">
                Tiempo de entrega:<br>
                Forma de pago:<br>
                Validez de la Oferta:<br>
                I.V.A:
            </td>
            <td width="5%"></td>
            <td width="75%" style="background-color:transparent;">
                <?php echo ($datoscot["dia_ent"]); ?><br>
                <?php echo $datoscot["for_pag"]; ?><br>
                ** <?php echo $datoscot["val_cot"]; ?><br>
                19% No Incluido
            </td>
        </tr>
    </table>
    <?php if (isset($datoscot) && ($datoscot['id_tip_cot']==4 || $datoscot['id_tip_cot']==7 || $datoscot['id_tip_cot']==8 || $datoscot['id_tip_cot']==10)){?>
    <table style="font-size:16px;font-style:Arial;background-color:transparent;margin: 50px 0px 15px 73px;" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="3%" style="background-color:transparent;"></td>
            <td tyle="line-height:1.5;background-color:transparent;" align="justify">
                Notas:<br><br>
                <ul>
                    <li>*Si el pedido es inferior a $400.000 se cobra el valor de transporte: $11000 +IVA</li>
                    <li>*Si el pedido es despachado fuera de Bogotá será pactado con el cliente la forma de pago del flete.</li>
                    <li>**Siempre y cuando no haya incrementos del proveedor o variaciones mayores al 15% en el precio del dólar, petróleo o materia prima de los productos.</li>
                    <li>*Producto sujeto a retraso en entrega por factores externos con los fabricantes.</li>
                </ul>
                <br>
                <ul>
                    <i>Productos de importación 40 a 65 días para entrega</i>
                </ul>
            </td>
        </tr>
    </table>
    <?php } elseif (isset($datoscot) && ($datoscot['id_tip_cot']==2)){?>
        <table style="font-size:16px;font-style:Arial;background-color:transparent;margin: 50px 0px 15px 73px;" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr><td width="3%"style="background-color:transparent;" >
                </td>
                <td tyle="line-height:1.5;background-color:transparent;" align="justify">
                    Notas:<br><br>
                    <ul>
                        <li> Este precio incluye máximo hasta tres tintas en el logotipo, la elaboración del arte y el clisé.Si la frecuencia de  compra es  menor  a 4 meses se realizará un cobro  único de $ 160.000  en factura posterior</li>
                        <li> Existe un margen de tolerancia del 10%  en rollos de más o menos en la impresión.</li>
                        <li>En impresión por adhesivo: el área de impresión no debe ser mayor al 30% del ancho de la cinta, también se debe tener presente que la leyenda va impresa a lo largo de la cinta y debe tener una medida de 15 cm mínimo y 37 máximo.</li>
                        <li>El tiempo de entrega para la cinta impresa es de 8 días hábiles a partir de aprobado el arte.</li>
                        <li>La cantidad mínima a elaborar son 144 rollos.</li>
                    </ul>
                </td>
            </tr>
        </table>
    <?php }?>
    <?php if (isset($datoscot) && ($datoscot['id_tip_cot']==2 || $datoscot['id_tip_cot']==4 || $datoscot['id_tip_cot']==10)){?>
    <table style="font-size:16px;font-style:Arial;background-color:transparent;margin: 0px 31px 25px 59px;" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td style="text-align:left;background-color:transparent;">
                <p style="letter-spacing:0.1px;">
                    Solicitamos enviar sus órdenes de compra al correo electrónico <a href="pedidos@masterquimica.com">pedidos@masterquimica.com</a> nos permite ser más ágiles en la grabación del pedido y ejercer controles inherentes al proceso.
                </p>
            </td>
        </tr>
    </table>
    <?php }else if($datoscot['id_tip_cot']==7){?>
        <table style="font-size:16px;font-style:Arial;background-color:transparent;margin: 0px 31px 25px 59px;" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td style="text-align:left;background-color:transparent;">
                    <p style="letter-spacing:0.1px;">
                        Solicitamos enviar sus órdenes de compra al correo electrónico <a href="pedidos.medellin@masterquimica.com">pedidos.medellin@masterquimica.com</a> nos permite ser más ágiles en la grabación del pedido y ejercer controles inherentes al proceso.
                    </p>
                </td>
            </tr>
        </table>
    <?php }else if($datoscot['id_tip_cot']==8){ ?>
        <table style="font-size:16px;font-style:Arial;background-color:transparent;margin: 0px 31px 25px 59px;" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td style="text-align:left;background-color:transparent;">
                    <p style="letter-spacing:0.1px;">
                        Solicitamos enviar sus órdenes de compra al correo electrónico <a href="pedidos.cali@masterquimica.com">pedidos.cali@masterquimica.com</a> nos permite ser más ágiles en la grabación del pedido y ejercer controles inherentes al proceso.
                    </p>
                </td>
            </tr>
        </table>
    <?php } ?>
    
    <table style="font-size:16px;font-style:Arial;background-color:transparent;margin: 0px 31px 25px 59px;" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td style="text-align:left;background-color:transparent;">
                <p>
                    Cualquier inquietud o requerimiento adicional con gusto le atenderemos. <br><br>
                    Atentamente,
                </p>
            </td>
        </tr>
    </table>
<?php } ?>
<?php if (isset($cotizador)) {
    if (($cotizador["id_car"] == 1 || $cotizador["id_car"] == 7 || $cotizador["id_car"] == 4 || $cotizador["id_car"] == 8 || $cotizador["id_car"] == 5 || $cotizador["id_car"] == 6 || $cotizador["id_car"] == 9 || $cotizador["id_car"] == 10
        || $cotizador["id_car"] == 11 || $cotizador["id_car"] == 12 || $cotizador["id_car"] == 13 || $cotizador["id_car"] == 16 || $cotizador["id_car"] == 17 || $cotizador["id_car"] == 18 || $cotizador["id_car"] == 19 ||  $cotizador["id_car"] == 20 || $datoscot['id_usu'] == 1110465381)) { ?>
        <table style="font-size:16px;font-style:Arial;background-color:transparent;margin: 0px 31px 25px 59px;">
            <tr>
                <td width="40%" style="background-color:transparent;">
                    <p>
                        <span style="font-weight:bold;"><?php echo strtoupper($cotizador["nom_usu"]); ?></span><br>
                        <?php if ($cotizador["id_usu"] == '52183939') { ?>
                            PBX: <?php echo $cotizador["cel2_usu"]; ?> ext. <?php echo $cotizador["ext_usu"]; ?><br>
                            Cel: <?php echo $cotizador["cel_usu"]; ?> <br>
                            <a href="<?php echo $cotizador["eml_usu"]; ?>">
                                <?php echo $cotizador["eml_usu"]; ?>
                            </a>
                    </p>
                </td>
                <td width="30%" style="background-color:transparent;">
                <?php } else { ?>
                    <?php echo strtoupper($cotizador["nom_car"]); ?> <br>
                    PBX: <?php echo $cotizador["cel2_usu"]; ?> ext.<?php echo $cotizador["ext_usu"]; ?> <br>
                    Cel: <?php echo $cotizador["cel_usu"]; ?><br>
                    <a href="<?php echo $cotizador["eml_usu"]; ?>">
                        <?php echo $cotizador["eml_usu"]; ?>
                    </a>
                    </p>
                </td>
                <td width="30%" style="background-color:transparent;">
                <?php } ?>
                <?php if ($datoscot["ced_sac"] != "") {
                    $cedSac = $datoscot["ced_sac"];
                    $sql7 = "SELECT * from mq_usu, cot_tip_cotizador where id_usu=$cedSac and mq_usu.id_car=cot_tip_cotizador.id_car";
                    $query7 = $conexion->query($sql7);
                    if ($query7->rowCount() > 0) {
                        $sac = $query7->fetch(PDO::FETCH_ASSOC); ?>
                </td>
                <td width="40%" style="background-color:transparent;">
                    <p>
                        <span style="font-weight:bold;"><?php echo strtoupper($sac["nom_usu"]); ?></span><br>
                        <?php echo strtoupper($sac["nom_car"]); ?><br>
                        PBX: 231 6377 ext. <?php echo $sac["ext_usu"]; ?><br>
                        <a href=" <?php echo $sac["eml_usu"]; ?>">
                            <?php echo $sac["eml_usu"]; ?>
                        </a>
                    </p>
                </td>
        <?php }
                } ?>
            </tr>
        </table>
    <?php } ?>
    <?php } elseif ($datoscot["ced_sac"] != "") {
    $cedSac = $datoscot["ced_sac"];
    $sql7 = "SELECT * from mq_usu, cot_tip_cotizador where id_usu=$cedSac and mq_usu.id_car=cot_tip_cotizador.id_car";
    $query7 = $conexion->query($sql7);
    if ($query7->rowCount() > 0) {
        $sac = $query7->fetch(PDO::FETCH_ASSOC); ?>
        <table style="font-size:16px;font-style:Arial;background-color:transparent;margin: 0px 31px 25px 59px;">
            <tr>

                <td width="40%" style="background-color:transparent;">
                    <p>
                        <span style="font-weight:bold;"><?php echo strtoupper($sac["nom_usu"]); ?></span><br>
                        <?php echo strtoupper($sac["nom_car"]); ?> <br>
                        PBX: 231 6377 ext. <?php echo $sac["ext_usu"]; ?><br>
                        <a href=" <?php echo $sac["eml_usu"]; ?>">
                            <?php echo $sac["eml_usu"]; ?>
                        </a>
                    </p>
                </td>
            </tr>
        </table>
<?php }
} ?>
<div class="invoice-box">
    <div class="invoice-container-left">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td width="13px">
                        <div class="UserDetails">
                            <div class="UserLogo">
                                <img src="https://intranet.masterquimica.com/resources/librerias/img/imagen2.jpg" style="width: 1101px;margin: 0px 0px 0px 93px;height: 222px">
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<hr>
<table id="ctl15_ucControlPane0_ctl00_ActionBanner_tblErpBanner" align="center" class="TableERPBannerCenter" width="100%">
    <div id="ctl15_ucControlPane0_ctl00_ActionBanner_divParent" class="BackGroundInvoiceBanner container" style="visibility:visible">
        <div id="ctl15_ucControlPane0_ctl00_ActionBanner_divContainerAction" accountcode="0" iserpaccountbalance="False" isclientview="True" erpdocumentid="2881196" workflowinstanceid="0" style="display: block;">
            <div id="ctl00_divParent" class="container" style="visibility:visible">
                <div id="ctl00_divContainer">
                    <tbody>
                        <?php while ($rM = $queryMov->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td align="center">
                                    <div id="ctl00_ctl00_divAction" class="banner_text_action">
                                        <li id="ctl00_ctl00_liAction" style="font-size:11px;color:#080e96;"><span id="ctl00_ctl00_spnMessage" style="color: #424242; font-size: 11px; width: 84%;" class="spnMessage">
                                            El usuario <?php echo $rM["nom_usu"]; ?> a <?php echo ($rM["nom_estado"]); ?> la cotización <?php echo ($rM['id_coti']); ?>.
                                        </span></li>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </div>
            </div>
        </div>
    </div>
</table>