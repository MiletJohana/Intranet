/*CRM*/
function serverSideClientes() {
    idTable = "tableClientes";
    var table = $('#' + idTable).DataTable({
        "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "../serverside/serversideClientes.php",
            "type": "POST",
            "data" : function (d) {
                if($('#tip_cli').val() != ""){
                    d.tip_cli = $('#tip_cli').val();
                }
                if($('#fec_crea').val() != ""){
                    d.fec_crea = $('#fec_crea').val();
                }
                if($('#nitCc').val() != ""){
                    d.nit_cc = $('#nitCc').val();
                }
                if($('#id_ciu').val() != ""){
                    d.id_ciu = $('#id_ciu').val();
                }
            }
        },
        "columns": [{
            "className": 'details-control',
            "data": "id_cli"
        },
        {
            "data": "num_doc"
        },
        {
            "data": "nom_cli",
            "render": function (a, b, c) {
                return '<a href="../clientes2/index.php?id=' + c['id_cli'] + '">' + c['nom_cli'] + '</a>';
            }
        },
        {
            "data": "tel_cli"
        },
        {
            "data": "eml_cli"
        },
        {
            "data": "dir_cli",
            "render": function (data) {
                return '<a href="https://www.google.com/maps/search/' + data + '" target="_blank">' + data + '</a>';
            }
        },
        {
            "data": null,
            "orderable": false,
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown"><a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal"';
                dropdown += 'onclick="modalCliente(2, ' + c['id_cli'] + ', 1);"><i class="fa-solid fa-pen-to-square me-2"></i> Editar</a></div></div>';
                return dropdown;
            }
        }
        ],
        "order": [
            [0, 'asc']
        ],
    });
    // Add event listener for opening and closing details
    $('#' + idTable + ' tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(formatTCliente(row.data())).show();
            tr.addClass('shown');
        }
    });
}
function serverSidePermisos(tabla, option, lid, area) {  
    if(tabla == 1){
        new DataTable('.tablePermisos1', {
            "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
            },
            "processing": true,
            "serverSide": true,
                "ajax": {
                    "url": "../serverside/serversidePermisos.php",
                    "type": "POST",
                    "data": function (d) {
                        d.numTable = 1,
                        d.option = option
                    }
                },
              
                "columns": [{
                    "data": "id_per" 
                },
                {
                    "data": "nom_usu"
                },
                {
                    "data": "fech_sis"
                },
                {
                    "data": "fech_aus"
                },
                {
                    "data": "nom_are"
                },
                {
                    "data": "fech_ini"
                },
                {
                    "data": "fech_fin"
                },
                {
                    "data": "descrip_per"
                },
                {
                    "data": "doc_perm",
                    "render": function(a, b, c) {
                        if (c['doc_perm'] != null) {
                            return ' <div><a class="btn btn-secondary btn-sm" href="../../documentos/permisos/' + c['doc_perm'] + '" target="_blank"><i class="fa-solid fa-file-pdf"></i></a></div>';
                        } else if((c['mot_per'] == 1 || c['mot_per'] == 2 || c['mot_per'] == 3) && (c['doc_perm'] == null || c['doc_perm'] == "")){
                            return '<i class="fa-solid fa-triangle-exclamation"></i>';
                        } else {     
                            return '<p>--</p>';
                        }
                    }
                },
                {
                    "data" : "nom_estPer",
                    "render": function(a, b, c) {
                        if(option==1){
                            if (c['id_estPer'] == 1) {
                                return '<span class="badge  bg-label-primary">'+c['nom_estPer']+'</span>';
                            } else if(c['id_estPer'] == 2){
                                return '<span class="badge  bg-label-info">'+c['nom_estPer']+'</span>';
                            } else if(c['id_estPer'] == 3){
                                return '<span class="badge  bg-label-success">'+c['nom_estPer']+'</span>';
                            } else if(c['id_estPer'] == 4){
                                return '<span class="badge  bg-label-danger">'+c['nom_estPer']+'</span>';
                            } else if(c['id_estPer'] == 5){
                                return '<span class="badge  bg-label-warning">'+c['nom_estPer']+'</span>';
                            } else {     
                                return '<span class="badge  bg-label-dark">'+c['nom_estPer']+'</span>';
                            }
                        }
                        else if(option==2){
                            input = '<div class="checkbox"><label><input type="checkbox" value="Revisado" name="estper'+c['id_per']+'" id="estPer'+c['id_per']+'" onclick="aceptado('+c['id_per']+','+"'permisos'"+', '+"'../permisos/tabla2.php'"+');"></label></div>';
                            return input;
                        }
                        
                    }
                },
                {
                    "data": null,
                    "orderable": false,
                    "render": function (a, b, c) {
                        dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                        dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                        if(option==1){
                            dropdown += '<a onclick="editarPer(4,'+"'Actualizar Permiso'"+','+"'../permisos/form1.php'"+', '+c['id_per']+','+"'form-perm'"+','+"'permisos'"+','+"'tabla.php'"+');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square"></i> Editar</a>';
                            dropdown += '<a onclick="mostrarSeg(0,'+"'Seguimiento'"+', '+"'../permisos/seguimiento.php'"+', '+c['id_per']+');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-share"></i> Seguimiento</a>'
                        }
                        else if(option==2){
                            dropdown += '<a class="btn btn-link dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg(0,'+"'Seguimiento'"+', '+"'../permisos/seguimiento.php'"+','+c['id_per']+');"><i class="fa-solid fa-share"></i> Seguimiento</a>';
                            if (c['crea_rec'] == 1) {
                                dropdown += '<a class="btn btn-link dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarPer(4,'+"'Editar Permiso'"+','+"'../permisos/form1.php'"+','+c['id_per']+','+"'form-perm'"+','+"'permisos'"+','+"'tabla2.php'"+');"><i class="fa-solid fa-pen-to-square"></i> Editar</a>';
                            }
                            else if (c['crea_rec'] == 0) {
                                dropdown += '<a class="btn btn-link dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarPer(4,'+"'Editar Permiso'"+','+"'../permisos/form1.php'"+','+c['id_per']+','+"'form-perm'"+','+"'permisos'"+','+"'tabla2.php'"+');"><i class="fa-solid fa-pen-to-square"></i> Editar</a>';
                            }
                        }
                        dropdown += '</div></div>';
                        return dropdown;
                    }
                }
                
                ],
                "order": [
                    [0, 'desc']
                ],
                
                
        }); 
    } 
    else if(tabla == 2){
        new DataTable('#tablePermisos2-1', {
            "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
            },
            "processing": true,
            "serverSide": true,
                "ajax": {
                    "url": "../serverside/serversidePermisos.php",
                    "type": "POST",
                    "data": function (d) {
                        d.numTable = 2,
                        d.num_lid = lid,
                        d.num_are = area
                    }
                },
              
                "columns": [{
                    "data": "id_per" 
                },
                {
                    "data": "nom_usu"
                },
                {
                    "data": "fech_sis"
                },
                {
                    "data": "fech_aus"
                },
                {
                    "data": "fech_ini"
                },
                {
                    "data": "fech_fin"
                },
                {
                    "data": "descrip_per"
                },
                {
                    "data": "obser_perm",
                    "render": function(a, b, c) {
                        if (c['obser_perm'] != "" ) {
                            return c['obser_perm'];
    
                        } else if(lid != "" && lid == 2 || lid == 1 || lid == 4){
                            return '<p>--</p>';
                        } 
                    }
                },
                {
                    "data": "doc_perm",
                    "render": function(a, b, c) {
                        if (c['doc_perm'] != null) {
                            return ' <div><a class="btn btn-secondary btn-sm" href="../../documentos/permisos/' + c['doc_perm'] + '" target="_blank"><i class="fa-solid fa-file-pdf"></i></a></div>';
                        } else if((c['mot_per'] == 1 || c['mot_per'] == 2 || c['mot_per'] == 3) && (c['doc_perm'] == null || c['doc_perm'] == "")){
                            return '<i class="fa-solid fa-triangle-exclamation"></i>';
                        } else {     
                            return '<p>--</p>';
                        }
                    }
                },
                {
                    "data": "id_estPer",
                    "class": "table-td-sm center-text",
                    "render": function(a, b, c) {
                        if (area != "" && area == 9 && lid == 3) {
                            input = '<input class="custom-control-input" type="checkbox" value="0" name="estper'+c['id_per']+'" id="estPer'+c['id_per']+'" onclick="aceptado('+c['id_per']+','+"'permisos'"+', '+"'../permisos/tabla2.php'"+');">';
                            input += '<label class="custom-control-label" for="defaultChecked2"></label>';
                            return input
    
                        } else if(lid != "" && lid == 2 || lid == 1 || lid == 4){
                            estado = '<div class="dropdown"><button type="button"'; 
                            if(c['id_estPer']==1){
                                estado += 'class="btn btn-secondary btn-sm btn-circle dropdown"';
                            } else if(c['id_estPer']!=1){
                                estado += 'class="btn btn-secondary btn-sm btn-circle btn-info"';
                            }
                            estado += 'id="btn-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-regular fa-circle"></i></button>';
                            estado += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                            estado += '<a class="dropdown-item btn btn-info text-white"  onclick="updEst(2,'+c['id_per']+','+"'btn-"+c['id_per']+"'"+','+"'permisos'"+','+"'../permisos/tabla2.php'"+');">Pendiente Por Líder</a>';
                            estado += '<a class="dropdown-item btn btn-success text-white"  onclick="updEst(3,'+c['id_per']+','+"'btn-"+c['id_per']+"'"+','+"'permisos'"+','+"'../permisos/tabla2.php'"+');">Aprobada</a>';
                            estado += '<a class="dropdown-item btn btn-danger text-white"  onclick="updEst(4,'+c['id_per']+','+"'btn-"+c['id_per']+"'"+','+"'permisos'"+','+"'../permisos/tabla2.php'"+');">Rechazada</a>';
                            estado += '</div></div>';
                            return estado;
                        } 
                    }
                },
                {
                    "data": null,
                    "orderable": false,
                    "render": function (a, b, c) {
                        dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                        dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                        dropdown += '<a onclick="editarPer(4,'+"'Actualizar Permiso'"+','+"'../permisos/form1.php'"+', '+c['id_per']+','+"'form-perm'"+','+"'permisos'"+','+"'tabla2.php'"+');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square"></i> Editar</a>';
                        dropdown += '<a onclick="mostrarSeg(0,'+"'Seguimiento'"+', '+"'../permisos/seguimiento.php'"+', '+c['id_per']+');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-share"></i> Seguimiento</a>'
                        dropdown += '</div></div>';
                        return dropdown;
                    }
                }
                
                ],
                "order": [
                    [0, 'desc']
                ],
                
                "rowCallback": function( row, data){
                    var id = data['id_estPer'];
                    if( id ==  `2`){
                        $(row).addClass('table-info');
                    }
                    else if( id ==  `3`){
                        $(row).addClass('table-success');
                    }
                    else if( id ==  `4`){
                        $(row).addClass('table-danger');
                    }
                },
                
        });
    }
}
function formatTCliente(d) {
    return '<strong>Web:</strong> <a href="' + d['web_cli'] + '" target="_blank">' + d['web_cli'] + '</a> </br><strong>Asesor Comercial:</strong> ' + d['ase_com'] + ' </br><strong>Representante SAC:</strong> ' + d['rep_sac'];
}
function serverSideContactos() {
    idTable = "tableContactos";
    var table = $('#' + idTable).DataTable({
        "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "../serverside/serversideContactos.php",
            "type": "POST"
        },
        "columns": [{
            "data": "id_cont"
        },
        {
            "data": "num_doc"
        },
        {
            "data": "nom_cli",
            "render": function (a, b, c) {
                return '<a href="../clientes2/index.php?id=' + c['id_cli'] + '">' + c['nom_cli'] + '</a>';
            }
        },
        {
            "data": "nom_cont"
        },
        {
            "data": "tel_cont"
        },
        {
            "data": "eml_cont"
        },
        {
            "data": "car_cont"
        },
        {
            "data": null,
            "orderable": false,
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown"><a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal"';
                dropdown += 'onclick="modalContacto(2, ' + c['id_cli'] + ', 1);"><i class="fa-solid fa-pen-to-square me-2"></i> Editar</a></div></div>';
                return dropdown;
            }
        }
        ],
        "order": [
            [0, 'asc']
        ],
    });
    
}
function serverSideTransacciones(id, param) {
    if (param == 1) {
        id = "id_cli=" + id
    } else {
        id = "id_neg=" + id
    }
    idTable = "tableTransacciones";
    var table = $('#' + idTable).DataTable({
        "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "../serverside/serversideTransacciones.php?" + id,
            "type": "POST"
        },
        "columns": [{
            "className": 'details-control',
            "data": 'id_tra'
        },
        {
            "data": 'tipo'
        },
        {
            "data": 'nom_usu'
        },
        {
            "data": 'fec_crea'
        }]
    });
    // Add event listener for opening and closing details
    $('#' + idTable + ' tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(formatTransacciones(row.data())).show();
            tr.addClass('shown');
        }
    });
}
function formatTransacciones(d) {
    if (d['id_tipo'] == 1) {
        return '<strong>Correo destino:</strong> ' + d['corr_destino'] + ' </br><strong>Asunto:</strong> ' + d['corr_asunto'] + ' </br><strong>Cuerpo:</strong> ' + d['corr_cuerpo'];
    } else if (d['id_tipo'] == 2) {
        return '<strong>Titulo:</strong> ' + d['nota_titulo'] + ' </br><strong>Contenido:</strong> ' + d['nota_contenido']
    } else if (d['id_tipo'] == 3) {
        return '<strong>Fecha:</strong> ' + d['rec_fecha'] + ' </br><strong>Asunto:</strong> ' + d['rec_asunto']
    } else if (d['id_tipo'] == 4) {
        return '<strong>Destino:</strong> ' + d['lla_destino'] + ' </br><strong>Agendada:</strong> ' + d['lla_agendar'] + ' </br><strong>Observación:</strong> ' + d['lla_observacion']
    }
}
function serverSideNegocios(id_cli) {
    idTable = "tableNegocios";
    if (id_cli != null || id_cli != '') {
        var table = $('#' + idTable).DataTable({
            "language": {
                "url": "../../resources/utils/datatables/spanish.lang.json"
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "../serverside/serversideNegocios.php?id_cli=" + id_cli,
                "type": "GET"
            },
            "columns": [{
                "className": 'details-control',
                "data": "id_neg"
            },
            {
                "data": "nom_neg",
                "render": function (a, b, c) {
                    return '<a href="../crm/index.php?id=' + c['id_neg'] + '">' + c['nom_neg'] + '</a>';
                }
            },
            {
                "data": "nom_tipo"
            },
            {
                "data": "estado",
                "render": function (a, b, c) {
                    if (c['id_est'] == 2) {
                        return '<span class="badge bg-label-success" style="font-size: 0.95em;"><i class="fa-solid fa-check"></i> ' + c['estado'] + '</span>';
                    } else if (c['id_est'] == 3) {
                        return '<span class="badge bg-label-info" style="font-size: 0.95em;"><i class="fa-solid fa-clock"></i> ' + c['estado'] + '</span>';
                    } else if (c['id_est'] == 4) {
                        return '<span class="badge bg-label-danger" style="font-size: 0.95em;"><i class="fa-solid fa-xmark"></i> ' + c['estado'] + '</span>';
                    }
                }
            },
            {
                "data": "val_neg",
                "render": function (data) {
                    if (data != null) {
                        return '$' + data;
                    } else {
                        return ''
                    }
                }
            },
            {
                "data": null,
                "orderable": false,
                "render": function (a, b, c) {
                    dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                    dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown"><a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal"';
                    dropdown += 'onclick="modalNegocio(2, ' + c['id_neg'] + ', ' + c['id_cli'] + ', 2);"><i class="fa-solid fa-pen-to-square me-2"></i> Editar</a></div></div>';
                    return dropdown;
                }
            }
            ],
            "order": [
                [0, 'asc']
            ],
        });
    } else {
        var table = $('#' + idTable).DataTable({
            "language": {
                "url": "../../resources/utils/datatables/spanish.lang.json"
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "../serverside/serversideNegocios.php",
                "type": "GET"
            },
            "columns": [{
                "className": 'details-control',
                "data": "id_neg"
            },
            {
                "data": "nom_neg",
                "render": function (a, b, c) {
                    return '<a href="index.php?id=' + c['id_neg'] + '">' + c['nom_neg'] + '</a>';
                }
            },
            {
                "data": "nom_cli",
                "render": function (a, b, c) {
                    return '<a href="../clientes2/index.php?id=' + c['id_cli'] + '">' + c['nom_cli'] + '</a>';
                }
            },
            {
                "data": "nom_tipo"
            },
            {
                "data": "estado",
                "render": function (a, b, c) {
                    if (c['id_est'] == 2) {
                        return '<span class="badge badge-pill badge-success text-light" style="font-size: 0.95em;"><i class="fa-solid fa-check"></i> ' + c['estado'] + '</span>';
                    } else if (c['id_est'] == 3) {
                        return '<span class="badge badge-pill badge-info text-light" style="font-size: 0.95em;"><i class="fa fa-clock-o"></i> ' + c['estado'] + '</span>';
                    } else if (c['id_est'] == 4) {
                        return '<span class="badge badge-pill badge-danger text-light" style="font-size: 0.95em;"><i class="fa-solid fa-xmark"></i> ' + c['estado'] + '</span>';
                    }
                }
            },
            {
                "data": "val_neg",
                "render": function (data) {
                    if (data != null) {
                        return '$' + data;
                    } else {
                        return ''
                    }
                }
            },
            {
                "data": null,
                "orderable": false,
                "render": function (a, b, c) {
                    dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                    dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown"><a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal"';
                    dropdown += 'onclick="modalNegocio(2, ' + c['id_neg'] + ', 0, 1);"><i class="fa-solid fa-pen-to-square me-2"></i> Editar</a></div></div>';
                    return dropdown;
                }
            }
            ],
            "order": [
                [0, 'asc']
            ],
        });
    }
    // Add event listener for opening and closing details
    $('#' + idTable + ' tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(formatTNegocios(row.data())).show();
            tr.addClass('shown');
        }
    });
}
function formatTNegocios(d) {
    return '<strong>Descripción:</strong> ' + d['des_neg'] + '</br><strong>Observaciones:</strong> ' + d['obs_neg'] + ' </br><strong>Productos:</strong> ' + d['neg_cat'];
}
/*Cotizador*/
function serverSideProductos() {
    idTable = "tableProductos";
    var table = $('#' + idTable).DataTable({
        "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "../serverside/serversideProductos.php",
            "type": "POST"
        },
        "columns": [{
            "className": 'details-control',
            "data": "cod_pro"
        },
        {
            "data": "img_pro",
            "render": function (data) {
                return '<img src="../../documentos/cotizador/images/'+data+'" width="50" height="60"></i>';
            }
        },
        {
            "data": "cod_ref"
        },
        {
            "data": "nom_pro"
        },
        {
            "data": "cod_pro"
        },
        {
            "data": "und_emp"
        },
        {
            "data": "can_emp"
        },
        /*{
            "data": "sin_dev",
            "render": function (data) {
                if (data == 0) {
                    return '<i class="fa fa-close text-danger"></i>';
                } else {
                    return '<i class="fa-solid fa-check text-success"></i>';
                }
            }
        },*/
        {
            "data": null,
            "orderable": false,
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown"><a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal"';
                dropdown += 'onclick="edit_prod(19, ' + c['cod_pro'] + ',1);"><i class="fa-solid fa-pen-to-square me-2"></i> Editar</a></div></div>';
                return dropdown;
            }
        }
        ]
    });
    // Add event listener for opening and closing details
    $('#' + idTable + ' tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(formatTProductos(row.data())).show();
            tr.addClass('shown');
        }
    });
}
function formatTProductos(d) {
    return '<strong>Descripción:</strong> ' + d['des_pro'] + ' </br><strong>Imagen:</strong> <img src="../../documentos/cotizador/images/' + d['img_pro'] + '" width="50" height="60">';
}
function serverSideCotHis(id_usu) {
    idTable = "tableCotizaciones1";
    var table = $('#' + idTable).DataTable({
        "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "../serverside/serversideCotHis.php",
            "type": "GET"
        },
        "columns": [{
            "data": "id_coti"
        },
        {
            "data": "nom_cns",
            "render": function (a, b, c) {
                return '<a href="' + c['doc_coti'] + '">' + c['nom_cns'] + '-' + c['cns_coti'] + '</a>';
            }
        },
        {
            "data": "nom_tip_cot"
        },
        {
            "data": "fec_coti"
        },
        {
            "data": "nom_cli"
        },
        {
            "data": null,
            "orderable": false,
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown"><a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal"';
                dropdown += '<a onclick="editar(';
                if (c['id_tip_cot'] == 6 || c['id_tip_cot'] == 5 || c['id_tip_cot'] == 9 || c['id_tip_cot'] == 3 || c['id_tip_cot'] == 3) {
                    dropdown += '16';
                } else {
                    dropdown += '6';
                } 
                dropdown +=' , '+c['id_coti']+','+id_usu+');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square me-2"></i> Editar</a></div></div>';
                return dropdown;
            }
        }
        ],
        "order": [
            [0, 'desc']
        ],
    });
}
function serverSideProductosPrecios() {
    idTable = "tableProductosPrecios";
    var table = $('#' + idTable).DataTable({
        "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "serverSide": true,
        "processing": true,
        "ajax": {
            "url": "../serverside/serversideProductosPrecios.php",
            "type": "GET"
        },
        "columns": [{
            "className": 'details-control',
            "data": 'id_prod'
        },
        {
            "data": 'cod_pro'
        },
        {
            "data": 'cod_stock'
        },
        {
            "data": 'nom_prod'
        },
        {
            "data": 'id_uni_med',
            "render": function (a, b, c) {
                return c['id_uni_med'] + '-' + c['uni_emp_mq'];
            }
        },
        {
            "data": 'id_fam'
        }]
    });
    // Add event listener for opening and closing details
    $('#' + idTable + ' tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(formatProductosPrecios(row.data())).show();
            tr.addClass('shown');
        }
    });
}
function formatProductosPrecios(d) {
    return '<strong>Descripción:</strong> ' + d['desc_prod']
        + '<br>' + '<strong>Precio base:</strong> $' + d['pre_base']
        + '<br>' + '<strong>Precio 18%:</strong> $' + d['precio18']
        + '<br>' + '<strong>Precio 20%:</strong> $' + d['precio20']
        + '<br>' + '<strong>Precio 22%:</strong> $' + d['precio22']
        + '<br>' + '<strong>Precio 24%:</strong> $' + d['precio24'];
}
function serverSideCotizacionesCRM(id_cli, id_usu) {
    idTable = "tableCotizaciones";
    var table = $('#' + idTable).DataTable({
        "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "../serverside/serversideCotizacionesCrm.php?id_cli=" + id_cli,
            "type": "GET"
        },
        "columns": [{
            "data": "id_coti"
        },
        {
            "data": "nom_cns",
            "render": function (a, b, c) {
                return c["nom_cns"] + '-' + c["cns_coti"].padStart(4, "0");
            }
        },
        {
            "data": "nom_cont"
        },
        {
            "data": "fec_coti"
        },
        {
            "data": "nom_est"
        },
        {
            "data": null,
            "orderable": false,
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown"><a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal"';
                dropdown += 'onclick="editar(';
                if (c['id_tip_cot'] == 2 || c['id_tip_cot'] == 6 || c['id_tip_cot'] == 5 || c['id_tip_cot'] == 9 || c['id_tip_cot'] == 3) {
                    dropdown += 16;
                } else {
                    dropdown += 6;
                }
                dropdown += ', ' + c['id_coti'];
                dropdown += ', ' + id_usu;
                dropdown += ');"><i class="fa-solid fa-pen-to-square me-2"></i> Editar</a>';
                dropdown += '<a class="btn btn-link dropdown-item" href="#" onclick="email(' + c['id_coti'] + ', ' + id_usu + ', ' + c['id_cli'] + ', ' + c['id_cont'] + ',' + c['id_tip_cot'] + ');"><i class="fa-solid fa-envelope me-2"></i> Email</a>'
                dropdown += '</div></div>';
                return dropdown;
            }
        }
        ]
    });
}
function serverSideUsers() {
    new DataTable('#tableUsuarios', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/serversideUsers.php',
            "type": "POST",
            "data" : function (d) {
                if($('#perfil').val() != "1,2"){
                    d.num_perfil = $('#perfil').val();
                }
            }
        },
        "columns": [{
            "data": "id_usu"
        },
        {
            "data": "nom_usu",
        },
        {
            "data": "usuario"
        },
        {
            "data": "fec_crea"
        },
        {
            "data": "usu_upt"
        },
        {
            "data": "eml_usu"
        },
        {
            "data": "nom_are"
        },
        {
            "data": "nom_reg"
        },
        {
            "data": null,
            "orderable": false,
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown"><a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal"';
                dropdown += 'onclick="actualizarUsuario(';
                dropdown +=  c['id_usu'];
                dropdown += ');"class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square"></i> Editar</a>';
                dropdown += '<a class="btn btn-link dropdown-item" href="#" onclick="eliminarUsuario(' + c['id_usu'] + ');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa fa-trash"></i> Eliminar</a>';
                dropdown += '</div></div>';
                return dropdown;
            }
        }
        ],
        order: [[ 2, 'asc' ]],
    });
    
}
function serverSideCertificados() {
    new DataTable('#tableCertificados', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/serversideCertificados.php',
            "type": "POST",
        },
        "columns": [
        {
            "data": "id_cert",
            "visible": false
        },
        {
            "data": "fec_creacion"
        },
        {
            "data": "lugar_remi",
            "render": function(a, b, c) {
                if (c['lugar_remi'] != '') {
                    return c['lugar_remi'];
                } else {     
                    return '<i class="fa fa-close text-danger">';
                }
            }
        },
        {
            "data": "cer_salario",
            "render": function(a, b, c) {
                if (c['cer_salario'] == 1) {
                    return '<i class="fa-solid fa-check text-success">';
                } else {     
                    return '<i class="fa fa-close text-danger">';
                }
            }
        },
        {
            "data": "cer_varia",
            "render": function(a, b, c) {
                if (c['cer_varia'] == 1) {
                    return '<i class="fa-solid fa-check text-success">';
                } else {     
                    return '<i class="fa fa-close text-danger">';
                }
            }
        },
        {
            "data": "cer_rodam",
            "render": function(a, b, c) {
                if (c['cer_rodam'] == 1) {
                    return '<i class="fa-solid fa-check text-success">';
                } else {     
                    return '<i class="fa fa-close text-danger">';
                }
            }
        },
        {
            "data": "cer_sinsal",
            "render": function(a, b, c) {
                if (c['cer_sinsal'] == 1) {
                    return '<i class="fa-solid fa-check text-success">';
                } else {     
                    return '<i class="fa fa-close text-danger">';
                }
            }
        }
        ],
        order: [[ 0, 'desc' ]],
    });
    
}
function serverSideCerti_Personal(numTable) {
    new DataTable('#tableCerti_Personal', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/serversideCerti_Personal.php',
            "type": "POST",
            "data": function (d) {
                d.numTable = numTable
            }
        },
        "columns": [{
            "data": "id_usu"
        },
        {
            "data": "nom_usu"
        },
        {
            "data": "nom_carg"
        },
        {
            "data": "fec_firm"
        },
        {
            "data": "tip_contrato"
        },
        {
            "data": null,
            "orderable": false,
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                    if(numTable==1){
                        dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarInd(34,'+"'Actualización Usuario'"+','+"'../certificados/form2.php'"+','+c['id_usu']+','+"'form-actUs'"+','+"'certificados'"+','+"'tabla2.php'"+');"><i class="	fa fa-history me-2"></i> Actualizar</a>';
                        dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarInd(33,'+"'Certificaciones'"+','+"'../certificados/form.php'"+',' +c['id_usu']+','+"'form-cert'"+','+"'certificados'"+','+"'tabla2.php'"+');"><i class="fa-solid fa-check me-2"></i> Certificado</a>'
                    } else{
                        dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalLarge" onclick="editarCert('+c['id_usu']+','+"'certificados'"+','+"'tabla.php'"+');"><i class="fa-solid fa-check me-2"></i> Certificado</a>'
                    }
                dropdown += '</div></div>';
                return dropdown;
            }  
            
        }
        ],
        order: [[ 3, 'desc' ]],
    });
}
function serverSideDiligencias(num_lid) {
    var table = new DataTable('#tableDiligencias', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/serversideDiligencias.php',
            "type": "POST",
            "data" : function (d) {
                if($('#estado').val() != "Todas"){
                    d.est_dlg = $('#estado').val();
                }
                d.dia_dlg = $('input[name="inlineRadioOptions"]:checked').val();
                d.reg =$('#reg').val();
            }
        },
        "columns": [{
            "data": "num_dlg"
        },
        {
            "data": "nom_cli"
        },
        {
            "data": "dia_dlg"
        },
        {
            "data": "dir_dlg"
        },
        {
            "data": "nom_tip_dlg"
        },
        {
            "data": "dil_des"
        },
        {
            "data": "nom_est_dlg",
            "render": function(a, b, c) {
                if (c['nom_est_dlg'] == "Nueva") {
                    return '<span class="badge  bg-label-primary">'+c['nom_est_dlg']+'</span>';
                } else if(c['nom_est_dlg'] == "En ruta"){
                    return '<span class="badge  bg-label-info">'+c['nom_est_dlg']+'</span>';
                } else if(c['nom_est_dlg'] == "Pendiente"){
                    return '<span class="badge  bg-label-warning">'+c['nom_est_dlg']+'</span>';
                } else {     
                    return '<span class="badge  bg-label-success">'+c['nom_est_dlg']+'</span>';
                }
            }
        },
        {
            "data": "nom_reg"
        },
        {
            "data": "nom_res"
        },
        {
            "data": null,
            "orderable": false,
            "render": function (a, b, c) {
                if (c["est_dlg"] == 1 || c["est_dlg"] == 3) {
                    dropdown = '<div class="dropdown"><button type="button" class="btn btn-sm btn-secondary' ;
                        
                    dropdown += '" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                    dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                    dropdown += '<a onclick="actualizarDilg('+ c["num_dlg"] +');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square"></i> Editar</a>';
                    if (c["est_dlg"] == 1  &&  (num_lid== 1 ||num_lid== 2)) {
                        dropdown += ' <a href="#" onclick="eliminarDil('+ c["num_dlg"] +');" class="btn btn-link dropdown-item" ><i class="fa-solid fa-eraser"></i> Eliminar</a>';
                    } 
                    dropdown += '</div></div>';
                    return dropdown;
                } else{
                    button = '<button class="btn btn-info" type="button" onclick="mostrarDil('+ c["num_dlg"] +');" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa fa-file"></i></button>';
                    return button;
                }
            }  
            
        }
        ],
        order: [[ 0, 'desc' ]],
    });
}
function serverSideEnrutamientos() {
    new DataTable('#tableEnrutamientos', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/serversideEnrutamientos.php',
            "type": "POST",
        },
        "columns": [{
            "data": "num_enr"
        },
        {
            "data": "fec_crea"
        },
        {
            "data": "usu_upt"
        },
        {
            "data": "lst_upt"
        },
        {
            "data": "est_enr",
            "render": function(a, b, c) {
                if (c['est_enr'] == "EFECTIVA") {
                    return '<span class="badge  bg-label-success">'+c['est_enr']+'</span>';
                } else if(c['est_enr'] == "EN RUTA"){
                    return '<span class="badge  bg-label-info">'+c['est_enr']+'</span>';
                } else if(c['est_enr'] == "NUEVA"){
                    return '<span class="badge  bg-label-primary">'+c['est_enr']+'</span>';
                } else {     
                    return '<span class="badge  bg-label-danger">'+c['est_enr']+'</span>';
                }
            }
        },
        {
            "data": "nom_reg"
        },
        {
            "data": null,
            "render": function (a, b, c) {
                if (c["est_enr"] == "EN RUTA" || c["est_enr"] == "NUEVA") {
                    dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                    dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                        if(c["est_enr"] == "NUEVA"){
                            dropdown += ' <a onclick="imrpimirEnrutamiento('+c['num_enr']+');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa fa-print me-2"></i> Imprimir</a>';
                            dropdown += '<a onclick="eliminarEnrut('+c['num_enr']+');" class="btn btn-link dropdown-item"><i class="fa-solid fa-eraser me-2"></i> Eliminar</a>'
                        } else{
                            dropdown += ' <a onclick="actualizarEnrutamiento('+c['num_enr']+');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square me-2"></i> Editar</a>'
                        }
                    dropdown += '</div></div>';
                    return dropdown;
                }
                else{
                    return '<button class="btn btn-info" type="button" onclick="mostrarEnrutamiento('+c['num_enr']+');" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-regular fa-file"></i></button>'
                }
            }  
        },  
        ],
        order: [[ 0, 'desc' ]],
    });
}
function serverSideVisitas() {
    new DataTable('#tableVisitas', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/serversideVisitas.php',
            "type": "POST",
        },
        "columns": [{
            "data": "fec_vis"
        },
        {
            "data": "id_per"
        },
        {
            "data": "nom_per"
        },
        {
            "data": "emp_per"
        },
        {
            "data": "fec_sal",
            "render": function (a, b, c) {
                if (c["fec_sal"] == "Sin registrar") {
                    return '<span class="badge  bg-label-danger">'+c['fec_sal']+'</span>';
                }
                else{
                    return c['fec_sal'];
                }
            }  
        },
        {
            "data": "nom_are"
        },
        {
            "data": "fot_vis", 
            "render": function (a, b, c) {
                return '<td><img width="80" src="../../documentos/visitas/'+c['fot_vis']+'"></td>';
            }              
        },
        {
            "data": "doc_induccion", 
            "render": function(a, b, c) {
                if (c['doc_induccion'] != null) {
                    return ' <div><a class="fs-3 text-mq" href="../../documentos/visitas/encuesta/' + c['doc_induccion'] + '" target="_blank"><i class="fa-solid fa-file-pdf"></i></a></div>';
                } else {     
                    return '<p>--</p>';
                }
            } 
               
        },
        {
            "data": null,
            "class": "table-td-sm",
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                if(c["fec_sal"] == 'Sin registrar'){
                    dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#smallModal" onclick="actualizarVisita('+c['id_vis']+');"><i class="fa-solid fa-clock me-2"></i>Dar Salida</a>';
                }
                dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="actualizarVisitante('+c['id_per']+','+"'tabla.php'"+');"><i class="fa-solid fa-pen-to-square me-2"></i>Editar Visitante</a>';
                dropdown += '</div></div>';
                return dropdown;
            }  
        },
        ],
        order: [[ 0, 'desc' ]],
    });
}
function serverSideVisitantes() {
    new DataTable('#tableVisitas2', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/serversideVisitantes.php',
            "type": "POST",
        },
        "columns": [{
            "data": "id_per"
        },
        {
            "data": "nom_per"
        },
        {
            "data": "emp_per"
        },
        {
            "data": "eps_per"
        },
        {
            "data": "arl_per"
        },
        {
            "data": "tel_per"
        },
        {
            "data": "con_per"
        },
        {
            "data": "tel_con"
        },
        {
            "data": null,
            "class": "table-td-sm",
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="actualizarVisitante('+c['id_per']+','+"'tabla2.php'"+');"><i class="fa-solid fa-pen-to-square me-2"></i>Editar</a>';
                dropdown += '</div></div>';
                return dropdown;
            }  
        },
        ],
        order: [[ 1, 'asc' ]],
    });
}
function serverSideCargos() {
    new DataTable('#tablePersonal3', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/serversideCargos.php',
            "type": "POST",
        },
        "columns": [{
            "data": "id_carg"
        },
        {
            "data": "nom_carg"
        },
        {
            "data": "rec_car",
            "render": function (a, b, c) {
                if (c['rec_car'] != '') {
                    return c['rec_car'];
                }
                else{
                    return '<p>--</p>';
                }
            }
        },
        {
            "data": "ent_car",
            "render": function (a, b, c) {
                if (c['ent_car'] != '') {
                    return c['ent_car'];
                }
                else{
                    return '<p>--</p>';
                }
            }
        },
        {
            "data": "pru_car",
            "render": function (a, b, c) {
                if (c['pru_car'] != '') {
                    return c['pru_car'];
                }
                else{
                    return '<p>--</p>';
                }
            }
        },
        {
            "data": "ana_car",
            "render": function (a, b, c) {
                if (c['ana_car'] != '') {
                    return c['ana_car'];
                }
                else{
                    return '<p>--</p>';
                }
            }
        },
        {
            "data": "pol_car",
            "render": function (a, b, c) {
                if (c['pol_car'] != '') {
                    return c['pol_car'];
                }
                else{
                    return '<p>--</p>';
                }
            }
        },
        {
            "data": "exa_car",
            "render": function (a, b, c) {
                if (c['exa_car'] != '') {
                    return c['exa_car'];
                }
                else{
                    return '<p>--</p>';
                }
            }
        },
        {
            "data": "tot_car",  
            "class": "table-info",
            "render": function (a, b, c) {
                if (c['tot_car'] != '') {
                    return c['tot_car'];
                }
                else{
                    return '<p>--</p>';
                }
            }
        },
        ],
        order: [[ 1, 'asc' ]],
    });
    
}
function serverSideEventos() {
    new DataTable('#tableActividades', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/serversideEventos.php',
            "type": "POST"
        },
        "columns": [{
            "data": "id_act"
        },
        {
            "data": "mes_act"
        },
        {
            "data": "nom_act"
        },
        {
            "data": "nom_usu"
        },
        {
            "data": "cum_act",
            "render": function(a, b, c){
                cumplimiento = '<label';
                if( c['cum_act'] == "Si"){
                    cumplimiento +=' disabled class="btn btn-success btn-raised" ';
                } cumplimiento += 'class="btn btn-default"> <input type="radio" name="cum_act '+c['id_act']+' " value="Si" ';
                if(c['cum_act'] == "Si" ){
                    cumplimiento += 'checked';
                }else{
                    cumplimiento +='onclick="cumplirAct('+c['id_act']+')"';
                } cumplimiento += '>Si </label>';
                cumplimiento += '<label';
                if(c['cum_act'] == "No"){
                    cumplimiento += ' class="btn btn-danger btn-raised"';
                }else if(c['cum_act']== "Si"){
                    cumplimiento += 'disable style="display:none;"';
                } cumplimiento += 'class="btn btn-default"> <input type="radio" name="cum_act '+c['id_act']+' " value="No" ';
                if(c['cum_act']== "No"){
                    cumplimiento += 'checked';
                } cumplimiento += '>No </label>';
                return cumplimiento;
            }
        },
        {
            "data": null,
            "class": "table-td-sm",
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                dropdown += '<a onclick="editarInd(21,'+"'Actualizar Actividad'"+','+"'../eventos/form1.php'"+','+c['id_act']+','+"'form-act'"+','+"'eventos'"+','+"'tabla.php'"+');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square"></i> Editar</a>';
                dropdown += '</div></div>';
                return dropdown;
            }  
        },
        ],
        order: [[ 0, 'desc' ]],
    });
}
function serverSideCapacitaciones() {
    
    new DataTable('#tableCapacitaciones', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/serversideEve_Capacitaciones.php',
            "type": "POST" 
        },
        "columns": [{
            "data": "id_cap"
        },
        {
            "data": "lug_cap"
        },
        {
            "data": "tip_cap"
        },
        {
            "data": "obj_cap"
        },
        {
            "data": "tem_cap"
        },
        {
            "data": "resp_cap"  
        },
        {
            "data": "nom_are"  
        },
        {
            "data": "fec_cap" 
        },
        {
            "data": "eva_cap"  
        },
        {
            "data": "real_cap"  
        },
        {
            "data": "nom_usu"
        },
        {
            "data": null,
            "class": "table-td-sm",
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                dropdown += '<a onclick="editarInd(23,'+"'Actualizar Actividad'"+','+"'../eventos/form2.php'"+','+c['id_cap']+','+"'form-cap'"+','+"'eventos'"+','+"'tabla2.php'"+');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square"></i> Editar</a>';
                dropdown += '</div></div>';
                return dropdown;
            } 
              
        },
        ],
        order: [[ 0, 'desc' ]],
        
    });
}; 
function serverSideCreditos(table, option, rol) {
    if(table == 1){
        new DataTable('#tableCredito', {
            "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '../serverside/serversideCreditos.php',
                "type": "POST",
                "data": function (d) {
                    d.numTable = table,
                    d.option = option
                }
            },
            "columns": [{
                "data": "id_sol"
            },
            {
                "data": "nom_cli"
            },
            {
                "data": "nom_cont"
            },
            {
                "data": "fec_sol"
            },
            {
                "data": "nom_atc"
            },
            {
                "data": "nom_est",
                "render": function (a, b, c) {
                    if (c['id_est'] == 1) {
                        return '<span class="badge  bg-label-secondary">'+c['nom_est']+'</span>';
                    } else if(c['id_est'] == 2){
                        return '<span class="badge  bg-label-warning">'+c['nom_est']+'</span>';
                    } else if(c['id_est'] == 3){
                        return '<span class="badge  bg-label-success">'+c['nom_est']+'</span>';
                    } else if(c['id_est'] == 4 || c['id_est'] == 10){
                        return '<span class="badge  bg-label-danger">'+c['nom_est']+'</span>';
                    } else if(c['id_est'] == 7){
                        return '<span class="badge  bg-label-info">'+c['nom_est']+'</span>';
                    } else if(c['id_est'] == 8) {     
                        return '<span class="badge  bg-label-info">'+c['nom_est']+'</span>';
                    }
                }
            },
            {
                "data": "nom_act"
            },
            {
                "data": "nom_usu"
            },
            {
                "data": null,
                "class": "table-td-sm",
                "render": function (a, b, c) {
                    if (c['id_est'] == 1 && (rol == 200 || rol == 400)) {
                        dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                        dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                        dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="validacionEditCrm('+c['id_sol'] + ',' + c['id_cli'] + ',' + rol + ',' + c['id_est']+');"><i class="fa-solid fa-pen-to-square me-2"></i> Editar</a>';
                        dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg('+c['id_sol'] + ',' + c['id_est']+');"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>';
                        if(rol == 400 ){
                            dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="EliminarCrm('+c['id_sol']+');"><i class="fa-solid fa-eraser me-2"></i> Eliminar</a>';
                        }
                        dropdown += '</div></div>';
                    }
                    else if (c['id_est'] == 2 && (rol == 300 || rol == 400)) {
                        dropdown = '<div class="dropdown"><button type="button" class="btn btn-warning btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                        dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                        dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="EditarSol('+c['id_sol'] + ',' + c['id_cli'] + ',' + rol + ',' + c['id_est'] +');"><i class="fa-solid fa-pen-to-square me-2"></i> Editar</a>';
                        dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg('+c['id_sol'] + ',' +c['id_est']+');"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>';
                        if(rol == 400 ){
                            dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="EliminarCrm('+c['id_sol']+');"><i class="fa-solid fa-eraser me-2"></i> Eliminar</a>';
                        }
                        dropdown += '</div></div>';
                    }
                    else if (c['id_est'] == 4 && (rol == 100 || rol == 400 || rol == 500)) {
                        dropdown = '<div class="dropdown"><button type="button" class="btn btn-danger btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                        dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                        dropdown += '<a class="btn btn-link dropdown-item" onclick="mostrarSeg('+c['id_sol'] + ',' +c['id_est']+ ');" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>';
                        dropdown += '<a class="btn btn-link dropdown-item" onclick="confirmacionCorreo(';
                        if (c["eml_enviado"] == 1) {
                            dropdown += '2';
                        } else {
                            dropdown += '1';
                        }
                        dropdown += ','+ c['id_sol'] + ',' + c['id_cli']+');" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-envelope me-2"></i>';
                        if (c["eml_enviado"] == 1) {
                            dropdown += ' Reenviar ';
                        } else {
                            dropdown += ' Enviar ';
                        }
                        dropdown += 'Correo</a>';
                        dropdown += '<a class="btn btn-link dropdown-item" onclick="mostrarCrm('+c['id_sol'] + ',' +c['id_est']+');" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa fa-tasks me-2"></i> Formulario</a>';
                        if(rol == 400 ){
                            dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="EliminarCrm('+c['id_sol']+');"><i class="fa-solid fa-eraser me-2"></i> Eliminar</a>';
                        }
                        dropdown += '</div></div>';
                    }
                    else if (c['id_est'] == 7 && (rol == 100 || rol == 400 || rol == 500)) {
                        dropdown = '<div class="dropdown"><button type="button" class="btn btn-info btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                        dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                        dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="actualizaCrm('+c['id_sol'] + ',' +c['id_est']+');"><i class="fa-solid fa-pen-to-square me-2"></i> Editar</a>';
                        dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg('+c['id_sol'] + ',' +c['id_est']+');"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>';
                        if(rol == 400 ){
                            dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="EliminarCrm('+c['id_sol']+');"><i class="fa-solid fa-eraser me-2"></i> Eliminar</a>';
                        }
                        dropdown += '</div></div>';
                    }
                    else if (c['id_est'] == 8 && (rol == 200 || rol == 400)) {
                        dropdown = '<div class="dropdown"><button type="button" class="btn btn-info btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                        dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                        dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="actualizar1Crm('+c['id_sol'] + ',' + c['id_est']+','+ rol +');"><i class="fa-solid fa-pen-to-square me-2"></i> Editar</a>';
                        dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg('+c['id_sol'] + ',' + c['id_est']+');"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>';
                        if(rol == 400 ){
                            dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="EliminarCrm('+c['id_sol']+');"><i class="fa-solid fa-eraser me-2"></i> Eliminar</a>';
                        }
                        dropdown += '</div></div>';
                    }
                    else {
                        dropdown = '<div class="dropdown"><button type="button" class="btn btn-'; 
                        if (c["id_est"] == 1) {
                            dropdown += 'secondary';
                        } else if (c["id_est"] == 2) {
                            dropdown += 'warning';
                        } else if (c["id_est"] == 3) {
                            dropdown += 'success';
                        } else if (c["id_est"] == 4) {
                            dropdown += 'danger';
                        } else {
                            dropdown += 'info';
                        } 
                        dropdown += ' btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                        dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                        dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg('+c['id_sol'] + ',' +c['id_est']+');"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>';
                        dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="mostrarCrm('+c['id_sol'] + ',' +c['id_est']+');"><i class="fa fa-tasks me-2"></i> Formulario</a>';
                        dropdown += '</div></div>';
                    }
                    
                    return dropdown;
                }  
            },
            ],
            order: [[ 0, 'desc' ]],
        });
    } else if (table == 2){
        new DataTable('#tableCredito2', {
            "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '../serverside/serversideCreditos.php',
                "type": "POST",
                "data": function (d) {
                    d.numTable = 2,
                    d.option = option
                }
            },
            "columns": [{
                "data": "id_sol"
            },
            {
                "data": "nom_cli"
            },
            {
                "data": "nom_cont"
            },
            {
                "data": "fec_sol"
            },
            {
                "data": "nom_atc"
            },
            {
                "data": "id_est"
            },
            {
                "data": "nom_act"
            },
            {
                "data": "nom_usu"
            },
            {
                "data": null,
                "class": "table-td-sm",
                "render": function (a, b, c) {
                    dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                    dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                    dropdown += '</div></div>';
                    return dropdown;
                }  
            },
            ],
            order: [[ 0, 'desc' ]],
        });
    } else if (table == 3){
        new DataTable('#tableCredito3', {
            "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '../serverside/serversideCreditos.php',
                "type": "POST",
                "data": function (d) {
                    d.numTable = 1,
                    d.option = option
                }
            },
            "columns": [{
                "data": "id_sol"
            },
            {
                "data": "nom_cli"
            },
            {
                "data": "nom_cont"
            },
            {
                "data": "fec_sol"
            },
            {
                "data": "nom_est",
                "render": function (a, b, c) {
                    if (c['id_est'] == 1) {
                        return '<span class="badge  bg-label-secondary">'+c['nom_est']+'</span>';
                    } else if(c['id_est'] == 2){
                        return '<span class="badge  bg-label-warning">'+c['nom_est']+'</span>';
                    } else if(c['id_est'] == 3){
                        return '<span class="badge  bg-label-success">'+c['nom_est']+'</span>';
                    } else if(c['id_est'] == 4 || c['id_est'] == 10){
                        return '<span class="badge  bg-label-danger">'+c['nom_est']+'</span>';
                    } else if(c['id_est'] == 7){
                        return '<span class="badge  bg-label-info">'+c['nom_est']+'</span>';
                    } else if(c['id_est'] == 8) {     
                        return '<span class="badge  bg-label-info">'+c['nom_est']+'</span>';
                    }
                }
            },
            {
                "data": "nom_act"
            },
            {
                "data": "nom_usu"
            },
            {
                "data": null,
                "class": "table-td-sm",
                "render": function (a, b, c) {
                    if (c['id_est'] == 1 && (rol == 200 || rol == 400)) {
                        dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                        dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                        dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg('+c['id_sol'] + ',' + c['id_est']+');"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>';
                        if(rol == 400 ){
                            dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="EliminarCrm('+c['id_sol']+');"><i class="fa-solid fa-eraser me-2"></i> Eliminar</a>';
                        }
                        dropdown += '</div></div>';
                    }
                    else if (c['id_est'] == 2 && (rol == 300 || rol == 400)) {
                        dropdown = '<div class="dropdown"><button type="button" class="btn btn-warning btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                        dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                        dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg('+c['id_sol'] + ',' +c['id_est']+');"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>';
                        if(rol == 400 ){
                            dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="EliminarCrm('+c['id_sol']+');"><i class="fa-solid fa-eraser me-2"></i> Eliminar</a>';
                        }
                        dropdown += '</div></div>';
                    }
                    else if (c['id_est'] == 4 && (rol == 100 || rol == 400 || rol == 500)) {
                        dropdown = '<div class="dropdown"><button type="button" class="btn btn-danger btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                        dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                        dropdown += '<a class="btn btn-link dropdown-item" onclick="mostrarSeg('+c['id_sol'] + ',' +c['id_est']+ ');" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>';
                        dropdown += '<a class="btn btn-link dropdown-item" onclick="confirmacionCorreo(';
                        if (c["eml_enviado"] == 1) {
                            dropdown += '2';
                        } else {
                            dropdown += '1';
                        }
                        dropdown += ','+ c['id_sol'] + ',' + c['id_cli']+');" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-envelope me-2"></i>';
                        if (c["eml_enviado"] == 1) {
                            dropdown += ' Reenviar ';
                        } else {
                            dropdown += ' Enviar ';
                        }
                        dropdown += 'Correo</a>';
                        dropdown += '<a class="btn btn-link dropdown-item" onclick="mostrarCrm('+c['id_sol'] + ',' +c['id_est']+');" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa fa-tasks me-2"></i> Formulario</a>';
                        if(rol == 400 ){
                            dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="EliminarCrm('+c['id_sol']+');"><i class="fa-solid fa-eraser me-2"></i> Eliminar</a>';
                        }
                        dropdown += '</div></div>';
                    }
                    else if (c['id_est'] == 7 && (rol == 100 || rol == 400 || rol == 500)) {
                        dropdown = '<div class="dropdown"><button type="button" class="btn btn-info btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                        dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                        dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg('+c['id_sol'] + ',' +c['id_est']+');"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>';
                        if(rol == 400 ){
                            dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="EliminarCrm('+c['id_sol']+');"><i class="fa-solid fa-eraser me-2"></i> Eliminar</a>';
                        }
                        dropdown += '</div></div>';
                    }
                    else if (c['id_est'] == 8 && (rol == 200 || rol == 400)) {
                        dropdown = '<div class="dropdown"><button type="button" class="btn btn-info btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                        dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                        dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg('+c['id_sol'] + ',' + c['id_est']+');"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>';
                        if(rol == 400 ){
                            dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="EliminarCrm('+c['id_sol']+');"><i class="fa-solid fa-eraser me-2"></i> Eliminar</a>';
                        }
                        dropdown += '</div></div>';
                    }
                    else {
                        dropdown = '<div class="dropdown"><button type="button" class="btn btn-'; 
                        if (c["id_est"] == 1) {
                            dropdown += 'secondary';
                        } else if (c["id_est"] == 2) {
                            dropdown += 'warning';
                        } else if (c["id_est"] == 3) {
                            dropdown += 'success';
                        } else if (c["id_est"] == 4) {
                            dropdown += 'danger';
                        } else {
                            dropdown += 'info';
                        } 
                        dropdown += ' btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                        dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                        dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg('+c['id_sol'] + ',' +c['id_est']+');"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>';
                        dropdown += '<a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="mostrarCrm('+c['id_sol'] + ',' +c['id_est']+');"><i class="fa fa-tasks me-2"></i> Formulario</a>';
                        dropdown += '</div></div>';
                    }
                    
                    return dropdown;
                }  
            },
            ],
            order: [[ 0, 'desc' ]],
        });
    }
   
}
function serverSideLiquidacion(){
    var table = new DataTable('#tablePagos2', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/serversideLiquidacion.php',
            "type": "POST",
            "data" : function (d) {
                if($('#mesliq').val() != null ){
                    d.fech_liqui =$('#mesliq').val();
                }
                }
                
        },
        "columns": [{
            "data": "id_liqui"
        },
        {
            "data": "nom_usu"
        },
        {
            "data": "nom_are"
        },
        {
            "data": "nom_liqui"
        },
        {
            "data": "fec_ret"
        },
        {
            "data": "fech_ref"
        },
        {
            "data": "fech_pag",
            "render":function(a,b,c){
                if(c['fech_pag'] == null){
                    return "<p>--</p>";
                }else{
                    return c['fech_pag'];
                }
            }
        },
        {
            "data": "dias_habiles",
            "render":function(a,b,c){
                if(c['dias_habiles'] == null){
                    return "<p>--</p>";
                } else {
                    return c['dias_habiles'];
                }
            }
        },
        {
            "data": null,
            "class": "table-td-sm",
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                if(c['fech_pag'] == null){
                    dropdown +='<a onclick="editarInd(17,'+"'Actualizar Liquidación'"+','+"'../pagos/form6.php'"+','+c['id_liqui']+','+"'form-liqui'"+','+"'pagos'"+','+"'tabla2.php'"+');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square"></i> Editar </a>';
                }  dropdown += '</div></div>';
                return dropdown;
            }  
        },
        ],
        order: [[ 0, 'desc' ]],
    });
}
function serverSideCorrespondencia(table, option) {
    if(table == 1){
        var table = new DataTable('#tableCorrespondencia', {
            "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '../serverside/serversideCreditos.php',
                "type": "POST",
            },
            "columns": [{
                "data": "id_sol"
            },
            {
                "data": "nom_cli"
            },
            {
                "data": "nom_cont"
            },
            {
                "data": "fec_sol"
            },
            {
                "data": "nom_atc"
            },
            {
                "data": "id_est"
            },
            {
                "data": "nom_act"
            },
            {
                "data": "nom_usu"
            },
            {
                "data": null,
                "class": "table-td-sm",
                "render": function (a, b, c) {
                    dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                    dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                    dropdown += '</div></div>';
                    return dropdown;
                }  
            },
            ],
            order: [[ 1, 'asc' ]],
        });
    } else if (table == 2){
        new DataTable('#tableCredito2', {
            "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '../serverside/serversideCreditos.php',
                "type": "POST",
                "data": function (d) {
                    d.numTable = 2,
                    d.option = option
                }
            },
            "columns": [{
                "data": "id_sol"
            },
            {
                "data": "nom_cli"
            },
            {
                "data": "nom_cont"
            },
            {
                "data": "fec_sol"
            },
            {
                "data": "nom_atc"
            },
            {
                "data": "id_est"
            },
            {
                "data": "nom_act"
            },
            {
                "data": "nom_usu"
            },
            {
                "data": null,
                "class": "table-td-sm",
                "render": function (a, b, c) {
                    dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                    dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                    dropdown += '</div></div>';
                    return dropdown;
                }  
            },
            ],
            order: [[ 0, 'desc' ]],
        });
    }
   
}
function serverSideErrorNomina(){
    let rol = $('#rol').val();
    var table = new DataTable('#tablePagos3', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/serversideErrorNomina.php',
            "type": "POST",
            "data" : function (d) {
                if($('#meserror').val() != null ){
                    d.fech_erro =$('#meserror').val();
                }
                }
        },
        "columns": [{
            "data": "id_error"
        },
        {
            "data": "mes_err"
        },
        {
            "data": "fech_error"
        },
        {
            "data": "nom_pag"
        },
        {
            "data": "col_error"
        },
        {
            "data": "nom_estaErro"
        },
        {
            "data": null,
            "class": "table-td-sm",
            "render": function (a, b, c) {
                 dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                 dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                 if(c['nom_estaErro'] != "	Efectuado" && rol == 9  ){
                    dropdown +='<a onclick="editarInd(19,'+"'Actualización de Errores'"+','+"'../pagos/form7.php'"+','+c['id_error']+','+"'form-error'"+','+"'pagos'"+','+"'tabla3.php'"+');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square"></i> Editar </a>';
                    $('#alertInfo').css('display','block'); 
                    $('#content-alertInfo').html('Solo podra editar si el estado es diferente a "EFECTUADO"');
                } else {
                    $('#alertInfo').css('display','block'); 
                    $('#content-alertInfo').html('Si deseas hacer un cambio, debes comunicarte con el área de Talento Humano');
                }
                dropdown += '</div></div>';
                 return dropdown;
             }  
        },
        ],
        order: [[ 0, 'desc' ]],
    });
}
function serverSideInvProducts() {
    new DataTable('#tableInvProducts', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/inventarios/table_product.php',
            "type": "POST",
        },
        "columns": [{
            "data": "id_prod",
            "width": 30
        },
        {
            "data": 'nom_prod',
            "width": 60,
            "render": function (a, b, c) {
                return '<td><img width="80" src="../../documentos/inventarios/productos/'+c['img_prod']+'"></td>';
            }  
        },
        {
            "data": 'desc_prod',
            "render": function (a, b, c) {
                info = '<td><span class="text-mq">'+c['nom_prod']+'</span>';
                info += '<br>';
                info += '<span style="font-style: italic !important;">'+c['desc_prod']+'</span></td>';
                return info;
            } 
        },
        {
            "data": null,
            "width": 30,
            "render": function (a, b, c) {
                if(c['req_aprob']  == 1){
                    return '<i class="fa-solid fa-check fs-2 text-success"></i>';
                } else {
                    return '<i class="fa-solid fa-xmark fs-2 text-mq"></i>';
                }
                
            } 
        },
        {
            "data": null,
            "width": 10,
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="inv_modal_edit('+c['id_prod']+','+"'5'"+','+"'Editar Producto'"+','+"'../administrarInven/form2.php'"+');"><i class="fa-solid fa-pen-to-square me-2"></i>Editar</a>';
                dropdown += '<a class="btn btn-link dropdown-item" href="#" onclick="modal_deleteProd('+c['id_prod']+','+"'"+c['nom_prod']+"'"+','+"'6'"+','+"'Eliminar Producto'"+');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa fa-trash me-2"></i> Eliminar</a>';
                dropdown += '</div></div>';
                return dropdown;
            }  
        }],
        order: [
            [ 0, 'asc' ]
        ],
    });
}
function serverSideInventarioProd(products) {
    new DataTable('#tableInventarioProd', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "info": false,
        "paging": false,
        "ajax": {
            "url": '../serverside/inventarios/table_product.php',
            "type": "POST",
        },
        "columns": [{
            "data": 'nom_prod',
            "render": function (a, b, c) {
                info = '<img width="50" src="../../documentos/inventarios/productos/'+c['img_prod']+'"></img><br>';
                info += '<span>'+c['nom_prod']+'</span>';
                return info;
            }      
        },
        {
            "data": null,
            "width": 10,
            "render": function (a, b, c) {
                dropdown = '<div class="form-check">';
                dropdown += '<input class="form-check-input" type="checkbox" value="'+c['id_prod']+'" id="product'+c['id_prod']+'" name="id_products[]"';
                if(products.find(id => id.id_prod == c['id_prod']) != undefined){
                    dropdown += 'checked';
                }
                dropdown += '></div>';
                return dropdown;
            }  
        }],
        order: [
            [ 0, 'asc' ]
        ],
    });
}
function serverSideInvAreaXProd() {
    var table = new DataTable('#tableInvAreaXProd', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/inventarios/table_area_x_prod.php',
            "type": "POST",
        },
        "columns": [ {
            "width" : 5,
            "className": 'dt-control',
            "orderable": false,
            "data": null,
            "defaultContent": ''
        },
        {
            "data": "nom_are",
        }],
        order: [
            [ 0, 'asc' ]
        ],
    });
    table.on('click', 'td.dt-control', function (e) {
        let tr = e.target.closest('tr');
        let row = table.row(tr);
    
        if (row.child.isShown()) {
            row.child.hide();
        }
        else {
            row.child(format_product_area(row.data())).show();
        }
    });
}
function format_product_area(d) {
    let id = d.id.split(', ') ;
    let id_prod = d.id_products.split(', ') ;
    let nom_products = d.nombre_products.split(', ') ;
    let cant_max = d.cant_max.split(', ') ;
    let img_prod = d.img_products.split(', ') ;
           
    table = '<table class="table">';
    table += '<thead class="table-info"><tr>';
    table += '<th></th>';
    table += '<th>Productos</th>';
    table += '<th>Cantidad Máxima</th>';
    table += '<th></th>';
    table += '</tr></thead>';
    table += '<tbody class="table-group-divider">';
    
    for (let i = 0; i < id.length; i++) {
        table += '<tr>';
        table += '<td style="width:10%;"><img width="50" src="../../documentos/inventarios/productos/'+ img_prod[i] +'"></td>';
        table += '<td style="width:67%;">' + nom_products[i] + '</td>';
        table += '<td style="width:15%;"><input type="number" class="form-control" id="cant_max_'+id[i]+'_'+id_prod[i]+'" value="' + cant_max[i] + '" onchange="cant_max(' + id[i] + ', '+id_prod[i]+','+"'tableInvAreaXProd'"+');"></td>';
        table += '<td style="width:8%; text-align: center;"><a onclick="modal_delete_prod_x_are(' + id[i] + ','+"'"+nom_products[i]+"'"+','+"'9'"+','+"'Quitar Producto | Área "+d.nom_are+"'"+');" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa fa-trash text-mq fs-4"></i></a></td>';
        table += '</tr>';
    }
    table += '</tbody>';
    table += '</table>';
    return table;
;}
function serverSideInventario(reg) {
    new DataTable('#table_inventarios', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/inventarios/table_inventario.php',
            "type": "POST",
            "data" : function (d) {
                d.reg = reg;
            }
        },
        "columns": [{
            "data": null,
            "width": 60,
            "render": function (a, b, c) {
                info = '<img width="60" src="../../documentos/inventarios/productos/'+c['img_prod']+'"></img>';
                return info;
            } 
        },
        {
            "data": 'nom_prod',
        },
        {
            "data": "cantidad",
            "width": 30,
        },
        {
            "data": null,
            "width": 30,
            "render": function (a, b, c) {
                dropdown = '<div>';
                dropdown += '<input type="number" class="form-control" id="new_cant'+c['id_inv']+'" name="new_cant'+c['id_inv']+'" onchange="new_cant_prod('+"'"+c['id_inv']+"'"+', '+"'table_inventarios'"+');">';
                dropdown += '</div>';
                return dropdown;
            }  
        }],
        order: [
            [ 0, 'asc' ]
        ],
    });
}
function serverSideSolicitudInv(reg, area) {
    var table = new DataTable('#tableSolicitudInv', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "info": false,
        "paging": false,
        "ajax": {
            "url": '../serverside/inventarios/table_inventario_x_area.php',
            "type": "POST",
            "data" : function (d) {
                d.reg = reg;
                d.are = area;
            }
        },
        "columns": [{
            "data": null,
            "width": 30,
            "render": function (a, b, c) {
                info = '<img width="70" src="../../documentos/inventarios/productos/'+c['img_prod']+'"></img><br>';
                return info;
            }      
        },
        {
            "data": 'nom_prod'
        },
        {
            "data": "can_max",
        },
        {
            "data": null,
            "render": function (a, b, c) {
                button = '<button class="btn_elim_prod btn btn-warning btn-sm btn-circle" type="button"><i class="fa-solid fa-minus"></i></button>';
                return button;
            }  
        },
        {
            "data": null,
            "render": function (a, b, c) {
                input = '<input id="cont'+c['id_prod']+'" class="form-control form-control-md" style="text-align: center;" name="cant_prod[]" value="0" readonly>';
                input += '<input type="hidden" name="id_prod[]" value="'+c['id_prod']+'">';
                return input;
            }  
        },
        {
            "data": null,
            "render": function (a, b, c) {
                button = '<button class="btn_add_prod btn btn-success btn-circle" type="button"><i class="fa-solid fa-plus"></i></button>';
                return button;
            }  
        }],
        order: [
            [ 0, 'asc' ]
        ],
    });
       
    $('#tableSolicitudInv tbody').on('click', '.btn_add_prod', function() {
        //console.log(table.row($(this).parents('tr')).data());
        var row = table.row($(this).parents('tr')).data();
        console.log(row.can_max +"; "+ row.id_prod);
        let input = document.getElementById('cont'+row.id_prod);
        console.log(input.value < row.can_max);
        if(parseInt(input.value) < parseInt(row.can_max)){
            input.value++;
            let prod_new_cant = {
                'id_prod' : row.id_prod,
                'nom_prod' : row.nom_prod,
                'img_prod' : row.img_prod,
                'cantidad' : input.value
            }
            product_exist = products.findIndex((obj => obj.id_prod == row.id_prod));
            if (product_exist != -1){
                products[product_exist].cantidad = input.value;
            } else{
                products.push(prod_new_cant);
            }
            if (products.length > 0 && document.getElementById('id_usu').value != ' '){
                document.getElementById('adm_inv').removeAttribute('disabled', true);
            }
             
            /*for(const producto of products){
                console.log(producto);
            }*/
        } else { 
            console.log(input.value < row.can_max);
            alertWarning('La cantidad a solicitar no puede exceder la cantidad máxima');
        }
       
    });
    $('#tableSolicitudInv tbody').on('click', '.btn_elim_prod', function() {
        let row = table.row($(this).parents('tr')).data();
        let input = document.getElementById('cont'+row.id_prod);
        if(parseInt(input.value) <= parseInt(row.can_max)){
            if(parseInt(input.value) > 0){
                input.value--;
                
                product_exist = products.findIndex((obj => obj.id_prod == row.id_prod));
                if (input.value != 0 && product_exist != -1) {
                    products[product_exist].cantidad = input.value; 
                } else {
                    products.splice(product_exist, 1);
                }
                /*for(const producto of products){
                    console.log(producto);
                }*/
    
                
                if (products.length == 0){
                    document.getElementById('adm_inv').setAttribute('disabled', '');
                }
            } else {
                alertWarning('La cantidad a solicitar tiene que ser mayor a 0');
            }
        } else {
            input.value = row.can_max;
        }
      
       
    });
}
function tableResumenSolInv() {
    new DataTable('#tableResumenSolInv', {
        "data": products,
        "info": false,
        "paging": false,
        "columnDefs": [
            {
                "target": 0,
                "visible": false,
                "searchable": false
            }
        ],
        "columns": [{
            "data": 'id_prod',
        },
        {
            "data": null,
            "width": 30,
            "render": function (a, b, c) {
                img = '<img width="50" src="../../documentos/inventarios/productos/'+c['img_prod']+'"></img><br>';
                return img;
            } 
        },
        {
            "data": 'nom_prod',
        },
        {
            "data": "cantidad",
            "width": 30,
        }],
        order: [
            [ 0, 'asc' ]
        ],
    });
}
function serverSideInvSolicitud(resp, opcion, rol) {
    new DataTable('#table_inv_solicitud', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/inventarios/table_inv_solicitud.php',
            "type": "POST",
            "data" : function (d) {
                d.resp = resp;
                if (resp == 1) {
                    d.id_usu = opcion;
                } else {
                    d.est_sol = opcion;
                }
            }
        },
        "columns": [ {
            "data": 'id_sol',
        },
        {
            "data": 'id_products',
            "render": function (a, b, c) {
                let img_products = c['img_products'].split(', ') ;
                let info = '<td><div class="avatar-group">';
                img_products.forEach(prueba);
                function prueba(item, index) {
                    info += '<a href="#" class="avatar-mq avatar-sm-mq" data-toggle="tooltip">';
                    info += '<img alt="Imagen Producto" src="../../documentos/inventarios/productos/'+item+'">';
                    info += '</a>';
                }
                info += '</div></td>';
                return info;
            }
        },
        {
            "data": 'nom_products',
            "render": function (a, b, c) {
                let nom_products = c['nom_products'].split(', ') ;
                let cant_products = c['cant_sol_products'].split(', ') ;
                let info = '';
                for (let i = 0; i < nom_products.length; i++) {
                    info += '- '+nom_products[i]+' ('+cant_products[i]+')<br>';
                }
                //console.log(info);
                return info;
            } 
        },
        {
            "data": "nom_est_sol",
            "render": function (a, b, c) {
                span = '<span class="rounded-pill badge bg-'+c['color_est']+'">';
                span += c['nom_est_sol'];
                span += '</span>';
                return span;
            } 
        },
        {
            "data": "fec_sol",
        },
        {
            "data": null,
            "width": 30,
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                if(resp == 1 && (c['est_sol'] == 1 || c['est_sol'] == 2)){
                    dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="solicitudInventario('+c['id_sol']+','+"'0'"+','+"'Solicitud #"+c['id_sol']+"'"+','+"'../solicitudInven/form2.php'"+');"><i class="fa-solid fa-eye me-2"></i> Ver Solicitud</a>';
                } else if(resp == 1 && (c['est_sol'] == 3 || c['est_sol'] == 4)){
                    dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="solicitudInventario('+c['id_sol']+','+"'10'"+','+"'Solicitud #"+c['id_sol']+"'"+','+"'../solicitudInven/form2.php'"+');"><i class="fa-solid fa-eye me-2"></i> Ver Solicitud</a>';
                } else if(resp == 1 && c['est_sol'] == 5){
                    dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="solicitudInventario('+c['id_sol']+','+"'11'"+','+"'Solicitud #"+c['id_sol']+"'"+','+"'../solicitudInven/form2.php'"+');"><i class="fa-solid fa-eye me-2"></i> Ver Solicitud</a>';
                } else if(resp == 2 && c['est_sol'] == 1 && rol == 2){
                    dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="solicitudInventario('+c['id_sol']+','+"'4'"+','+"'Solicitud #"+c['id_sol']+"'"+','+"'../solicitudInven/form2.php'"+');"><i class="fa-solid fa-eye me-2"></i> Ver Solicitud</a>';
                } else if(resp == 2 && c['est_sol'] == 2 && rol == 2){
                    dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="solicitudInventario('+c['id_sol']+','+"'7'"+','+"'Solicitud #"+c['id_sol']+"'"+','+"'../solicitudInven/form2.php'"+');"><i class="fa-solid fa-eye me-2"></i> Ver Solicitud</a>';
                } else if(resp == 2 && c['est_sol'] == 4 && rol == 2){
                    dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="solicitudInventario('+c['id_sol']+','+"'4.1'"+','+"'Solicitud #"+c['id_sol']+"'"+','+"'../solicitudInven/form2.php'"+');"><i class="fa-solid fa-eye me-2"></i> Ver Solicitud</a>';
                }
                dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="seguimientoSolInv('+c['id_sol']+','+"'Seguimiento de Solicitud | Inventarios'"+','+"'../solicitudInven/seguimiento.php'"+');"><i class="fa-solid fa-chart-line me-2"></i> Seguimiento</a>';
                if(rol == 2){
                    dropdown += '<a class="btn btn-link dropdown-item" href="#" onclick="modal_delete_sol('+c['id_sol']+','+"'3'"+','+"'Eliminar Solicitud'"+');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa fa-trash me-2"></i> Eliminar</a>';
                }

                dropdown += '</div></div>';
                return dropdown;
            }  
        }],
        order: [
            [ 0, 'desc' ]
        ],
    });
}
function serverSideInvSolHist() {
    new DataTable('#table_inv_sol_hist', {
        "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/inventarios/table_inv_solicitud.php',
            "type": "POST",
            "data" : function (d) {
                d.resp = 3;
                d.est_sol = $('#est_sol').val();
                d.fecha1 =$('#fecha1').val();
                d.fecha2 =$('#fecha2').val();
                d.empleado_mq =$('#empleado_mq').val();               
            }
        },
        "columns": [ {
            "data": 'id_sol',
        },
        {
            "data": 'id_products',
            "render": function (a, b, c) {
                let img_products = c['img_products'].split(', ') ;
                let info = '<td><div class="avatar-group">';
                img_products.forEach(prueba);
                function prueba(item, index) {
                    info += '<a href="#" class="avatar-mq avatar-sm-mq" data-toggle="tooltip">';
                    info += '<img alt="Imagen Producto" src="../../documentos/inventarios/productos/'+item+'">';
                    info += '</a>';
                }
                info += '</div></td>';
                return info;
            }
        },
        {
            "data": 'nom_products',
            "render": function (a, b, c) {
                let nom_products = c['nom_products'].split(', ') ;
                let cant_products = c['cant_sol_products'].split(', ') ;
                let info = '';
                for (let i = 0; i < nom_products.length; i++) {
                    info += '- '+nom_products[i]+' ('+cant_products[i]+')<br>';
                }
                //console.log(info);
                return info;
            } 
        },
        {
            "data": "nom_est_sol",
            "render": function (a, b, c) {
                span = '<span class="rounded-pill badge bg-'+c['color_est']+'">';
                span += c['nom_est_sol'];
                span += '</span>';
                return span;
            } 
        },
        {
            "data": "fec_sol",
        },
        {
            "data": "nom_usu",
        },
        {
            "data": null,
            "width": 30,
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                if(c['est_sol'] == 1 || c['est_sol'] == 2){
                    dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="solicitudInventario('+c['id_sol']+','+"'0'"+','+"'Solicitud #"+c['id_sol']+"'"+','+"'../solicitudInven/form2.php'"+');"><i class="fa-solid fa-eye me-2"></i> Ver Solicitud</a>';
                } else if(c['est_sol'] == 3 || c['est_sol'] == 4){
                    dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="solicitudInventario('+c['id_sol']+','+"'10'"+','+"'Solicitud #"+c['id_sol']+"'"+','+"'../solicitudInven/form2.php'"+');"><i class="fa-solid fa-eye me-2"></i> Ver Solicitud</a>';
                } else if(c['est_sol'] == 5){
                    dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="solicitudInventario('+c['id_sol']+','+"'11'"+','+"'Solicitud #"+c['id_sol']+"'"+','+"'../solicitudInven/form2.php'"+');"><i class="fa-solid fa-eye me-2"></i> Ver Solicitud</a>';
                } 
                dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="seguimientoSolInv('+c['id_sol']+','+"'Seguimiento de Solicitud | Inventarios'"+','+"'../solicitudInven/seguimiento.php'"+');"><i class="fa-solid fa-chart-line me-2"></i> Seguimiento</a>';
                dropdown += '<a class="btn btn-link dropdown-item" href="#" onclick="modal_delete_sol('+c['id_sol']+','+"'3'"+','+"'Eliminar Solicitud'"+');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa fa-trash me-2"></i> Eliminar</a>';
                dropdown += '</div></div>';
                return dropdown;
            }  
        }],
        order: [
            [ 0, 'desc' ]
        ],
    });
}
function bodyInvSolDetallada(ajaxData, columns, columnDefs){
    var table = {
        language: {
            url: "../../resources/utils/datatables/spanish.lang.json"
        },
        processing: true,
        serverSide: true,
        info: false,
        paging: false,
        ajax: {
            url: '../serverside/inventarios/table_inv_sol_detallada.php',
            type: "POST",
            data : ajaxData
        },
        order: [
            [ 0, 'asc' ]
        ]
    };
    if(columns != ''){
        table.columns = columns;
    }
    if(columnDefs != ''){
        table.columnDefs = columnDefs;
    }
    return new DataTable('#table_prod_sol', table);
}
function tableInvSolResp(id_sol) {
    let ajaxData = function (d) {
        d.resp = 1;
        d.id_sol = id_sol;
    }
    let columns = [{
        "data": 'id_prod',
        "width": 30,
        "render": function (a, b, c) {
            info = '<img width="70" src="../../documentos/inventarios/productos/'+c['img_prod']+'"></img><br>';
            return info;
        }      
    },
    {
        "data": 'nom_prod'
    },
    {
        "data": "cant_sol",
    },
    {
        "data": "entregado",
    },
    {
        "data": "aprob_prod",
        "render": function (a, b, c) {
            let color = '';
            let text = '';
            if(c['aprob_prod'] == 0){
                color = 'info';
                text = 'No requiere';
            } else if(c['aprob_prod'] == 1){
                color = 'warning';
                text = 'Pendiente por aprobar';
            } else if(c['aprob_prod'] == 2){
                color = 'success';
                text = 'Aprobado';
            } else if(c['aprob_prod'] == 3){
                color = 'danger';
                text = 'Rechazado';
            }
            span = '<span class="rounded-pill badge bg-'+color+'">';
            span += text;
            span += '</span>';
            return span;
        } 
    }];
    let table = bodyInvSolDetallada(ajaxData, columns, '');
}
function tableInvSolResp_5(id_sol) {
    let ajaxData = function (d) {
        d.resp = 2;
        d.id_sol = id_sol;
    }
    let columns = [{
        "data": 'id_prod',
        "width": 30,
        "render": function (a, b, c) {
            info = '<img width="70" src="../../documentos/inventarios/productos/'+c['img_prod']+'"></img><br>';
            return info;
        }      
    },
    {
        "data": 'nom_prod',
        "render": function (a, b, c) {
            info = c['nom_prod']+'</br><span class="text-mq" id="text-prod-'+c['id_prod']+'"></span>';
            return info;
        }  
    },
    {
        "data": "cant_sol",
    },
    {
        "data": "entregado",
        "render": function (a, b, c) {
            input = '<input type="text" style="text-align:center;" class="form-control" id="entregado'+c['id_prod']+'" name="entregado'+c['id_prod']+'" value="'+c['entregado']+'" readonly>';
            return input;
        } 
    }, 
    {
        "data": null,
    }];
    let columnDefs = [{        
        "target": [2,3],
        "width": "5%",
    },
    {
        "target": 4,
        "visible": false,
        "searchable": false
    }];
    let table = bodyInvSolDetallada(ajaxData, columns, columnDefs);
}
function tableInvSolResp_7(resp, id_sol) {
    let ajaxData = function (d) {
        d.resp = 1;
        d.id_sol = id_sol;
    }
    let columns = [{
        "data": 'id_prod',
        "width": 30,
        "render": function (a, b, c) {
            info = '<img width="70" src="../../documentos/inventarios/productos/'+c['img_prod']+'"></img><br>';
            return info;
        }      
    },
    {
        "data": 'nom_prod'
    },
    {
        "data": "cant_sol",
    },
    {
        "data": "entregado",
    },
    {
        "data": "aprob_prod",
        "render": function (a, b, c) {
            let color = '';
            let text = '';
            if(c['aprob_prod'] == 0){
                color = 'info';
                text = 'No requiere';
            } else if(c['aprob_prod'] == 1){
                color = 'warning';
                text = 'Pendiente por aprobar';
            } else if(c['aprob_prod'] == 2){
                color = 'success';
                text = 'Aprobado';
            } else if(c['aprob_prod'] == 3){
                color = 'danger';
                text = 'Rechazado';
            }
            span = '<span class="rounded-pill badge bg-'+color+'">';
            span += text;
            span += '</span>';
            return span;
        } 
    }];
    let columnDefs = [{
        "target": 3,
        "visible": false,
        "searchable": false
    }];
    let table = bodyInvSolDetallada(ajaxData, columns, columnDefs);
    table.on('click', 'tr', function (e) {
        let tr = e.target.closest('tr');
        let row = table.row(tr);
        var data = row.data();

        if(data.aprob_prod == 1 || resp == 7.1){
            products = [];
            e.currentTarget.classList.toggle('selected');
            var rows_select = table.rows('.selected').data();
            for (let i = 0; i < rows_select.length; i++) {
                let prod_new_cant = {
                    'id_prod' : rows_select[i].id_prod,
                    'id_sol' : rows_select[i].id_sol
                }
                products.push(prod_new_cant);
            }
            
        }

        if(resp == 7){
            var btn_aprobar = document.getElementById('btn_aprob_prod');
            var btn_rechazar = document.getElementById('btn_rechazar_prod');
            if(products.length === 0){
                btn_aprobar.setAttribute('disabled', true);
                btn_rechazar.setAttribute('disabled', true);
            } else {
                btn_aprobar.removeAttribute('disabled', '');
                btn_rechazar.removeAttribute('disabled', '');
            }
        }
        
    });
}
function tableInvSolResp_10_or_11(resp, id_sol) {
    let table = document.getElementById('table_prod_sol');
    table.querySelector('thead > tr > th:last-child').innerText = 'Estado';
    /*let columnNew = document.createElement('th');
    columnNew.innerText = '';
    table.querySelector('thead > tr:first-child').append(columnNew);*/
    let ajaxData = function (d) {
        d.resp = 1;
        d.id_sol = id_sol;
    }
    let columns = [{
        "data": 'id_prod',
        "width": 30,
        "render": function (a, b, c) {
            info = '<img width="70" src="../../documentos/inventarios/productos/'+c['img_prod']+'"></img><br>';
            return info;
        }      
    },
    {
        "data": 'nom_prod'
    },
    {
        "data": "cant_sol",
    },
    {
        "data": "entregado",
    },
    {
        "data": "nom_usu",
        "render": function (a, b, c) {
            let color = '';
            let text = '';
            if(c['cant_sol'] == c['entregado'] && (c['aprob_prod'] == 0 || c['aprob_prod'] == 2)){
                color = 'success';
                text = 'Entregado Completamente';
            } else if(c['entregado'] == 0 && (c['aprob_prod'] == 0 || c['aprob_prod'] == 2)){
                color = 'info';
                text = 'Pendiente Entrega';
            } else if(c['entregado'] < c['cant_sol'] && (c['aprob_prod'] == 0 || c['aprob_prod'] == 2)){
                color = 'primary';
                text = 'Entregado Parcialmente';
            } else if(c['entregado'] == 0 && (c['aprob_prod'] == 3)){
                color = 'danger';
                text = 'Rechazado';
            }
            span = '<span class="rounded-pill badge bg-'+color+'">';
            span += text;
            span += '</span>';
            return span;
        } 
    }];
    let columnDefs = '';
    if(resp == 11){
        columnDefs = [{
            "target":4,
            "visible": false,
            "searchable": false
        }];
    }
    let tableDatatable = bodyInvSolDetallada(ajaxData, columns, columnDefs);
    tableDatatable.on('click', 'tr', function (e) {
        let tr = e.target.closest('tr');
        let row = tableDatatable.row(tr);
    
        if(row.data() != undefined){
            //e.currentTarget.classList.toggle('selected');
            if (row.child.isShown()) {
                row.child.hide();
            }
            else {
                row.child(format_sol_entrega(row.data())).show();
            }
        }
    });
}
function format_sol_entrega(d) {
    console.log(d);
 
    if(d.est_sol == 5 || d.aprob_prod == 3){
        tex1 = 'Fecha de Rechazo';
        tex2 = 'Rechazado por';
    } else{
        tex1 = 'Fecha de Entrega';
        tex2 = 'Entregado por';
    }
    if(d.entregado == 0 && (d.aprob_prod == 0 || d.aprob_prod == 2) && d.est_sol != 5){
        d.fec_ent = d.nom_usu = 'N/A';
    }
    table = '<div class="format_sol_entrega"><p><span class="fw-bold">'+tex1+ ': </span>' +d.fec_ent+'</p>';
    table += '<p><span class="fw-bold">'+tex2+ ': </span>' +d.nom_usu+'</p></div>';
    return table;
;}
function serverSideInvSolDetallada(resp, id_sol) {
    if(resp == 0 || resp == 4 || resp == 4.1){
        tableInvSolResp(id_sol);
    } else if(resp == 5){
        tableInvSolResp_5(id_sol);
    } else if(resp == 7 || resp == 7.1){
        tableInvSolResp_7(resp, id_sol);
    } else if(resp == 10 || resp == 11){
        tableInvSolResp_10_or_11(resp, id_sol);
    }
   
}
function serverSideMovInv() {
    new DataTable('#tableMovInv', {
        "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "info": false,
        "ajax": {
            "url": '../serverside/inventarios/table_report_inv.php',
            "type": "POST",
            "data" : function (d) {
                d.razon = $('#mov_razon').val();
                d.fecha1 =$('#fecha1').val();
                d.fecha2 =$('#fecha2').val();               
            }
        },
        "columns": [ {
            "data": 'fec_mov',
        },
        {
            "data": 'nom_prod',
        },
        {
            "data": 'razon',
        },
        {
            "data": 'razon_det',
            "width": 200,
            "render": function (a, b, c) {
                function cantidad_disponible(cant_ant, new_cant, razon) {
                    if (razon == 'Ingreso') {
                        cantidad = '+';
                        cantidad += cant_ant + new_cant;
                    } else {
                        cantidad = '-';
                        cantidad += cant_ant - new_cant;
                    }

                    return cantidad;
                }

                info = '<td><span class="fw-bold">Cantidad Anterior: </span>'+c['cant_ant']+'</td><br>';
                info += '<td><span class="fw-bold">Ajuste: </span>'+cantidad_disponible(c['cant_ant'],c['new_cant'],c['razon'])+'</td><br>';
                info += '<td><span class="fw-bold">Cantidad Disponible: </span>'+c['new_cant']+'</td><br>';
                return info;
            }    
        },
        {
            "data": "nom_usu",
        }],
        order: [
            [ 0, 'desc' ]
        ],
    });
}

function serverSideCorrespondencia4() {
    new DataTable('#tableCorrespondencia4', {
        "language": {
            "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/serversideCorrespondencia4.php',
            "type": "POST",
            "data" : function (d) {
                d.id_usu = $('#id_usu').val(); 
                d.id_are = $('#id_are').val(); 
                if ($('#id_are').val() == 5) {
                    d.empleado = $('#empleado_mq').val();
                    d.mes =$('#mes').val();
                }            
            }
        },
        "columns": [{
            "data": 'id_seg',
        },
        {
            "data": 'nom_usu',
        },
        {
            "data": 'nom_doc',
        },
        {
            "data": 'nom_cli',
        },
        {
            "data": 'fech_ini',
        },
        {
            "data": 'num_facR',
        },
        {
            "data": 'nom_per_encarga',
        },
        {
            "data": "nom_estS",
        },
        {
            "data": null,
            "width": 30,
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                if(c['id_usu'] == $('#id_usu').val() || c['per_encarga'] == $('#id_usu').val()){
                    dropdown += '<a onclick="editarCorr('+c['id_seg']+', '+c['id_estSeg']+','+c['id_nom']+', '+c['id_prove']+');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square me-1"></i> Editar</a>';
                } 
                if(c['id_nom'] == 1 || c['id_nom'] == 2 || c['id_nom'] == 3 || c['id_nom'] == 4 || c['id_nom'] == 5 || c['id_nom'] == 6 || c['id_nom'] == 10){
                    dropdown += '<a onclick="mostrarCorr('+c['id_seg']+', '+c['id_estSeg']+','+c['id_nom']+', '+c['id_prove']+');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-share me-1"></i> Seguimiento</a>';
                } 
                dropdown += '</div></div>';
                return dropdown;
            }  
        }],
        order: [
            [ 0, 'desc' ]
        ],
    });
}
/* FENASEO */
function serverSideFenaseo() {
    new DataTable('#tableEscalasFenaseo', {
        "language": {
        "url": "../../resources/utils/datatables/spanish.lang.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../serverside/fenaseo/serverSideProduct.php',
            "type": "POST",
        },
        "columns": [{
            "data": "id"
        },
        {
            "data": null,
            "render": function (a, b, c) {
                return c['post_title']+'<br><span class="text-id-product">'+c['id_producto']+'</span>';
            }  
        },
        {
            "data": "escala"
        },
        {
            "data": "precio",
            "render": function (a, b, c) {
                return '$' + separadorMiles(c['precio']);
            }  
        },
        {
            "data": "vol_min"
        },
        {
            "data": null,
            "render": function (a, b, c) {
                return '<div class="alert alert-'+c['color']+'">'+c['color']+'</div>';
            } 
        },
        {
            "data": null,
            "class": "table-td-sm",
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">';
                dropdown += '<a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarEscala('+c['id']+');"><i class="fa-solid fa-pen-to-square me-2"></i>Editar</a>';
                dropdown += '</div></div>';
                return dropdown;
            }  
        },
        ],
        order: [[ 0, 'asc' ]],
    });
}
function table_agrup_prod_x_area() {
    new DataTable('#table_asig_prod', {
        "data": products,
        "info": false,
        "paging": false,
        "columnDefs": [
            {
                "target": 0,
                "visible": false,
                "searchable": false
            }
        ],
        "columns": [{
            "data": 'id_prod',
        },
        {
            "data": 'nom_prod',
            "render": function (a, b, c) {
                info = '<img width="50" src="../../documentos/inventarios/productos/'+c['img_prod']+'"></img><br>';
                info += '<span>'+c['nom_prod']+'</span>';
                return info;
            } 
        },
        {
            "data": null,
            "width": 30,
            "render": function (a, b, c) {
                input = '<input id="cont'+c['id_prod']+'" onkeyup="expresiones_regular(1, '+"'cont"+c['id_prod']+"'"+', this.value);" onchange="act_cant_prod(this.value, '+c['id_prod']+');" class="form-control form-control-md" style="text-align: center;" name="cant_prod[]" value="0" >';
                return input;
            }  
        },
        {
            "data": null,
            "render": function (a, b, c) {
                button = '<a type="button" onclick="slice_prod('+c["id_prod"]+');"><i class="fa fa-trash text-mq fs-4"></i></a>';
                return button;
            }  
        }],
        order: [
            [ 0, 'asc' ]
        ],
    });
}