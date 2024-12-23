var products = [];
function auto(opcion) {
    if (opcion == 1) {
        $("#nom_prod").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '../autocomplete/inventarios/buscador.php',
                    dataType: 'json',
                    data: {
                        term: request.term, // término de búsqueda del usuario
                        id_are: document.getElementById('area').value // id del área para filtrar los productos
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 3,
            select: function (event, ui) {
                document.getElementById('nom_prod').value = '';
                $("#id_prod").val(ui.item.id_prod);
                $('#table_asig_prod').DataTable().destroy();
                let table_prod_x_area = {
                    'id_prod': ui.item.id_prod,
                    'nom_prod': ui.item.nom_prod,
                    'img_prod': ui.item.img_prod,
                    'req_aprob': ui.item.req_aprob,
                    'can_max': 0
                }
                document.getElementById('table_prod').classList.remove("none");
                console.log(table_prod_x_area);
                product_exist = products.findIndex((obj => obj.id_prod == ui.item.id_prod));
                
                if (product_exist != -1) {
                    toastWarning("Producto ya se encuentra agregado");
                } else {
                    products.push(table_prod_x_area);
                    val_array_prod(1);
                }
                table_agrup_prod_x_area();
            }
        });
    }
}
function slice_prod(id) {
    product_exist = products.findIndex((obj => obj.id_prod == id));
    if (product_exist != -1) {
        products.splice(product_exist,1);
        $('#table_asig_prod').DataTable().destroy();
        table_agrup_prod_x_area();
        val_array_prod(1);
    } else {
        console.log(product_exist);
        alert ("No fue posible eliminar el registro");
    }
}
function newSolicitudInventario(resp, title, url) {
    $('#modal-title-lg').html(title);
    $('#modal-body-lg').html('');
    $('#modal-footer-lg').html('');
    if (url != '') {
        $.ajax({
            url: url,
            type: 'POST',
            data: { resp },
            success: function (respHtml) {
                $('#modal-body-lg').html(respHtml);
            }
        });
    }
    $.ajax({
        url: '../solicitudInven/boton.php',
        type: 'POST',
        data: { resp },
        success: function (respHtml) {
            $('#modal-footer-lg').html(respHtml);
            document.getElementById('modal-btn-close').setAttribute('onclick', 'limpiarArrayProd();');
        }
    });
}
function solicitudInventario(id, resp, title, url) {
    $('#modal-title-lg').html(title);
    $('#modal-body-lg').html('');
    if (url != '') {
        $.ajax({
            url: url,
            type: 'POST',
            data: { id, resp },
            success: function (respHtml) {
                $('#modal-body-lg').html(respHtml);
                let mensaje_form = document.getElementById('form_message');
                if(resp == 7){
                    mensaje_form.innerHTML = '<div class="alert alert-info d-flex align-items-center" role="alert"><i class="fa-solid fa-circle-info me-2"></i><div>Seleccione los productos que desea Aprobar o Rechazar</div></div>';
                }
                serverSideInvSolDetallada(resp, id);
            }
        });
    }
    if (resp != '') {
        $.ajax({
            url: '../solicitudInven/boton.php',
            type: 'POST',
            data: { resp },
            success: function (respHtml) {
                $('#modal-footer-lg').html(respHtml);
                document.getElementById('modal-btn-close').setAttribute('onclick', 'limpiarArrayProd();');
            }
        });
    }
}
function seguimientoSolInv(id_sol, title, url) {
    $('#modal-title-lg').html(title);
    $('#modal-body-lg').html('');
    if (url != '') {
        $.ajax({
            url: url,
            type: 'POST',
            data: { id_sol },
            success: function (respHtml) {
                $('#modal-body-lg').html(respHtml);
            }
        });
    }
}
function verResumenInv(resp) {
    if (products.length != 0) {
        $('#modal-footer-lg').html('');
        tableResumenSolInv();
        document.getElementById('div_table_products').classList.add('none');
        document.getElementById('div_tabla_resumen').classList.remove('none');
        document.getElementById('text-principal-sol').innerHTML = "Confirmar Solicitud";
        document.getElementById('text-select-product').innerHTML = "Productos Seleccionados:";
        $.ajax({
            url: '../solicitudInven/boton.php',
            type: 'POST',
            data: { resp },
            success: function (respHtml) {
                $('#modal-footer-lg').html(respHtml);
            }
        });
    } else {
        alertWarning('Debe seleccionar mínimo un producto');
    }
}
function regresarSolInv(resp) {
    $('#modal-footer-lg').html('');
    $('#tableResumenSolInv').DataTable().destroy();
    document.getElementById('div_table_products').classList.remove('none');
    document.getElementById('div_tabla_resumen').classList.add('none');
    document.getElementById('text-principal-sol').innerHTML = "Crear Solicitud";
    document.getElementById('text-select-product').innerHTML = "Seleccionar Productos:";
    $.ajax({
        url: '../solicitudInven/boton.php',
        type: 'POST',
        data: { resp },
        success: function (respHtml) {
            $('#modal-footer-lg').html(respHtml);
            validar_sol(document.getElementById('id_usu').value);
        }
    });
}
function confirm_entrega(resp) {
    $('#modal-footer-lg').html('');
    $('#table_prod_sol').DataTable().destroy();
    document.getElementById('text-principal-sol').innerHTML = "Confirmar Entrega";
    serverSideInvSolDetallada(5, document.getElementById('id_sol').value);
    //document.getElementById('div_tabla_resumen').classList.remove('none');
    $.ajax({
        url: '../solicitudInven/boton.php',
        type: 'POST',
        data: { resp },
        success: function (respHtml) {
            $('#modal-footer-lg').html(respHtml);
        }
    });
}
async function validar_cant_prod() {
    var formulario = new FormData();
    var id_sol = document.getElementById('id_sol').value;
    formulario.append('id_sol', id_sol);
    formulario.append('action', 'val_cant_prod');
    cargar(1);
    try {
        let url = '../solicitudInven/solicitud.controller.php';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formulario
        });
        const resultado = await respuesta.json();
        console.log(resultado);
        cargar(2);
        if (resultado['num'] == 1) {
            document.getElementById('form_message').innerHTML = '';
            products = JSON.parse(resultado['text']);
            if (products.findIndex((obj => obj.resp == 1 && obj.cant_entregar != 0)) != -1) {
                document.getElementById('form_message').innerHTML = '*Algunos productos se entregaran parcialmente*';
            } 
            
            products.forEach(product => {
                document.getElementById('text-prod-' + product['id_prod']).innerHTML = '';
                document.getElementById('entregado' + product['id_prod']).value = (parseInt(product['cant_entregar']) + parseInt(product['entregado']));
                if (product['resp'] == 1) {
                    document.getElementById('text-prod-' + product['id_prod']).innerHTML = 'Entrega parcial';
                } else if (product['resp'] == 2) {
                    document.getElementById('text-prod-' + product['id_prod']).innerHTML = 'No se encuentran unidades disponibles';
                }
            });
            
            let btn_confirm_entrega = document.getElementById('btn_confirm_entrega');
            console.log(products.some(product => product.resp != 2));
            if(products.some(product => product.resp != 2)){
                btn_confirm_entrega.removeAttribute('disabled', '');
                btn_confirm_entrega.setAttribute('onclick', 'entregar_sol(' + id_sol + ', "' + "table_inv_solicitud" + '");');
                toastSuccess('Cantidades establecidas correctamente');
            } else {
                toastWarning('Revisar las unidades disponibles en el Inventario')
            }
   
        } else if (resultado['num'] == 2) {
            alertWarning(resultado['text']);
        } else {
            alertError(resultado['text']);
        }
    } catch (error) {
        console.log(error);
    }
}
async function entregar_sol(id_sol, table) {
    var formulario = new FormData();
    formulario.append('id_sol', id_sol);
    formulario.append('products', JSON.stringify(products));
    formulario.append('action', 'entregar_sol');
    console.log(products);
    cargar(1);
    try {
        let url = '../solicitudInven/solicitud.controller.php';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formulario
        });
        const resultado = await respuesta.json();
        console.log(resultado);
        cargar(2);
        if (resultado['num'] == 1) {
            //console.log(resultado['text']);
            alertSuccess(resultado['text'], table, 3);
            limpiarArrayProd();
            $('#largeModal').modal('hide');
        } else if (resultado['num'] == 2) {
            alertWarning(resultado['text']);
        } else {
            alertError(resultado['text']);
        }
    } catch (error) {
        console.log(error);
    }
}
function confirm_rechazo_sol(resp) {
    $('#modal-footer-lg').html('');
    document.getElementById('form_message').innerHTML = '<div class="alert alert-info d-flex align-items-center" role="alert"><i class="fa-solid fa-circle-info me-2"></i><div>Seleccione los productos que desea rechazar</div></div>';
    document.getElementById('text-principal-sol').innerHTML = "Rechazar Solicitud";
    $('#table_prod_sol').DataTable().destroy();
    serverSideInvSolDetallada(7.1, document.getElementById('id_sol').value);
    $.ajax({
        url: '../solicitudInven/boton.php',
        type: 'POST',
        data: { resp },
        success: function (respHtml) {
            $('#modal-footer-lg').html(respHtml);
            $('#btn_rechazar_sol').attr('onclick', 'rechazar_sol("' + "table_inv_solicitud" + '");');
        }
    });
}
async function rechazar_sol(table) {
    var formulario = new FormData();
    formulario.append('products', JSON.stringify(products));
    formulario.append('action', 'rechazar_sol');
    console.log(products);
    cargar(1);
    try {
        let url = '../solicitudInven/solicitud.controller.php';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formulario
        });
        const resultado = await respuesta.json();
        console.log(resultado);
        cargar(2);
        if (resultado['num'] == 1) {
            alertSuccess(resultado['text'], table, 3);
            limpiarArrayProd();
            $('#largeModal').modal('hide');
        } else if (resultado['num'] == 2) {
            alertWarning(resultado['text']);
        } else {
            alertError(resultado['text']);
        }
    } catch (error) {
        console.log(error);
    }
}
async function inv_create_sol(table) {
    var formulario = new FormData();
    formulario.append('id_usu', document.getElementById('id_usu').value);
    formulario.append('id_are', document.getElementById('id_are').value);
    formulario.append('products', JSON.stringify(products));
    formulario.append('action', 'inv_create_sol');
    console.log(products);
    cargar(1);
    /*for (var value of formulario.values()) {
        console.log(value);
    }*/
    try {
        let url = '../solicitudInven/solicitud.controller.php';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formulario
        });
        const resultado = await respuesta.json();
        console.log(resultado);
        cargar(2);
        if (resultado['num'] == 1) {
            alertSuccess(resultado['text'], table, 3);
            limpiarArrayProd();
            $('#largeModal').modal('hide');
        } else if (resultado['num'] == 2) {
            alertWarning(resultado['text']);
        } else {
            alertError(resultado['text']);
        }
    } catch (error) {
        console.log(error);
    }
}
async function aprobar_prod(table) {
    var formulario = new FormData();
    var id_sol = document.getElementById('id_sol').value;
    formulario.append('id_sol', id_sol);
    formulario.append('products', JSON.stringify(products));
    formulario.append('action', 'aprobar_prod');
    console.log(products);
    cargar(1);
    try {
        let url = '../solicitudInven/solicitud.controller.php';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formulario
        });
        const resultado = await respuesta.json();
        console.log(resultado);
        cargar(2);
        if (resultado['num'] == 1) {
            alertSuccess(resultado['text'], table, 3);
            limpiarArrayProd();
            solicitudInventario(id_sol, 4, 'Solicitud #'+id_sol,'../solicitudInven/form2.php');
        } else if (resultado['num'] == 2) {
            alertWarning(resultado['text']);
        } else {
            alertError(resultado['text']);
        }
    } catch (error) {
        console.log(error);
    }
}
function modal_delete_sol(id, resp, title) {
    $('#modal-title-md').html(title);
    $('#modal-body-md').html('');
    $('#modal-body-md').html('<p>¿Esta segur de eliminar la solicitud <span style="font-weight: bold !important;">#' + id + '</span>?</p>');
    $.ajax({
        url: '../solicitudInven/boton.php',
        type: 'POST',
        data: { resp },
        success: function (respHtml) {
            $('#modal-footer-md').html(respHtml);
            $('#delete_sol').attr('onclick', 'deleteSolInv(' + id + ', "' + "table_inv_solicitud" + '");');
        }
    });
}
async function deleteSolInv(id, table) {
    var formulario = new FormData();
    formulario.append('id', id);
    formulario.append('action', 'delete_sol_inv');
    cargar(1);
    try {
        let url = '../solicitudInven/solicitud.controller.php';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formulario
        });
        const resultado = await respuesta.json();
        console.log(resultado);
        cargar(2);
        if (resultado['num'] == 1) {
            alertSuccess(resultado['text'], table, 3);
            $('#mediumModal').modal('hide');
        } else if (resultado['num'] == 2) {
            alertWarning(resultado['text']);
        } else {
            alertError(resultado['text']);
        }
    } catch (error) {
        console.log(error);
    }
}
function inv_modal_create(resp, title, url) {
    document.getElementById("modal-title-md").innerHTML = title;
    $('#modal-body-md').html('');
    if (url != '') {
        $.ajax({
            url: url,
            type: 'POST',
            data: { resp },
            success: function (respHtml) {
                $('#modal-body-md').html(respHtml);
            }
        });
    }
    $.ajax({
        url: '../administrarInven/boton.php',
        type: 'POST',
        data: { resp },
        success: function (respHtml) {
            $('#modal-footer-md').html(respHtml);
        }
    });
}
function inv_modal_edit(id, resp, title, url) {
    $('#modal-title-md').html(title);
    $('#modal-body-md').html('');
    if (url != '') {
        $.ajax({
            url: url,
            type: 'POST',
            data: { id, resp },
            success: function (respHtml) {
                $('#modal-body-md').html(respHtml);
            }
        });
    }
    $.ajax({
        url: '../administrarInven/boton.php',
        type: 'POST',
        data: { resp },
        success: function (respHtml) {
            $('#modal-footer-md').html(respHtml);
        }
    });
}
async function inv_crud(param, table) {
    if (validarCampos(param) == 0) {
        var formulario = new FormData($("#" + param)[0]);
        /*for (var value of formulario.values()) {
            console.log(value);
        }*/
            cargar(1);
        try {
            let url = '../administrarInven/administrar.controller.php';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: formulario
            });
            const resultado = await respuesta.json();
            console.log(resultado);
            cargar(2);
            if (resultado['num'] == 1) {
                alertSuccess(resultado['text'], table, 3);
                $('#mediumModal').modal('hide');
            } else if (resultado['num'] == 2) {
                alertWarning(resultado['text']);
            } else {
                alertError(resultado['text']);
            }
        } catch (error) {
            console.log(error);
        }
    } else {
        alertError('Validar campos obligatorios');
    }
}
function modal_deleteProd(id, name, resp, title) {
    $('#modal-title-md').html(title);
    $('#modal-body-md').html('');
    $('#modal-body-md').html('<p>¿Esta seguro de eliminar el producto <span style="font-weight: bold !imxtant;">' + name + '</span>?</p>');
    $.ajax({
        url: '../administrarInven/boton.php',
        type: 'POST',
        data: { resp },
        success: function (respHtml) {
            $('#modal-footer-md').html(respHtml);
            $('#delete_prod').attr('onclick', 'deleteProduct(' + id + ', "' + "tableInvProducts" + '");');
        }
    });
}
async function deleteProduct(id, table) {
    var formulario = new FormData();
    formulario.append('id', id);
    formulario.append('action', 'delete_prod');
    cargar(1);
    try {
        let url = '../administrarInven/administrar.controller.php';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formulario
        });
        const resultado = await respuesta.json();
        console.log(resultado);
        cargar(2);
        if (resultado['num'] == 1) {
            alertSuccess(resultado['text'], table, 3);
            $('#mediumModal').modal('hide');
        } else if (resultado['num'] == 2) {
            alertWarning(resultado['text']);
        } else {
            alertError(resultado['text']);
        }
    } catch (error) {
        console.log(error);
    }
}
function modal_delete_prod_x_are(id, name, resp, title) {
    $('#modal-title-md').html(title);
    $('#modal-body-md').html('');
    $('#modal-body-md').html('<p>¿Esta seguro de quitar el siguiente producto <span style="font-weight: bold !important;">' + name + '</span>?</p>');
    $.ajax({
        url: '../administrarInven/boton.php',
        type: 'POST',
        data: { resp },
        success: function (respHtml) {
            $('#modal-footer-md').html(respHtml);
            $('#delete_prod_x_are').attr('onclick', 'delete_prod_x_area(' + id + ', "' + "tableInvAreaXProd" + '");');
        }
    });
}
async function delete_prod_x_area(id, table) {
    var formulario = new FormData();
    formulario.append('id', id);
    formulario.append('action', 'delete_prod_x_are');
    cargar(1);
    try {
        let url = '../administrarInven/administrar.controller.php';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formulario
        });
        const resultado = await respuesta.json();
        console.log(resultado);
        cargar(2);
        if (resultado['num'] == 1) {
            alertSuccess(resultado['text'], table, 3);
            $('#mediumModal').modal('hide');
        } else if (resultado['num'] == 2) {
            alertWarning(resultado['text']);
        } else {
            alertError(resultado['text']);
        }
    } catch (error) {
        console.log(error);
    }
}
async function new_cant_prod(id, table) {
    var formulario = new FormData();
    formulario.append('id', id);
    formulario.append('cantidad', document.getElementById('new_cant' + id).value);
    formulario.append('action', 'new_cant_prod');
    try {
        let url = '../administrarInven/administrar.controller.php';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formulario
        });
        const resultado = await respuesta.json();
        console.log(resultado);
        if (resultado['num'] == 1) {
            toastSuccess_reload(resultado['text'], table);
            $('#mediumModal').modal('hide');
        } else if (resultado['num'] == 2) {
            toastWarning(resultado['text']);
        } else {
            toastError(resultado['text']);
        }
    } catch (error) {
        console.log(error);
    }
}
function inv_modal_adm_inv(resp, title, url, id_reg) {
    document.getElementById("modal-title-md").innerHTML = title;
    $('#modal-body-md').html('');
    if (url != '') {
        $.ajax({
            url: url,
            type: 'POST',
            data: { resp, id_reg },
            success: function (respHtml) {
                $('#modal-body-md').html(respHtml);
            }
        });
    }
    $.ajax({
        url: '../administrarInven/boton.php',
        type: 'POST',
        data: { resp },
        success: function (respHtml) {
            $('#modal-footer-md').html(respHtml);
            $('#adm_inv').attr('onclick', 'adm_inventario(' + id_reg + ', "' + "table_inventarios" + '");');
        }
    });
}
async function adm_inventario(id_reg, table) {
    var productos = [];
    var id_productos = document.getElementsByName("id_products[]");
    for (var i = 0; i < id_productos.length; i++) {
        if (id_productos[i].checked == true) {
            productos.push(id_productos[i].value);
        }
    }
    console.log(productos);
    var formulario = new FormData();
    formulario.append('id_reg', id_reg);
    formulario.append('id_products', productos);
    formulario.append('action', 'adm_inventario');
    cargar(1);
    try {
        let url = '../administrarInven/administrar.controller.php';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formulario
        });
        const resultado = await respuesta.json();
        cargar(2);
        console.log(resultado);
        if (resultado['num'] == 1) {
            alertSuccess(resultado['text'], table, 3);
            $('#mediumModal').modal('hide');
        } else if (resultado['num'] == 2) {
            alertWarning(resultado['text']);
        } else if (resultado['num'] == 4) {
            console.log(resultado['text'])
        } else {
            alertError(resultado['text']);
        }
    } catch (error) {
        console.log(error);
    }
}
async function cant_max(id, id_prod, table) {
    var formulario = new FormData();
    formulario.append('id', id);
    formulario.append('cant_max', document.getElementById('cant_max_' + id + '_' + id_prod).value);
    formulario.append('action', 'change_cant_max_prod');
    try {
        let url = '../administrarInven/administrar.controller.php';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formulario
        });
        const resultado = await respuesta.json();
        console.log(resultado);
        if (resultado['num'] == 1) {
            toastSuccess_reload(resultado['text'], table);
            $('#mediumModal').modal('hide');
        } else if (resultado['num'] == 2) {
            toastWarning(resultado['text']);
        } else {
            toastError(resultado['text']);
        }
    } catch (error) {
        console.log(error);
    }
}
function selectAllProd() {
    document.querySelectorAll('#tableInventarioProd input[type=checkbox]').forEach(function (checkElement) {
        checkElement.checked = true;
    });
}
function desmarcarAllProd() {
    document.querySelectorAll('#tableInventarioProd input[type=checkbox]').forEach(function (checkElement) {
        checkElement.checked = false;
    });
}
function asig_x_prod(resp, title, url) {
    document.getElementById("modal-title-md").innerHTML = title;
    $('#modal-body-md').html('');
    if (url != '') {
        $.ajax({
            url: url,
            type: 'POST',
            data: { resp },
            success: function (respHtml) {
                $('#modal-body-md').html(respHtml);
            }
        });
    }
    $.ajax({
        url: '../administrarInven/boton.php',
        type: 'POST',
        data: { resp },
        success: function (respHtml) {
            $('#modal-footer-md').html(respHtml);
        }
    });
}
function previewImage(event, id_name, id_preview) {
    const input = event.target;
    var container = document.querySelector('.container_preview_img');
    var img_preview = document.getElementById(id_preview);
    var name_img = document.getElementById(id_name);
    if (!input.files.length) return
    file = input.files[0];
    object_url = URL.createObjectURL(file);
    container.classList.remove('none');
    img_preview.src = object_url;
    name_img.innerHTML = input.value;
}
async function select_user_mq(value) {
    var formulario = new FormData();
    formulario.append('id_are', value);
    formulario.append('action', 'select_usu_mq');
    let id_usu =  document.getElementById('id_usu');
    try {
        let url = '../solicitudInven/solicitud.controller.php';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formulario
        });
        const resultado = await respuesta.json();
        console.log(resultado);
        $('#tableSolicitudInv').DataTable().clear();
        $('#tableSolicitudInv').DataTable().destroy();
        limpiarArrayProd();
        id_usu.removeAttribute('disabled', true)
        id_usu.innerHTML = resultado['text'];
        id_usu.focus();
        serverSideSolicitudInv(document.getElementById('id_reg').value, value);
    } catch (error) {
        console.log(error);
    }
}
function validar_sol(id_usu) {
    if(id_usu == ' '){
        document.getElementById('adm_inv').setAttribute('disabled', '');
    } else {
        document.getElementById('adm_inv').removeAttribute('disabled', true);
    }
}
function select_regional() {
    let select = document.getElementById('regional');
    if (select.value != '') {
        var name_reg = document.getElementById('reg' + select.value).innerHTML;
        toastSuccess('Has seleccionado la regional ' + name_reg);
        document.getElementById('text-principal-inv').innerHTML = 'Administrar | Inventarios - ' + name_reg;
        var formulario = new FormData();
        formulario.append('reg', select.value);
        fetch('tabla.php', {
            method: 'POST',
            body: formulario
        })
            .then(response => response.text())
            .then(data => {
                document.getElementById('content-table').innerHTML = data;
                const scripts = document.getElementById('content-table').getElementsByTagName('script');
                for (let i = 0; i < scripts.length; i++) {
                    eval(scripts[i].innerHTML); // Ejecutar el script
                }
            })
            .catch(error => console.error('Error:', error));
    } else {
        document.getElementById('content-table').innerHTML = '';
        document.getElementById('text-principal-inv').innerHTML = 'Administrar - Inventarios';
    }
}
function limpiarArrayProd() {
    products = [];
    $('#tableResumenSolInv').DataTable().destroy();
}
function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) {
            return pair[1];
        }
    }
    return false;
}
function editarAre(resp) {
    $('#modal-footer-md').html('');
    document.getElementById('id_are').value = '';
    document.getElementById('nom_are').value = '';
    if(resp == 7){
        $('#modal-title-md').html('Agregar Área');
        document.getElementById('text-principalA').innerHTML = 'Nueva Área';
        document.getElementById('label_nom_are').innerHTML = 'Nombre <span name="req" class="text-mq">*</span>';
        document.getElementById('editar_are').value = 8;
        document.getElementById('accion_form').value = 'add_are';
    } else if(resp == 8) {
        $('#modal-title-md').html('Modificar Área');
        document.getElementById('text-principalA').innerHTML = 'Editar Área';
        document.getElementById('label_nom_are').innerHTML = 'Nuevo Nombre <span name="req" class="text-mq">*</span>';
        document.getElementById('editar_are').value = 7;
        document.getElementById('accion_form').value = 'update_are';
    }
    $.ajax({
        url: '../administrarInven/boton.php',
        type: 'POST',
        data: { resp },
        success: function (respHtml) {
            $('#modal-footer-md').html(respHtml);
        }
    });
   
}
function asignar_area(resp) {
    if(resp == 1){
        document.getElementById('buscador').classList.remove("none");
        document.getElementById('nom_prod').focus();
        
    } else {
        let area_seleccionada = document.getElementById('select_are').value;
        document.getElementById('id_are').value = area_seleccionada;
        document.getElementById('nom_are').value = document.getElementById('area'+area_seleccionada).innerText;
    }
   
}
function expresiones_regular(type, id, value) {
    console.log(id);
    let input = document.getElementById(id);
    if(type === 1){
        const pattern = new RegExp(/^[0-9]*$/);
        console.log(pattern.test(value));
        switch (pattern.test(value)) {
            case true:
                input.value = value;
                break;
            case false:
                input.value = '0';
                break;
        }
    }
    
}
function filter(resp) {
    let card_filter = document.getElementById('card_filter');
    let btn_filter = document.getElementById('btn_filter');
    if (resp == 1) {
        card_filter.classList.remove('d-none');
        btn_filter.innerHTML= '<i class="fa-solid fa-filter-circle-xmark me-2"></i> Ocultar Filtro';
        btn_filter.setAttribute('onclick', 'filter(2);');
    } else {
        card_filter.classList.add('d-none');
        btn_filter.innerHTML= '<i class="fa-solid fa-filter me-2"></i> Filtrar';
        btn_filter.setAttribute('onclick', 'filter(1);');
    }
}
function filter_his(resp) {
    if (resp == 1) {
        $('#table_inv_solicitud').DataTable().destroy();
        serverSideInvSolicitud(2, $('#est_sol').val(), $('#rol_inv').val());
    } else if(resp == 2){
        console.log($('#fecha1').val()); 
        console.log($('#fecha2').val()); 
        console.log($('#empleado_mq').val()); 
        var table = $('#table_inv_sol_hist').DataTable();
        table.ajax.reload();
    }

   
}
/* Reportes */
function reportMovInv(resp, title, url) {
    $('#mediumModal').modal('hide');
    $('#modal-title-lg').html(title);
    $('#modal-body-lg').html('');
    $.ajax({
        url: url,
        type: 'POST',
        data: { resp },
        success: function (respHtml) {
            $('#modal-body-lg').html(respHtml);
        }
    });
    
    $.ajax({
        url: '../administrarInven/boton.php',
        type: 'POST',
        data: { resp },
        success: function (respHtml) {
            $('#modal-footer-lg').html(respHtml);
            //document.getElementById('modal-btn-close').setAttribute('onclick', 'limpiarArrayProd();');
        }
    });
}
function val_inputs_report() {
    let input_razon = document.getElementById('mov_razon').value;
    let input_fec1 = document.getElementById('fecha1').value;
    let input_fec2 = document.getElementById('fecha2').value;
    let btn_search_report = document.getElementById('btn_search_report');
    if(input_razon != '' && input_fec1 != '' && input_fec2 != ''){
        btn_search_report.removeAttribute('disabled', '');
    } else {
        btn_search_report.setAttribute('disabled', true);
    }
}
function table_his_inv_mov() {
    let row_table_his = document.getElementById('row_table_his');
    let btn_excel_report = document.getElementById('btn_excel_report');
    if(document.querySelector('#row_table_his.d-none')){
        row_table_his.classList.remove('d-none');
    }
    if(document.querySelector('#btn_excel_report.d-none')){
        btn_excel_report.classList.remove('d-none');
    }
    $('#tableMovInv').DataTable().destroy();
    serverSideMovInv();
}
async function excel_report_inv(resp, data, url) {
    if(resp == 1){
        let form = document.getElementById(data);
        var formulario = new FormData(form);
        var nameFile = 'MovimientosInventarios_MQ.xlsx';
    } else if(resp ==2){
        var formulario = new FormData();
        formulario.append('id_reg', data);
        var nameFile = 'InventarioActual_MQ.xlsx';
    }
    try {
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formulario
        });
      
        const blob = await respuesta.blob();
        if(blob != ''){
            alertSuccess('Reporte Generado Correctamente', '', 1);
            let modal = (resp == 1) ? 'largeModal' : 'mediumModal';
            $('#'+modal).modal('hide');
            const downloadUrl = window.URL.createObjectURL(blob);
        
            const a = document.createElement('a');
            a.href = downloadUrl;
            a.download = nameFile;  
            document.body.appendChild(a);
            a.click();
    
            a.remove();
            window.URL.revokeObjectURL(downloadUrl);
        } else {
            alertError('Error al generar el Excel, Intente nuevamente')
        }
        
    } catch (error) {
        console.log(error);
    }
}
function val_array_prod(resp) {
    let btn_add_prod_x_are = document.getElementById('add_pro_x_area');
    if(products.length == 0 && resp == 1){
        btn_add_prod_x_are.setAttribute('disabled', true);
    } else {
        btn_add_prod_x_are.removeAttribute('disabled', '');
    }
}
function act_cant_prod(value, id) {
    product_exist = products.findIndex((obj => obj.id_prod == id));
    if (product_exist != -1){
        toastSuccess('Cantidad Máxima Asignada Correctamente');
        products[product_exist].can_max = value;
    } else{
        alertWarning('Producto no encontrado, Intente nuevamente');
    }
}
async function asig_prod_x_are(table) {
    prod_cant = products.findIndex((obj => obj.can_max == 0));
    console.log(prod_cant)
    if (prod_cant == -1) {
        var formulario = new FormData();
        formulario.append('products', JSON.stringify(products));
        formulario.append('id_area', document.getElementById('area').value);
        formulario.append('action', 'add_prod_x_are');
        cargar(1);
        
        try {
            let url = '../administrarInven/administrar.controller.php';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: formulario
            });
            const resultado = await respuesta.json();
            console.log(resultado);
            cargar(2);
            if (resultado['num'] == 1) {
                alertSuccess(resultado['text'], table, 3);
                limpiarArrayProd();
                $('#mediumModal').modal('hide');
            } else if (resultado['num'] == 2) {
                alertWarning(resultado['text']);
            } else {
                alertError(resultado['text']);
            }
        } catch (error) {
            console.log(error);
        }
    } else {
        alertWarning('Las cantidades máximas no pueden ser igual a 0');
    }
  
}

function change_info_adm(opcion) {
    let btn_info_adm = document.getElementById('btn_info_adm');
    let btn_upd_info = document.getElementById('btn_upd_info');
    let btn_cancelar = document.getElementById('btn_cancelar');
    let input_name_admin = document.getElementById('name_admin');
    let input_email_admin = document.getElementById('email_admin');

    if (opcion == 1) {
        input_email_admin.removeAttribute('readonly', '');
        input_name_admin.removeAttribute('readonly', '');
        btn_info_adm.classList.add('d-none');
        btn_upd_info.classList.remove('d-none');
        btn_cancelar.classList.remove('d-none');
        btn_upd_info.setAttribute('onclick', 'update_info_admin();');
    } else {
        input_email_admin.setAttribute('readonly', '');
        input_name_admin.setAttribute('readonly', '');
        btn_info_adm.classList.remove('d-none');
        btn_upd_info.classList.add('d-none');
        btn_cancelar.classList.add('d-none');
        btn_upd_info.removeAttribute('onclick', '');
    }
}

async function update_info_admin() {

    var formulario = new FormData();
    formulario.append('name', document.getElementById('name_admin').value);
    formulario.append('email', document.getElementById('email_admin').value);
    formulario.append('action', 'change_info_admin');
    cargar(1);
        
    try {
        let url = '../administrarInven/administrar.controller.php';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formulario
        });
        const resultado = await respuesta.json();
        console.log(resultado);
        cargar(2);
        if (resultado['num'] == 1) {
            alertSuccess(resultado['text'], '', 4);

        } else if (resultado['num'] == 2) {
            alertWarning(resultado['text']);
        } else {
            alertError(resultado['text']);
        }
    } catch (error) {
        console.log(error);
    }
    
}