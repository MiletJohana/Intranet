<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';

$sql_info_sol = "SELECT sol.*, est.nom_est_sol, est.color_est FROM inv_solicitud sol INNER JOIN inv_est_sol est ON sol.est_sol = est.id_est_sol WHERE sol.id_sol = ".$id_sol.";";
$query_info_sol = $conexion -> query($sql_info_sol);
$rowInfoSol = $query_info_sol->fetch(PDO::FETCH_OBJ);

$sql_info_solicitante = "SELECT nom_usu FROM mq_usu WHERE id_usu = ".$rowInfoSol->id_usu.";";
$query_info_solicitante = $conexion -> query($sql_info_solicitante);
$rowInfoSolicitante = $query_info_solicitante->fetch(PDO::FETCH_OBJ);

$sql_info_sol_prod = "SELECT sol_x_prod.*, prod.nom_prod, prod.img_prod FROM inv_sol_x_prod sol_x_prod INNER JOIN inv_product prod ON sol_x_prod.id_prod = prod.id_prod WHERE sol_x_prod.id_sol = ".$id_sol.";";
$query_info_sol_prod = $conexion -> query($sql_info_sol_prod);
$rowInfoSolProd = $query_info_sol_prod->fetchAll(PDO::FETCH_OBJ);

include "cuerpo_email.php";

switch ($i) {
    case '1':
    //Cuerpo del correo que recibe el solicitante cuando se crea la solicitud 
        $content_body = '
                            <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none"
                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                <tr style="border-collapse:collapse">
                                    <td align="center"
                                        style="padding:0;Margin:0;background-color:#fee8db;background-image:url(https://eizjlnq.stripocdn.email/content/guids/videoImgGuid/images/bg1111_a23.png);background-repeat:no-repeat;background-position:center top"
                                        bgcolor="#fee8db"
                                        background="https://eizjlnq.stripocdn.email/content/guids/videoImgGuid/images/bg1111_a23.png">
                                        <table class="es-content-body" align="center" cellpadding="0" cellspacing="0"
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"
                                            role="none">
                                            <tr style="border-collapse:collapse">
                                                <td class="es-m-p30t es-m-p30b" align="left"
                                                    style="Margin:0;padding-bottom:5px;padding-top:20px;padding-left:20px;padding-right:20px"> <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr>
        <td style="width:257px" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" align="left" class="es-left"
                                                        role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="left" class="es-m-p20b"
                                                                style="padding:0;Margin:0;width:257px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="53"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="center"
                                                                            style="padding:0;Margin:0;font-size:0px"><img
                                                                                src="https://intranet.masterquimica.com/resources/img/img_email_inv.png"
                                                                                alt
                                                                                style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
                                                                                width="257"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!--[if mso]></td><td style="width:10px"></td><td style="width:293px" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" class="es-right" align="right"
                                                        role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" valign="top"
                                                                style="padding:0;Margin:0;width:293px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="96"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="right" class="es-m-txt-c es-m-p10t"
                                                                            style="padding:0;Margin:0">
                                                                            <h1
                                                                                style="Margin:0;line-height:54px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:40px;font-style:normal;font-weight:normal;color:#ff0000">
                                                                                Inventarios MQ</h1>
                                                                            <h1
                                                                                style="Margin:0;line-height:33.6px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:28px;font-style:normal;font-weight:normal;color:#ff0000">
                                                                                <b>Solicitud #'.$id_sol.'</b></h1>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="right" class="es-m-txt-c"
                                                                            style="padding:0;Margin:0;padding-top:15px;padding-bottom:15px">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:22.5px;color:#000207;font-size:15px">
                                                                                Creada Correctamente</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="67"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table> <!--[if mso]></td></tr></table><![endif]-->
                                                </td>
                                            </tr>
                                            <tr style="border-collapse:collapse">
                                                <td align="left" bgcolor="#fb3210"
                                                    style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-color:#fb3210;background-image:url(https://eizjlnq.stripocdn.email/content/guids/CABINET_2001cb1a6423a25da7be033e7fc53db9c9e248b00d454f818340be0709e511b9/images/bgw2.png);background-repeat:no-repeat;background-position:center top"
                                                    background="https://eizjlnq.stripocdn.email/content/guids/CABINET_2001cb1a6423a25da7be033e7fc53db9c9e248b00d454f818340be0709e511b9/images/bgw2.png">
                                                    <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:187px" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" align="left" class="es-left"
                                                        role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tr style="border-collapse:collapse">
                                                            <td class="es-m-p20b" align="center" valign="top"
                                                                style="padding:0;Margin:0;width:187px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    bgcolor="transparent"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent"
                                                                    role="presentation">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="right" class="es-m-txt-l"
                                                                            style="padding:0;Margin:0;padding-top:10px;padding-bottom:15px">
                                                                            <h2
                                                                                style="Margin:0;line-height:33.6px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#ffffff">
                                                                                '.$rowInfoSolicitante->nom_usu.',</h2>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="140"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table> <!--[if mso]></td><td style="width:20px"></td>
        <td style="width:353px" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" class="es-right" align="right"
                                                        role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="left" style="padding:0;Margin:0;width:353px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="46"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="left" style="padding:0;Margin:0">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                Nos complace informarle que la solicitud que realizó en nuestro sistema de Inventarios ha sido procesada con éxito.</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="left" bgcolor="transparent"
                                                                            style="padding:0;Margin:0;padding-top:10px;padding-bottom:30px">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                Detalles de la solicitud:
                                                                            </p>
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                - Solicitud #'.$id_sol.'
                                                                            </p>
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                - Fecha de solicitud: '.$rowInfoSol->fec_sol.'
                                                                            </p>
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                - Estado: <span class="rounded-pill badge bg-info">'.$rowInfoSol->nom_est_sol.'</span>
                                                                            </p>
                                                                        </td>
                                                                    </tr>

                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table> <!--[if mso]></td></tr></table><![endif]-->
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none"
                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                <tr style="border-collapse:collapse">
                                    <td align="center" bgcolor="#fafafa" style="padding:0;Margin:0;background-color:#fafafa">
                                        <table bgcolor="#fafafa" class="es-content-body" align="center" cellpadding="0"
                                            cellspacing="0"
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#fafafa;width:600px"
                                            role="none">
                                            <tr style="border-collapse:collapse">
                                                <td align="left" bgcolor="#fafafa"
                                                    style="Margin:0;padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:30px;background-color:#fafafa">
                                                    <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" valign="top"
                                                                style="padding:0;Margin:0;width:560px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="left" class="es-m-txt-l"
                                                                            style="padding:0;Margin:0">
                                                                            <h2
                                                                                style="Margin:0;line-height:28.8px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#170058">
                                                                                Productos Seleccionados:&nbsp;</h2>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>';

                                            foreach ($rowInfoSolProd as $product) {
                                                $content_body .= '
                                                    <tr style="border-collapse:collapse; border-bottom: lightsteelblue 1px solid;">
                                                        <td align="left" bgcolor="#fafafa" style="padding:20px;Margin:0;background-color:#fafafa"><!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:270px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-left" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tbody><tr style="border-collapse:collapse">
                                                            <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:270px">
                                                            <table class="es-table-not-adapt" width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tbody><tr style="border-collapse:collapse">
                                                                <td class="es-m-txt-c" valign="top" align="left" style="padding:0;Margin:0;padding-right:15px;width:30px;font-size:0px"><img src="https://intranet.masterquimica.com/documentos/inventarios/productos/'.$product->img_prod.'" alt="" width="60" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></td>
                                                                <td align="left" style="padding:0;Margin:0">
                                                                <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tbody><tr style="border-collapse:collapse">
                                                                    <td align="left" style="padding:0;Margin:0">
                                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#170058;font-size:14px"><span style="background-color:#164aff">&nbsp;<span style="color:#FFFFFF">Producto&nbsp;</span></span></p>
                                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;font-size:14px">'.$product->nom_prod.'</p>
                                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;font-size:14px">Cantidad Solicitada:&nbsp;<span style="color:#FFFFFF"><span style="background-color:#164aff">&nbsp;'.$product->cant_sol.'&nbsp;</span></span></p>
                                                                    </td>
                                                                </tr>
                                                                </tbody></table></td>
                                                            </tr>
                                                            </tbody></table></td>
                                                        </tr>
                                                        </tbody></table><!--[if mso]></td><td style="width:20px"></td><td style="width:270px" valign="top"><![endif]-->
                                                        </td>
                                                    </tr>';
                                            };

                                            $content_body .= '
                                            <tr style="border-collapse:collapse">
                                                <td align="left" bgcolor="#fafafa"
                                                    style="Margin:0;padding-bottom:50px;padding-left:20px;padding-right:20px;padding-top:30px;background-color:#fafafa">
                                                    <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" valign="top"
                                                                style="padding:0;Margin:0;width:560px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="left"
                                                                            style="padding:0;Margin:0;padding-top:15px">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#170058;font-size:14px">
                                                                                Si tiene alguna consulta adicional o necesita más información, no dudes en ponerse en contacto con nosotros.
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>';
                
        $mail->Body = $body_head_email.$content_body.$body_footer_email;
        break;

        case '2':
            //Cuerpo del correo que recibe el administrador del inventario cuando se crea la solicitud 
                $content_body = '
                                    <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none"
                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                        <tr style="border-collapse:collapse">
                                            <td align="center"
                                                style="padding:0;Margin:0;background-color:#fee8db;background-image:url(https://eizjlnq.stripocdn.email/content/guids/videoImgGuid/images/bg1111_a23.png);background-repeat:no-repeat;background-position:center top"
                                                bgcolor="#fee8db"
                                                background="https://eizjlnq.stripocdn.email/content/guids/videoImgGuid/images/bg1111_a23.png">
                                                <table class="es-content-body" align="center" cellpadding="0" cellspacing="0"
                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"
                                                    role="none">
                                                    <tr style="border-collapse:collapse">
                                                        <td class="es-m-p30t es-m-p30b" align="left"
                                                            style="Margin:0;padding-bottom:5px;padding-top:20px;padding-left:20px;padding-right:20px"> <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr>
                <td style="width:257px" valign="top"><![endif]-->
                                                            <table cellpadding="0" cellspacing="0" align="left" class="es-left"
                                                                role="none"
                                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="left" class="es-m-p20b"
                                                                        style="padding:0;Margin:0;width:257px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                                            role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tr class="es-mobile-hidden"
                                                                                style="border-collapse:collapse">
                                                                                <td align="center" height="53"
                                                                                    style="padding:0;Margin:0"></td>
                                                                            </tr>
                                                                            <tr style="border-collapse:collapse">
                                                                                <td align="center"
                                                                                    style="padding:0;Margin:0;font-size:0px"><img
                                                                                        src="https://intranet.masterquimica.com/resources/img/img_email_inv.png"
                                                                                        alt
                                                                                        style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
                                                                                        width="257"></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <!--[if mso]></td><td style="width:10px"></td><td style="width:293px" valign="top"><![endif]-->
                                                            <table cellpadding="0" cellspacing="0" class="es-right" align="right"
                                                                role="none"
                                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="center" valign="top"
                                                                        style="padding:0;Margin:0;width:293px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                                            role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tr class="es-mobile-hidden"
                                                                                style="border-collapse:collapse">
                                                                                <td align="center" height="96"
                                                                                    style="padding:0;Margin:0"></td>
                                                                            </tr>
                                                                            <tr style="border-collapse:collapse">
                                                                                <td align="right" class="es-m-txt-c es-m-p10t"
                                                                                    style="padding:0;Margin:0">
                                                                                    <h1
                                                                                        style="Margin:0;line-height:54px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:40px;font-style:normal;font-weight:normal;color:#ff0000">
                                                                                        Inventarios MQ</h1>
                                                                                    <h1
                                                                                        style="Margin:0;line-height:33.6px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:28px;font-style:normal;font-weight:normal;color:#ff0000">
                                                                                        <b>Solicitud #'.$id_sol.'</b></h1>
                                                                                </td>
                                                                            </tr>
                                                                            <tr style="border-collapse:collapse">
                                                                                <td align="right" class="es-m-txt-c"
                                                                                    style="padding:0;Margin:0;padding-top:15px;padding-bottom:15px">
                                                                                    <p
                                                                                        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:22.5px;color:#000207;font-size:15px">
                                                                                        Creada Correctamente</p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="es-mobile-hidden"
                                                                                style="border-collapse:collapse">
                                                                                <td align="center" height="67"
                                                                                    style="padding:0;Margin:0"></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table> <!--[if mso]></td></tr></table><![endif]-->
                                                        </td>
                                                    </tr>
                                                    <tr style="border-collapse:collapse">
                                                        <td align="left" bgcolor="#fb3210"
                                                            style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-color:#fb3210;background-image:url(https://eizjlnq.stripocdn.email/content/guids/CABINET_2001cb1a6423a25da7be033e7fc53db9c9e248b00d454f818340be0709e511b9/images/bgw2.png);background-repeat:no-repeat;background-position:center top"
                                                            background="https://eizjlnq.stripocdn.email/content/guids/CABINET_2001cb1a6423a25da7be033e7fc53db9c9e248b00d454f818340be0709e511b9/images/bgw2.png">
                                                            <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:187px" valign="top"><![endif]-->
                                                            <table cellpadding="0" cellspacing="0" align="left" class="es-left"
                                                                role="none"
                                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                                <tr style="border-collapse:collapse">
                                                                    <td class="es-m-p20b" align="center" valign="top"
                                                                        style="padding:0;Margin:0;width:187px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                                            bgcolor="transparent"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent"
                                                                            role="presentation">
                                                                            <tr style="border-collapse:collapse">
                                                                                <td align="right" class="es-m-txt-l"
                                                                                    style="padding:0;Margin:0;padding-top:10px;padding-bottom:15px">
                                                                                    <h2
                                                                                        style="Margin:0;line-height:33.6px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#ffffff">
                                                                                        '.$rowInfoEmailAdmin[0]['valor'].',</h2>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="es-mobile-hidden"
                                                                                style="border-collapse:collapse">
                                                                                <td align="center" height="140"
                                                                                    style="padding:0;Margin:0"></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table> <!--[if mso]></td><td style="width:20px"></td>
                <td style="width:353px" valign="top"><![endif]-->
                                                            <table cellpadding="0" cellspacing="0" class="es-right" align="right"
                                                                role="none"
                                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="left" style="padding:0;Margin:0;width:353px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                                            role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tr class="es-mobile-hidden"
                                                                                style="border-collapse:collapse">
                                                                                <td align="center" height="46"
                                                                                    style="padding:0;Margin:0"></td>
                                                                            </tr>
                                                                            <tr style="border-collapse:collapse">
                                                                                <td align="left" style="padding:0;Margin:0">
                                                                                    <p
                                                                                        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                        Nos complace informarle que la solicitud que realizó '.$rowInfoSolicitante->nom_usu.' en nuestro sistema de Inventarios ha sido procesada con éxito.</p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr style="border-collapse:collapse">
                                                                                <td align="left" bgcolor="transparent"
                                                                                    style="padding:0;Margin:0;padding-top:10px;padding-bottom:30px">
                                                                                    <p
                                                                                        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                        Detalles de la solicitud:
                                                                                    </p>
                                                                                    <p
                                                                                        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                        - Solicitud #'.$id_sol.'
                                                                                    </p>
                                                                                    <p
                                                                                        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                        - Fecha de solicitud: '.$rowInfoSol->fec_sol.'
                                                                                    </p>
                                                                                    <p
                                                                                        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                        - Estado: <span class="rounded-pill badge bg-info">'.$rowInfoSol->nom_est_sol.'</span>
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
        
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table> <!--[if mso]></td></tr></table><![endif]-->
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none"
                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                        <tr style="border-collapse:collapse">
                                            <td align="center" bgcolor="#fafafa" style="padding:0;Margin:0;background-color:#fafafa">
                                                <table bgcolor="#fafafa" class="es-content-body" align="center" cellpadding="0"
                                                    cellspacing="0"
                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#fafafa;width:600px"
                                                    role="none">
                                                    <tr style="border-collapse:collapse">
                                                        <td align="left" bgcolor="#fafafa"
                                                            style="Margin:0;padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:30px;background-color:#fafafa">
                                                            <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="center" valign="top"
                                                                        style="padding:0;Margin:0;width:560px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                                            role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tr style="border-collapse:collapse">
                                                                                <td align="left" class="es-m-txt-l"
                                                                                    style="padding:0;Margin:0">
                                                                                    <h2
                                                                                        style="Margin:0;line-height:28.8px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#170058">
                                                                                        Productos Seleccionados:&nbsp;</h2>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>';
        
                                                    foreach ($rowInfoSolProd as $product) {
                                                        $content_body .= '
                                                            <tr style="border-collapse:collapse; border-bottom: lightsteelblue 1px solid;">
                                                                <td align="left" bgcolor="#fafafa" style="padding:20px;Margin:0;background-color:#fafafa"><!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:270px" valign="top"><![endif]-->
                                                                <table cellpadding="0" cellspacing="0" class="es-left" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                                <tbody><tr style="border-collapse:collapse">
                                                                    <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:270px">
                                                                    <table class="es-table-not-adapt" width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tbody><tr style="border-collapse:collapse">
                                                                        <td class="es-m-txt-c" valign="top" align="left" style="padding:0;Margin:0;padding-right:15px;width:30px;font-size:0px"><img src="https://intranet.masterquimica.com/documentos/inventarios/productos/'.$product->img_prod.'" alt="" width="60" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></td>
                                                                        <td align="left" style="padding:0;Margin:0">
                                                                        <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tbody><tr style="border-collapse:collapse">
                                                                            <td align="left" style="padding:0;Margin:0">
                                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#170058;font-size:14px"><span style="background-color:#164aff">&nbsp;<span style="color:#FFFFFF">Producto&nbsp;</span></span></p>
                                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;font-size:14px">'.$product->nom_prod.'</p>
                                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;font-size:14px">Cantidad Solicitada:&nbsp;<span style="color:#FFFFFF"><span style="background-color:#164aff">&nbsp;'.$product->cant_sol.'&nbsp;</span></span></p>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody></table></td>
                                                                    </tr>
                                                                    </tbody></table></td>
                                                                </tr>
                                                                </tbody></table><!--[if mso]></td><td style="width:20px"></td><td style="width:270px" valign="top"><![endif]-->
                                                                </td>
                                                            </tr>';
                                                    };
        
                                                    $content_body .= '
                                                    <tr style="border-collapse:collapse">
                                                        <td align="left" bgcolor="#fafafa"
                                                            style="Margin:0;padding-bottom:50px;padding-left:20px;padding-right:20px;padding-top:30px;background-color:#fafafa">
                                                            <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="center" valign="top"
                                                                        style="padding:0;Margin:0;width:560px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                                            role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tr style="border-collapse:collapse">
                                                                                <td align="left"
                                                                                    style="padding:0;Margin:0;padding-top:15px">
                                                                                    <p
                                                                                        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#170058;font-size:14px">
                                                                                        Si tiene alguna consulta adicional o necesita más información, no dudes en ponerse en contacto con nosotros.
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>';
                        
                $mail->Body = $body_head_email.$content_body.$body_footer_email;
                break;

    case '3':
        /* Filtramos para solo mostrar los productos entregados */
        $prod_entregado = array_filter($rowInfoSolProd, function ($prod) {
            return isset($prod->cant_sol) && isset($prod->entregado) && $prod->cant_sol == $prod->entregado;
        });
        
        if($est_sol == 4){
            $prod_pendientes = array_filter($rowInfoSolProd, function ($prod) {
                return isset($prod->cant_sol) && isset($prod->entregado) && $prod->cant_sol != $prod->entregado;
            });
        } 

        //Cuerpo del correo que recibe el solicitante cuando se entrega (parcial/completa) la solicitud 
        $content_body = '<table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none"
                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                <tr style="border-collapse:collapse">
                                    <td align="center"
                                        style="padding:0;Margin:0;background-color:#fee8db;background-image:url(https://eizjlnq.stripocdn.email/content/guids/videoImgGuid/images/bg1111_a23.png);background-repeat:no-repeat;background-position:center top"
                                        bgcolor="#fee8db"
                                        background="https://eizjlnq.stripocdn.email/content/guids/videoImgGuid/images/bg1111_a23.png">
                                        <table class="es-content-body" align="center" cellpadding="0" cellspacing="0"
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"
                                            role="none">
                                            <tr style="border-collapse:collapse">
                                                <td class="es-m-p30t es-m-p30b" align="left"
                                                    style="Margin:0;padding-bottom:5px;padding-top:20px;padding-left:20px;padding-right:20px"> <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr>
        <td style="width:257px" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" align="left" class="es-left"
                                                        role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="left" class="es-m-p20b"
                                                                style="padding:0;Margin:0;width:257px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="53"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="center"
                                                                            style="padding:0;Margin:0;font-size:0px"><img
                                                                                src="https://intranet.masterquimica.com/resources/img/img_email_inv.png"
                                                                                alt
                                                                                style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
                                                                                width="257"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!--[if mso]></td><td style="width:10px"></td><td style="width:293px" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" class="es-right" align="right"
                                                        role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" valign="top"
                                                                style="padding:0;Margin:0;width:293px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="96"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                  <tr style="border-collapse:collapse">
                                                                        <td align="right" class="es-m-txt-c es-m-p10t"
                                                                            style="padding:0;Margin:0">
                                                                            <h1
                                                                                style="Margin:0;line-height:54px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:40px;font-style:normal;font-weight:normal;color:#ff0000">
                                                                                Inventarios MQ</h1>
                                                                            <h1
                                                                                style="Margin:0;line-height:33.6px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:28px;font-style:normal;font-weight:normal;color:#ff0000">
                                                                                <b>Solicitud #'.$id_sol.'</b></h1>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="right" class="es-m-txt-c"
                                                                            style="padding:0;Margin:0;padding-top:15px;padding-bottom:15px">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:22.5px;color:#000207;font-size:15px">
                                                                                Entregada '.(($est_sol == 3) ? 'Completamente' : "Parcialmente").'</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="67"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table> <!--[if mso]></td></tr></table><![endif]-->
                                                </td>
                                            </tr>
                                            <tr style="border-collapse:collapse">
                                                <td align="left" bgcolor="#fb3210"
                                                    style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-color:#fb3210;background-image:url(https://eizjlnq.stripocdn.email/content/guids/CABINET_2001cb1a6423a25da7be033e7fc53db9c9e248b00d454f818340be0709e511b9/images/bgw2.png);background-repeat:no-repeat;background-position:center top"
                                                    background="https://eizjlnq.stripocdn.email/content/guids/CABINET_2001cb1a6423a25da7be033e7fc53db9c9e248b00d454f818340be0709e511b9/images/bgw2.png">
                                                    <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:187px" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" align="left" class="es-left"
                                                        role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tr style="border-collapse:collapse">
                                                            <td class="es-m-p20b" align="center" valign="top"
                                                                style="padding:0;Margin:0;width:187px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    bgcolor="transparent"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent"
                                                                    role="presentation">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="right" class="es-m-txt-l"
                                                                            style="padding:0;Margin:0;padding-top:10px;padding-bottom:15px">
                                                                            <h2
                                                                                style="Margin:0;line-height:33.6px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#ffffff">
                                                                                '.$rowInfoSolicitante->nom_usu.',</h2>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="140"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table> <!--[if mso]></td><td style="width:20px"></td>
        <td style="width:353px" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" class="es-right" align="right"
                                                        role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="left" style="padding:0;Margin:0;width:353px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="46"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="left" style="padding:0;Margin:0">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                Nos complace informarle que la solicitud que realizó en nuestro sistema de Inventarios ha sido entregada '.(($est_sol == 3) ? 'exitosamente' : "parcialmente").'.</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="left" bgcolor="transparent"
                                                                            style="padding:0;Margin:0;padding-top:10px;padding-bottom:30px">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                Detalles de la solicitud:
                                                                            </p>
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                - Solicitud #'.$id_sol.'
                                                                            </p>
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                - Fecha de solicitud: '.$rowInfoSol->fec_sol.'
                                                                            </p>
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                - Estado: <span class="rounded-pill badge bg-info">'.$rowInfoSol->nom_est_sol.'</span>
                                                                            </p>
                                                                        </td>
                                                                    </tr>

                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table> <!--[if mso]></td></tr></table><![endif]-->
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none"
                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                <tr style="border-collapse:collapse">
                                    <td align="center" bgcolor="#fafafa" style="padding:0;Margin:0;background-color:#fafafa">
                                        <table bgcolor="#fafafa" class="es-content-body" align="center" cellpadding="0"
                                            cellspacing="0"
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#fafafa;width:600px"
                                            role="none">
                                            <tr style="border-collapse:collapse">
                                                <td align="left" bgcolor="#fafafa"
                                                    style="Margin:0;padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:30px;background-color:#fafafa">
                                                    <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" valign="top"
                                                                style="padding:0;Margin:0;width:560px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="left" class="es-m-txt-l"
                                                                            style="padding:0;Margin:0">
                                                                            <h2
                                                                                style="Margin:0;line-height:28.8px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#170058">
                                                                                Productos Entregados:&nbsp;</h2>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>';

                                            foreach ($prod_entregado as $product) {
                                                $content_body .= '
                                                    <tr style="border-collapse:collapse; border-bottom: lightsteelblue 1px solid;">
                                                        <td align="left" bgcolor="#fafafa" style="padding:20px;Margin:0;background-color:#fafafa"><!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:270px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-left" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tbody><tr style="border-collapse:collapse">
                                                            <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:270px">
                                                            <table class="es-table-not-adapt" width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tbody><tr style="border-collapse:collapse">
                                                                <td class="es-m-txt-c" valign="top" align="left" style="padding:0;Margin:0;padding-right:15px;width:30px;font-size:0px"><img src="https://intranet.masterquimica.com/documentos/inventarios/productos/'.$product->img_prod.'" alt="" width="60" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></td>
                                                                <td align="left" style="padding:0;Margin:0">
                                                                <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tbody><tr style="border-collapse:collapse">
                                                                    <td align="left" style="padding:0;Margin:0">
                                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#170058;font-size:14px"><span style="background-color:#164aff">&nbsp;<span style="color:#FFFFFF">Producto&nbsp;</span></span></p>
                                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;font-size:14px">'.$product->nom_prod.'</p>
                                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;font-size:14px">Cantidad:&nbsp;<span style="color:#FFFFFF"><span style="background-color:#164aff">&nbsp;'.$product->entregado.'&nbsp;</span></span></p>
                                                                    </td>
                                                                </tr>
                                                                </tbody></table></td>
                                                            </tr>
                                                            </tbody></table></td>
                                                        </tr>
                                                        </tbody></table><!--[if mso]></td><td style="width:20px"></td><td style="width:270px" valign="top"><![endif]-->
                                                        </td>
                                                    </tr>';
                                            };

                                            if($est_sol == 4){
                                                $content_body .= '
                                                <tr style="border-collapse:collapse">
                                                    <td align="left" bgcolor="#fafafa"
                                                        style="Margin:0;padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:50px;background-color:#fafafa">
                                                        <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr style="border-collapse:collapse">
                                                                <td align="center" valign="top"
                                                                    style="padding:0;Margin:0;width:560px">
                                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                                        role="presentation"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr style="border-collapse:collapse">
                                                                            <td align="left" class="es-m-txt-l"
                                                                                style="padding:0;Margin:0">
                                                                                <h2
                                                                                    style="Margin:0;line-height:28.8px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#170058">
                                                                                    Productos Pendientes:&nbsp;</h2>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>';

                                                foreach ($prod_pendientes as $product) {
                                                    $content_body .= '
                                                        <tr style="border-collapse:collapse; border-bottom: lightsteelblue 1px solid;">
                                                            <td align="left" bgcolor="#fafafa" style="padding:20px;Margin:0;background-color:#fafafa"><!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:270px" valign="top"><![endif]-->
                                                            <table cellpadding="0" cellspacing="0" class="es-left" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tbody><tr style="border-collapse:collapse">
                                                                <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:270px">
                                                                <table class="es-table-not-adapt" width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tbody><tr style="border-collapse:collapse">
                                                                    <td class="es-m-txt-c" valign="top" align="left" style="padding:0;Margin:0;padding-right:15px;width:30px;font-size:0px"><img src="https://intranet.masterquimica.com/documentos/inventarios/productos/'.$product->img_prod.'" alt="" width="60" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></td>
                                                                    <td align="left" style="padding:0;Margin:0">
                                                                    <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tbody><tr style="border-collapse:collapse">
                                                                        <td align="left" style="padding:0;Margin:0">
                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#170058;font-size:14px"><span style="background-color:#164aff">&nbsp;<span style="color:#FFFFFF">Producto&nbsp;</span></span></p>
                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;font-size:14px">'.$product->nom_prod.'</p>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody></table></td>
                                                                </tr>
                                                                </tbody></table></td>
                                                            </tr>
                                                            </tbody></table><!--[if mso]></td><td style="width:20px"></td><td style="width:270px" valign="top"><![endif]-->
                                                            </td>
                                                        </tr>';
                                                };
                                            }

                                            $content_body .= '
                                            <tr style="border-collapse:collapse">
                                                <td align="left" bgcolor="#fafafa"
                                                    style="Margin:0;padding-bottom:50px;padding-left:20px;padding-right:20px;padding-top:30px;background-color:#fafafa">
                                                    <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" valign="top"
                                                                style="padding:0;Margin:0;width:560px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="left"
                                                                            style="padding:0;Margin:0;padding-top:15px">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#170058;font-size:14px">
                                                                                Si tiene alguna consulta adicional o necesita más información, no dudes en ponerse en contacto con nosotros.
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>';
                
        $mail->Body = $body_head_email.$content_body.$body_footer_email;
        break;
      
    case '4':
        /* Filtramos para solo mostrar los productos entregados */
        $prod_entregado = array_filter($rowInfoSolProd, function ($prod) {
            return isset($prod->cant_sol) && isset($prod->entregado) && $prod->cant_sol == $prod->entregado;
        });
        
        if($est_sol == 4){
            $prod_pendientes = array_filter($rowInfoSolProd, function ($prod) {
                return isset($prod->cant_sol) && isset($prod->entregado) && $prod->cant_sol != $prod->entregado;
            });
        } 

        //Cuerpo del correo que recibe el administrador del inventario cuando se entrega (parcial/completa) una solicitud 
        $content_body = '<table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none"
                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                <tr style="border-collapse:collapse">
                                    <td align="center"
                                        style="padding:0;Margin:0;background-color:#fee8db;background-image:url(https://eizjlnq.stripocdn.email/content/guids/videoImgGuid/images/bg1111_a23.png);background-repeat:no-repeat;background-position:center top"
                                        bgcolor="#fee8db"
                                        background="https://eizjlnq.stripocdn.email/content/guids/videoImgGuid/images/bg1111_a23.png">
                                        <table class="es-content-body" align="center" cellpadding="0" cellspacing="0"
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"
                                            role="none">
                                            <tr style="border-collapse:collapse">
                                                <td class="es-m-p30t es-m-p30b" align="left"
                                                    style="Margin:0;padding-bottom:5px;padding-top:20px;padding-left:20px;padding-right:20px"> <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr>
        <td style="width:257px" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" align="left" class="es-left"
                                                        role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="left" class="es-m-p20b"
                                                                style="padding:0;Margin:0;width:257px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="53"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="center"
                                                                            style="padding:0;Margin:0;font-size:0px"><img
                                                                                src="https://intranet.masterquimica.com/resources/img/img_email_inv.png"
                                                                                alt
                                                                                style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
                                                                                width="257"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!--[if mso]></td><td style="width:10px"></td><td style="width:293px" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" class="es-right" align="right"
                                                        role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" valign="top"
                                                                style="padding:0;Margin:0;width:293px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="96"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                  <tr style="border-collapse:collapse">
                                                                        <td align="right" class="es-m-txt-c es-m-p10t"
                                                                            style="padding:0;Margin:0">
                                                                            <h1
                                                                                style="Margin:0;line-height:54px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:40px;font-style:normal;font-weight:normal;color:#ff0000">
                                                                                Inventarios MQ</h1>
                                                                            <h1
                                                                                style="Margin:0;line-height:33.6px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:28px;font-style:normal;font-weight:normal;color:#ff0000">
                                                                                <b>Solicitud #'.$id_sol.'</b></h1>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="right" class="es-m-txt-c"
                                                                            style="padding:0;Margin:0;padding-top:15px;padding-bottom:15px">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:22.5px;color:#000207;font-size:15px">
                                                                                Entregada '.(($est_sol == 3) ? 'Completamente' : "Parcialmente").'</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="67"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table> <!--[if mso]></td></tr></table><![endif]-->
                                                </td>
                                            </tr>
                                            <tr style="border-collapse:collapse">
                                                <td align="left" bgcolor="#fb3210"
                                                    style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-color:#fb3210;background-image:url(https://eizjlnq.stripocdn.email/content/guids/CABINET_2001cb1a6423a25da7be033e7fc53db9c9e248b00d454f818340be0709e511b9/images/bgw2.png);background-repeat:no-repeat;background-position:center top"
                                                    background="https://eizjlnq.stripocdn.email/content/guids/CABINET_2001cb1a6423a25da7be033e7fc53db9c9e248b00d454f818340be0709e511b9/images/bgw2.png">
                                                    <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:187px" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" align="left" class="es-left"
                                                        role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tr style="border-collapse:collapse">
                                                            <td class="es-m-p20b" align="center" valign="top"
                                                                style="padding:0;Margin:0;width:187px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    bgcolor="transparent"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent"
                                                                    role="presentation">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="right" class="es-m-txt-l"
                                                                            style="padding:0;Margin:0;padding-top:10px;padding-bottom:15px">
                                                                            <h2
                                                                                style="Margin:0;line-height:33.6px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#ffffff">
                                                                                '.$rowInfoEmailAdmin[0]['valor'].',</h2>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="140"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table> <!--[if mso]></td><td style="width:20px"></td>
        <td style="width:353px" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" class="es-right" align="right"
                                                        role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="left" style="padding:0;Margin:0;width:353px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="46"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="left" style="padding:0;Margin:0">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                Nos complace informarle que la solicitud que realizó '.$rowInfoSolicitante->nom_usu.' en nuestro sistema de Inventarios ha sido entregada '.(($est_sol == 3) ? 'exitosamente' : "parcialmente").'.</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="left" bgcolor="transparent"
                                                                            style="padding:0;Margin:0;padding-top:10px;padding-bottom:30px">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                Detalles de la solicitud:
                                                                            </p>
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                - Solicitud #'.$id_sol.'
                                                                            </p>
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                - Fecha de solicitud: '.$rowInfoSol->fec_sol.'
                                                                            </p>
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                - Estado: <span class="rounded-pill badge bg-info">'.$rowInfoSol->nom_est_sol.'</span>
                                                                            </p>
                                                                        </td>
                                                                    </tr>

                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table> <!--[if mso]></td></tr></table><![endif]-->
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none"
                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                <tr style="border-collapse:collapse">
                                    <td align="center" bgcolor="#fafafa" style="padding:0;Margin:0;background-color:#fafafa">
                                        <table bgcolor="#fafafa" class="es-content-body" align="center" cellpadding="0"
                                            cellspacing="0"
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#fafafa;width:600px"
                                            role="none">
                                            <tr style="border-collapse:collapse">
                                                <td align="left" bgcolor="#fafafa"
                                                    style="Margin:0;padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:30px;background-color:#fafafa">
                                                    <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" valign="top"
                                                                style="padding:0;Margin:0;width:560px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="left" class="es-m-txt-l"
                                                                            style="padding:0;Margin:0">
                                                                            <h2
                                                                                style="Margin:0;line-height:28.8px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#170058">
                                                                                Productos Entregados:&nbsp;</h2>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>';

                                            foreach ($prod_entregado as $product) {
                                                $content_body .= '
                                                    <tr style="border-collapse:collapse; border-bottom: lightsteelblue 1px solid;">
                                                        <td align="left" bgcolor="#fafafa" style="padding:20px;Margin:0;background-color:#fafafa"><!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:270px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-left" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tbody><tr style="border-collapse:collapse">
                                                            <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:270px">
                                                            <table class="es-table-not-adapt" width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tbody><tr style="border-collapse:collapse">
                                                                <td class="es-m-txt-c" valign="top" align="left" style="padding:0;Margin:0;padding-right:15px;width:30px;font-size:0px"><img src="https://intranet.masterquimica.com/documentos/inventarios/productos/'.$product->img_prod.'" alt="" width="60" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></td>
                                                                <td align="left" style="padding:0;Margin:0">
                                                                <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tbody><tr style="border-collapse:collapse">
                                                                    <td align="left" style="padding:0;Margin:0">
                                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#170058;font-size:14px"><span style="background-color:#164aff">&nbsp;<span style="color:#FFFFFF">Producto&nbsp;</span></span></p>
                                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;font-size:14px">'.$product->nom_prod.'</p>
                                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;font-size:14px">Cantidad:&nbsp;<span style="color:#FFFFFF"><span style="background-color:#164aff">&nbsp;'.$product->entregado.'&nbsp;</span></span></p>
                                                                    </td>
                                                                </tr>
                                                                </tbody></table></td>
                                                            </tr>
                                                            </tbody></table></td>
                                                        </tr>
                                                        </tbody></table><!--[if mso]></td><td style="width:20px"></td><td style="width:270px" valign="top"><![endif]-->
                                                        </td>
                                                    </tr>';
                                            };

                                            if($est_sol == 4){
                                                $content_body .= '
                                                <tr style="border-collapse:collapse">
                                                    <td align="left" bgcolor="#fafafa"
                                                        style="Margin:0;padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:50px;background-color:#fafafa">
                                                        <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr style="border-collapse:collapse">
                                                                <td align="center" valign="top"
                                                                    style="padding:0;Margin:0;width:560px">
                                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                                        role="presentation"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr style="border-collapse:collapse">
                                                                            <td align="left" class="es-m-txt-l"
                                                                                style="padding:0;Margin:0">
                                                                                <h2
                                                                                    style="Margin:0;line-height:28.8px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#170058">
                                                                                    Productos Pendientes:&nbsp;</h2>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>';

                                                foreach ($prod_pendientes as $product) {
                                                    $content_body .= '
                                                        <tr style="border-collapse:collapse; border-bottom: lightsteelblue 1px solid;">
                                                            <td align="left" bgcolor="#fafafa" style="padding:20px;Margin:0;background-color:#fafafa"><!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:270px" valign="top"><![endif]-->
                                                            <table cellpadding="0" cellspacing="0" class="es-left" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tbody><tr style="border-collapse:collapse">
                                                                <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:270px">
                                                                <table class="es-table-not-adapt" width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tbody><tr style="border-collapse:collapse">
                                                                    <td class="es-m-txt-c" valign="top" align="left" style="padding:0;Margin:0;padding-right:15px;width:30px;font-size:0px"><img src="https://intranet.masterquimica.com/documentos/inventarios/productos/'.$product->img_prod.'" alt="" width="60" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></td>
                                                                    <td align="left" style="padding:0;Margin:0">
                                                                    <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tbody><tr style="border-collapse:collapse">
                                                                        <td align="left" style="padding:0;Margin:0">
                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#170058;font-size:14px"><span style="background-color:#164aff">&nbsp;<span style="color:#FFFFFF">Producto&nbsp;</span></span></p>
                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;font-size:14px">'.$product->nom_prod.'</p>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody></table></td>
                                                                </tr>
                                                                </tbody></table></td>
                                                            </tr>
                                                            </tbody></table><!--[if mso]></td><td style="width:20px"></td><td style="width:270px" valign="top"><![endif]-->
                                                            </td>
                                                        </tr>';
                                                };
                                            }

                                            $content_body .= '
                                            <tr style="border-collapse:collapse">
                                                <td align="left" bgcolor="#fafafa"
                                                    style="Margin:0;padding-bottom:50px;padding-left:20px;padding-right:20px;padding-top:30px;background-color:#fafafa">
                                                    <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" valign="top"
                                                                style="padding:0;Margin:0;width:560px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="left"
                                                                            style="padding:0;Margin:0;padding-top:15px">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#170058;font-size:14px">
                                                                                Si tiene alguna consulta adicional o necesita más información, no dudes en ponerse en contacto con nosotros.
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>';
                
        $mail->Body = $body_head_email.$content_body.$body_footer_email;
        break;
      
      case '5':
        //Cuerpo del correo que recibe el solicitante cuando se rechaza la solicitud 
        $content_body = '
                            <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none"
                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                <tr style="border-collapse:collapse">
                                    <td align="center"
                                        style="padding:0;Margin:0;background-color:#fee8db;background-image:url(https://eizjlnq.stripocdn.email/content/guids/videoImgGuid/images/bg1111_a23.png);background-repeat:no-repeat;background-position:center top"
                                        bgcolor="#fee8db"
                                        background="https://eizjlnq.stripocdn.email/content/guids/videoImgGuid/images/bg1111_a23.png">
                                        <table class="es-content-body" align="center" cellpadding="0" cellspacing="0"
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"
                                            role="none">
                                            <tr style="border-collapse:collapse">
                                                <td class="es-m-p30t es-m-p30b" align="left"
                                                    style="Margin:0;padding-bottom:5px;padding-top:20px;padding-left:20px;padding-right:20px"> <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr>
        <td style="width:257px" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" align="left" class="es-left"
                                                        role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="left" class="es-m-p20b"
                                                                style="padding:0;Margin:0;width:257px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="53"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="center"
                                                                            style="padding:0;Margin:0;font-size:0px"><img
                                                                                src="https://intranet.masterquimica.com/resources/img/img_email_inv.png"
                                                                                alt
                                                                                style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
                                                                                width="257"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!--[if mso]></td><td style="width:10px"></td><td style="width:293px" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" class="es-right" align="right"
                                                        role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" valign="top"
                                                                style="padding:0;Margin:0;width:293px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="96"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="right" class="es-m-txt-c es-m-p10t"
                                                                            style="padding:0;Margin:0">
                                                                            <h1
                                                                                style="Margin:0;line-height:54px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:40px;font-style:normal;font-weight:normal;color:#ff0000">
                                                                                Inventarios MQ</h1>
                                                                            <h1
                                                                                style="Margin:0;line-height:33.6px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:28px;font-style:normal;font-weight:normal;color:#ff0000">
                                                                                <b>Solicitud #'.$id_sol.'</b></h1>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="right" class="es-m-txt-c"
                                                                            style="padding:0;Margin:0;padding-top:15px;padding-bottom:15px">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:22.5px;color:#000207;font-size:15px">
                                                                                Rechazada</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="67"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table> <!--[if mso]></td></tr></table><![endif]-->
                                                </td>
                                            </tr>
                                            <tr style="border-collapse:collapse">
                                                <td align="left" bgcolor="#fb3210"
                                                    style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-color:#fb3210;background-image:url(https://eizjlnq.stripocdn.email/content/guids/CABINET_2001cb1a6423a25da7be033e7fc53db9c9e248b00d454f818340be0709e511b9/images/bgw2.png);background-repeat:no-repeat;background-position:center top"
                                                    background="https://eizjlnq.stripocdn.email/content/guids/CABINET_2001cb1a6423a25da7be033e7fc53db9c9e248b00d454f818340be0709e511b9/images/bgw2.png">
                                                    <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:187px" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" align="left" class="es-left"
                                                        role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tr style="border-collapse:collapse">
                                                            <td class="es-m-p20b" align="center" valign="top"
                                                                style="padding:0;Margin:0;width:187px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    bgcolor="transparent"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent"
                                                                    role="presentation">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="right" class="es-m-txt-l"
                                                                            style="padding:0;Margin:0;padding-top:10px;padding-bottom:15px">
                                                                            <h2
                                                                                style="Margin:0;line-height:33.6px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#ffffff">
                                                                                '.$rowInfoSolicitante->nom_usu.',</h2>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="140"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table> <!--[if mso]></td><td style="width:20px"></td>
        <td style="width:353px" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" class="es-right" align="right"
                                                        role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="left" style="padding:0;Margin:0;width:353px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr class="es-mobile-hidden"
                                                                        style="border-collapse:collapse">
                                                                        <td align="center" height="46"
                                                                            style="padding:0;Margin:0"></td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="left" style="padding:0;Margin:0">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                Le informamos que la solicitud que realizó en nuestro sistema de Inventarios ha sido rechazada.</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="left" bgcolor="transparent"
                                                                            style="padding:0;Margin:0;padding-top:10px;padding-bottom:30px">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                Detalles de la solicitud:
                                                                            </p>
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                - Solicitud #'.$id_sol.'
                                                                            </p>
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                - Fecha de solicitud: '.$rowInfoSol->fec_sol.'
                                                                            </p>
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                - Estado: <span class="rounded-pill badge bg-info">'.$rowInfoSol->nom_est_sol.'</span>
                                                                            </p>
                                                                        </td>
                                                                    </tr>

                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table> <!--[if mso]></td></tr></table><![endif]-->
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none"
                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                <tr style="border-collapse:collapse">
                                    <td align="center" bgcolor="#fafafa" style="padding:0;Margin:0;background-color:#fafafa">
                                        <table bgcolor="#fafafa" class="es-content-body" align="center" cellpadding="0"
                                            cellspacing="0"
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#fafafa;width:600px"
                                            role="none">
                                            <tr style="border-collapse:collapse">
                                                <td align="left" bgcolor="#fafafa"
                                                    style="Margin:0;padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:30px;background-color:#fafafa">
                                                    <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" valign="top"
                                                                style="padding:0;Margin:0;width:560px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="left" class="es-m-txt-l"
                                                                            style="padding:0;Margin:0">
                                                                            <h2
                                                                                style="Margin:0;line-height:28.8px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#170058">
                                                                                Productos Rechazados:&nbsp;</h2>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>';

                                            foreach ($rowInfoSolProd as $product) {
                                                $content_body .= '
                                                    <tr style="border-collapse:collapse; border-bottom: lightsteelblue 1px solid;">
                                                        <td align="left" bgcolor="#fafafa" style="padding:20px;Margin:0;background-color:#fafafa"><!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:270px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-left" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tbody><tr style="border-collapse:collapse">
                                                            <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:270px">
                                                            <table class="es-table-not-adapt" width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tbody><tr style="border-collapse:collapse">
                                                                <td class="es-m-txt-c" valign="top" align="left" style="padding:0;Margin:0;padding-right:15px;width:30px;font-size:0px"><img src="https://intranet.masterquimica.com/documentos/inventarios/productos/'.$product->img_prod.'" alt="" width="60" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></td>
                                                                <td align="left" style="padding:0;Margin:0">
                                                                <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tbody><tr style="border-collapse:collapse">
                                                                    <td align="left" style="padding:0;Margin:0">
                                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#170058;font-size:14px"><span style="background-color:#164aff">&nbsp;<span style="color:#FFFFFF">Producto&nbsp;</span></span></p>
                                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;font-size:14px">'.$product->nom_prod.'</p>
                                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;font-size:14px">Cantidad Solicitada:&nbsp;<span style="color:#FFFFFF"><span style="background-color:#164aff">&nbsp;'.$product->cant_sol.'&nbsp;</span></span></p>
                                                                    </td>
                                                                </tr>
                                                                </tbody></table></td>
                                                            </tr>
                                                            </tbody></table></td>
                                                        </tr>
                                                        </tbody></table><!--[if mso]></td><td style="width:20px"></td><td style="width:270px" valign="top"><![endif]-->
                                                        </td>
                                                    </tr>';
                                            };

                                            $content_body .= '
                                            <tr style="border-collapse:collapse">
                                                <td align="left" bgcolor="#fafafa"
                                                    style="Margin:0;padding-bottom:50px;padding-left:20px;padding-right:20px;padding-top:30px;background-color:#fafafa">
                                                    <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" valign="top"
                                                                style="padding:0;Margin:0;width:560px">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                    role="presentation"
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="left"
                                                                            style="padding:0;Margin:0;padding-top:15px">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#170058;font-size:14px">
                                                                                Si tiene alguna consulta adicional o necesita más información, no dudes en ponerse en contacto con nosotros.
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>';
                
        $mail->Body = $body_head_email.$content_body.$body_footer_email;
        break;

        case '6':
            //Cuerpo del correo que recibe el administrador del inventario cuando se rechaza la solicitud 
            $content_body = '
                                <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none"
                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                    <tr style="border-collapse:collapse">
                                        <td align="center"
                                            style="padding:0;Margin:0;background-color:#fee8db;background-image:url(https://eizjlnq.stripocdn.email/content/guids/videoImgGuid/images/bg1111_a23.png);background-repeat:no-repeat;background-position:center top"
                                            bgcolor="#fee8db"
                                            background="https://eizjlnq.stripocdn.email/content/guids/videoImgGuid/images/bg1111_a23.png">
                                            <table class="es-content-body" align="center" cellpadding="0" cellspacing="0"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"
                                                role="none">
                                                <tr style="border-collapse:collapse">
                                                    <td class="es-m-p30t es-m-p30b" align="left"
                                                        style="Margin:0;padding-bottom:5px;padding-top:20px;padding-left:20px;padding-right:20px"> <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr>
            <td style="width:257px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" align="left" class="es-left"
                                                            role="none"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tr style="border-collapse:collapse">
                                                                <td align="left" class="es-m-p20b"
                                                                    style="padding:0;Margin:0;width:257px">
                                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                                        role="presentation"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr class="es-mobile-hidden"
                                                                            style="border-collapse:collapse">
                                                                            <td align="center" height="53"
                                                                                style="padding:0;Margin:0"></td>
                                                                        </tr>
                                                                        <tr style="border-collapse:collapse">
                                                                            <td align="center"
                                                                                style="padding:0;Margin:0;font-size:0px"><img
                                                                                    src="https://intranet.masterquimica.com/resources/img/img_email_inv.png"
                                                                                    alt
                                                                                    style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
                                                                                    width="257"></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <!--[if mso]></td><td style="width:10px"></td><td style="width:293px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-right" align="right"
                                                            role="none"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                            <tr style="border-collapse:collapse">
                                                                <td align="center" valign="top"
                                                                    style="padding:0;Margin:0;width:293px">
                                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                                        role="presentation"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr class="es-mobile-hidden"
                                                                            style="border-collapse:collapse">
                                                                            <td align="center" height="96"
                                                                                style="padding:0;Margin:0"></td>
                                                                        </tr>
                                                                        <tr style="border-collapse:collapse">
                                                                            <td align="right" class="es-m-txt-c es-m-p10t"
                                                                                style="padding:0;Margin:0">
                                                                                <h1
                                                                                    style="Margin:0;line-height:54px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:40px;font-style:normal;font-weight:normal;color:#ff0000">
                                                                                    Inventarios MQ</h1>
                                                                                <h1
                                                                                    style="Margin:0;line-height:33.6px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:28px;font-style:normal;font-weight:normal;color:#ff0000">
                                                                                    <b>Solicitud #'.$id_sol.'</b></h1>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="border-collapse:collapse">
                                                                            <td align="right" class="es-m-txt-c"
                                                                                style="padding:0;Margin:0;padding-top:15px;padding-bottom:15px">
                                                                                <p
                                                                                    style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:22.5px;color:#000207;font-size:15px">
                                                                                    Rechazada</p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="es-mobile-hidden"
                                                                            style="border-collapse:collapse">
                                                                            <td align="center" height="67"
                                                                                style="padding:0;Margin:0"></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table> <!--[if mso]></td></tr></table><![endif]-->
                                                    </td>
                                                </tr>
                                                <tr style="border-collapse:collapse">
                                                    <td align="left" bgcolor="#fb3210"
                                                        style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-color:#fb3210;background-image:url(https://eizjlnq.stripocdn.email/content/guids/CABINET_2001cb1a6423a25da7be033e7fc53db9c9e248b00d454f818340be0709e511b9/images/bgw2.png);background-repeat:no-repeat;background-position:center top"
                                                        background="https://eizjlnq.stripocdn.email/content/guids/CABINET_2001cb1a6423a25da7be033e7fc53db9c9e248b00d454f818340be0709e511b9/images/bgw2.png">
                                                        <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:187px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" align="left" class="es-left"
                                                            role="none"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tr style="border-collapse:collapse">
                                                                <td class="es-m-p20b" align="center" valign="top"
                                                                    style="padding:0;Margin:0;width:187px">
                                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                                        bgcolor="transparent"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent"
                                                                        role="presentation">
                                                                        <tr style="border-collapse:collapse">
                                                                            <td align="right" class="es-m-txt-l"
                                                                                style="padding:0;Margin:0;padding-top:10px;padding-bottom:15px">
                                                                                <h2
                                                                                    style="Margin:0;line-height:33.6px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#ffffff">
                                                                                    '.$rowInfoEmailAdmin[0]['valor'].',</h2>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="es-mobile-hidden"
                                                                            style="border-collapse:collapse">
                                                                            <td align="center" height="140"
                                                                                style="padding:0;Margin:0"></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table> <!--[if mso]></td><td style="width:20px"></td>
            <td style="width:353px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-right" align="right"
                                                            role="none"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                            <tr style="border-collapse:collapse">
                                                                <td align="left" style="padding:0;Margin:0;width:353px">
                                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                                        role="presentation"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr class="es-mobile-hidden"
                                                                            style="border-collapse:collapse">
                                                                            <td align="center" height="46"
                                                                                style="padding:0;Margin:0"></td>
                                                                        </tr>
                                                                        <tr style="border-collapse:collapse">
                                                                            <td align="left" style="padding:0;Margin:0">
                                                                                <p
                                                                                    style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                    Le informamos que la solicitud que realizó '.$rowInfoSolicitante->nom_usu.' en nuestro sistema de Inventarios ha sido rechazada.</p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="border-collapse:collapse">
                                                                            <td align="left" bgcolor="transparent"
                                                                                style="padding:0;Margin:0;padding-top:10px;padding-bottom:30px">
                                                                                <p
                                                                                    style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                    Detalles de la solicitud:
                                                                                </p>
                                                                                <p
                                                                                    style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                    - Solicitud #'.$id_sol.'
                                                                                </p>
                                                                                <p
                                                                                    style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                    - Fecha de solicitud: '.$rowInfoSol->fec_sol.'
                                                                                </p>
                                                                                <p
                                                                                    style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#ffffff;font-size:14px">
                                                                                    - Estado: <span class="rounded-pill badge bg-info">'.$rowInfoSol->nom_est_sol.'</span>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
    
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table> <!--[if mso]></td></tr></table><![endif]-->
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none"
                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                    <tr style="border-collapse:collapse">
                                        <td align="center" bgcolor="#fafafa" style="padding:0;Margin:0;background-color:#fafafa">
                                            <table bgcolor="#fafafa" class="es-content-body" align="center" cellpadding="0"
                                                cellspacing="0"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#fafafa;width:600px"
                                                role="none">
                                                <tr style="border-collapse:collapse">
                                                    <td align="left" bgcolor="#fafafa"
                                                        style="Margin:0;padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:30px;background-color:#fafafa">
                                                        <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr style="border-collapse:collapse">
                                                                <td align="center" valign="top"
                                                                    style="padding:0;Margin:0;width:560px">
                                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                                        role="presentation"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr style="border-collapse:collapse">
                                                                            <td align="left" class="es-m-txt-l"
                                                                                style="padding:0;Margin:0">
                                                                                <h2
                                                                                    style="Margin:0;line-height:28.8px;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#170058">
                                                                                    Productos Rechazados:&nbsp;</h2>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>';
    
                                                foreach ($rowInfoSolProd as $product) {
                                                    $content_body .= '
                                                        <tr style="border-collapse:collapse; border-bottom: lightsteelblue 1px solid;">
                                                            <td align="left" bgcolor="#fafafa" style="padding:20px;Margin:0;background-color:#fafafa"><!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:270px" valign="top"><![endif]-->
                                                            <table cellpadding="0" cellspacing="0" class="es-left" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tbody><tr style="border-collapse:collapse">
                                                                <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:270px">
                                                                <table class="es-table-not-adapt" width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tbody><tr style="border-collapse:collapse">
                                                                    <td class="es-m-txt-c" valign="top" align="left" style="padding:0;Margin:0;padding-right:15px;width:30px;font-size:0px"><img src="https://intranet.masterquimica.com/documentos/inventarios/productos/'.$product->img_prod.'" alt="" width="60" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></td>
                                                                    <td align="left" style="padding:0;Margin:0">
                                                                    <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tbody><tr style="border-collapse:collapse">
                                                                        <td align="left" style="padding:0;Margin:0">
                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#170058;font-size:14px"><span style="background-color:#164aff">&nbsp;<span style="color:#FFFFFF">Producto&nbsp;</span></span></p>
                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;font-size:14px">'.$product->nom_prod.'</p>
                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;font-size:14px">Cantidad Solicitada:&nbsp;<span style="color:#FFFFFF"><span style="background-color:#164aff">&nbsp;'.$product->cant_sol.'&nbsp;</span></span></p>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody></table></td>
                                                                </tr>
                                                                </tbody></table></td>
                                                            </tr>
                                                            </tbody></table><!--[if mso]></td><td style="width:20px"></td><td style="width:270px" valign="top"><![endif]-->
                                                            </td>
                                                        </tr>';
                                                };
    
                                                $content_body .= '
                                                <tr style="border-collapse:collapse">
                                                    <td align="left" bgcolor="#fafafa"
                                                        style="Margin:0;padding-bottom:50px;padding-left:20px;padding-right:20px;padding-top:30px;background-color:#fafafa">
                                                        <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr style="border-collapse:collapse">
                                                                <td align="center" valign="top"
                                                                    style="padding:0;Margin:0;width:560px">
                                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                                        role="presentation"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr style="border-collapse:collapse">
                                                                            <td align="left"
                                                                                style="padding:0;Margin:0;padding-top:15px">
                                                                                <p
                                                                                    style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Roboto, sans-serif;line-height:21px;color:#170058;font-size:14px">
                                                                                    Si tiene alguna consulta adicional o necesita más información, no dudes en ponerse en contacto con nosotros.
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>';
                    
            $mail->Body = $body_head_email.$content_body.$body_footer_email;
            break;

    }