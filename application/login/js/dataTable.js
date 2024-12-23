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
            "type": "GET"
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
                return '<a href="index.php?id=' + c['id_cli'] + '">' + c['nom_cli'] + '</a>';
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
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm bmd-btn-icon" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown"><a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal"';
                dropdown += 'onclick="modalCliente(2, ' + c['id_cli'] + ', 1);"><i class="fa-solid fa-pen-to-square mr-1"></i> Editar</a></div></div>';
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
            "type": "GET"
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
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm bmd-btn-icon" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown"><a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal"';
                dropdown += 'onclick="modalContacto(2, ' + c['id_cli'] + ', 1);"><i class="fa-solid fa-pen-to-square mr-1"></i> Editar</a></div></div>';
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
            "type": "GET"
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
                        return '<span class="badge badge-pill badge-success text-light" style="font-size: 0.95em;"><i class="fa-solid fa-check"></i> ' + c['estado'] + '</span>';
                    } else if (c['id_est'] == 3) {
                        return '<span class="badge badge-pill badge-info text-light" style="font-size: 0.95em;"><i class="fa fa-clock-o"></i> ' + c['estado'] + '</span>';
                    } else if (c['id_est'] == 4) {
                        return '<span class="badge badge-pill badge-danger text-light" style="font-size: 0.95em;"><i class="fa fa-times"></i> ' + c['estado'] + '</span>';
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
                    dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm bmd-btn-icon" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                    dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown"><a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal"';
                    dropdown += 'onclick="modalNegocio(2, ' + c['id_neg'] + ', ' + c['id_cli'] + ', 2);"><i class="fa-solid fa-pen-to-square mr-1"></i> Editar</a></div></div>';
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
                        return '<span class="badge badge-pill badge-danger text-light" style="font-size: 0.95em;"><i class="fa fa-times"></i> ' + c['estado'] + '</span>';
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
                    dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm bmd-btn-icon" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                    dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown"><a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal"';
                    dropdown += 'onclick="modalNegocio(2, ' + c['id_neg'] + ', 0, 1);"><i class="fa-solid fa-pen-to-square mr-1"></i> Editar</a></div></div>';
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
            "type": "GET"
        },
        "columns": [{
            "className": 'details-control',
            "data": "cod_pro"
        },
        {
            "data": "cod_ref"
        },
        {
            "data": "nom_pro"
        },
        {
            "data": "pre_pro"
        },
        {
            "data": "und_emp",
            "render": function (a, b, c) {
                return c['und_emp'] + ' ' + c['can_emp'];
            }
        },
        {
            "data": "sin_dev",
            "render": function (data) {
                if (data == 0) {
                    return '<i class="fa fa-close text-danger"></i>';
                } else {
                    return '<i class="fa-solid fa-check text-success"></i>';
                }
            }
        },
        {
            "data": null,
            "orderable": false,
            "render": function (a, b, c) {
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm bmd-btn-icon" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown"><a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal"';
                dropdown += 'onclick="editar(9, ' + c['cod_pro'] + ', 1);"><i class="fa-solid fa-pen-to-square mr-1"></i> Editar</a></div></div>';
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

function serverSideCotHis() {
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
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm bmd-btn-icon" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown"><a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal"';
                dropdown += 'onclick="editar(' + c['id_tip_cot'] + ', ' + c['id_coti'] + ');"><i class="fa-solid fa-pen-to-square mr-1"></i> Editar</a></div></div>';
                return dropdown;
            }
        }
        ],
        "order": [
            [0, 'asc']
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
                dropdown = '<div class="dropdown"><button type="button" class="btn btn-secondary btn-sm bmd-btn-icon" id="optionsDropdown" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                dropdown += '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown"><a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal"';
                dropdown += 'onclick="editar(';
                if (c['id_tip_cot'] == 2 || c['id_tip_cot'] == 6 || c['id_tip_cot'] == 5 || c['id_tip_cot'] == 9 || c['id_tip_cot'] == 3) {
                    dropdown += 16;
                } else {
                    dropdown += 6;
                }
                dropdown += ', ' + c['id_coti'];
                dropdown += ', ' + id_usu;
                dropdown += ');"><i class="fa-solid fa-pen-to-square mr-1"></i> Editar</a>';
                dropdown += '<a class="btn btn-link dropdown-item" href="#" onclick="email(' + c['id_coti'] + ', ' + id_usu + ', ' + c['id_cli'] + ', ' + c['id_cont'] + ',' + c['id_tip_cot'] + ');"><i class="fa fa-envelope mr-1"></i> Email</a>'
                dropdown += '</div></div>';
                return dropdown;
            }
        }
        ]
    });
}

