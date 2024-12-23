let input_escala = 1;

function auto() {
    $("#nom_product").autocomplete({
        source: '../autocomplete/fenaseo/buscador.php',
        minLength: 3,
        select: function(event, ui) {
            $("#nom_product").val(ui.item.nom_product);
            $("#id_product").val(ui.item.id_product);
            
        }
    });
}

function crearEscala() {
    $('#modal-title-lg').html("Agregar Escala");
    $.ajax({

        url: '../fenaseo/form1.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#largeModal-dialog').attr('style', 'min-width:1200px');
            $('#modal-body-lg').html(resp);
        }
    });

    $.ajax({
        url: '../fenaseo/boton.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function agregarEscalaProduct() {
    if (validarCampos() == 0) {
        var formulario = new FormData($("#form-escala-fenaseo")[0]);
        $.ajax({
            url: '../fenaseo/fenaseo.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                if(resp == 1){
                    alertSuccess('Escalas asignadas correctamente', 'https://intranet.masterquimica.com/application/fenaseo', 2);
                } else {
                    alertError(resp);
                }
                
            }
        });
    }
}

function agregarEscala() {
    if(input_escala < 5){
        input_escala++;
        const container_form = document.getElementById("form-escala-fenaseo");
        let row = document.createElement('div');
        row.className = 'row';
        row.id = 'escala-'+input_escala;
    
        const inputs = [
            ['escala', '2', 'number', 'escala[]'], 
            ['precio', '4', 'number', 'precio[]'],
            ['vol_min', '2', 'number', 'vol_min[]'],
            ['color', '3', 'select', 'color[]'],
            ['btn_eliminar', '1', 'button', 'btn_delete_escala("'+row.id+'");']
        ];
    
      
        inputs.forEach(item => {
            let col = document.createElement('div');
            col.className = 'col-'+item[1]+' mb-3';

            if(item[0] == 'btn_eliminar'){
                let btn = document.createElement('button');
                btn.className = 'btn btn-danger';
                btn.type = item[2];
                btn.setAttribute('onclick', item[3]);
                let i = document.createElement('i');
                i.className = 'fa-solid fa-trash';
                btn.appendChild(i);
                col.appendChild(btn);
            } 

            else if(item[0] == 'color'){
                let select = document.createElement('select');
                select.className = 'form-select';
                select.id = "color";
                select.name = item[3];
                let data = new FormData();
		        data.append('resp', select.id);
                fetch('../fenaseo/sql.php', {
                    method: 'POST',
                    body: data
                }).then(data => data.json()).then(data2 => {
                    let option_default = document.createElement('option');
                    option_default.textContent = 'Seleccionar';
                    option_default.setAttribute('selected', '');
                    select.appendChild(option_default);
                    data2.forEach(item => {
                        let option = document.createElement('option');
                        option.value = item['clase'];
                        option.className = 'alert alert-'+item['clase'];
                        option.textContent = item['color'];
                        select.appendChild(option);
                    })
                })
                col.appendChild(select);
            }
            else {
                let input = document.createElement('input');
                input.type = item[2];
                input.className = 'form-control';
                input.id = item[0]+input_escala;
                input.name = item[3];
                input.setAttribute('required', '');
        
                if(item[0] == 'precio'){
                    let input_group = document.createElement('div');
                    input_group.className = 'input-group';
                    let span = document.createElement('span');
                    span.className = 'input-group-text';
                    span.textContent = '$';
                    input_group.appendChild(span);
                    input_group.appendChild(input);
                    col.appendChild(input_group);
                }
                 else {
                    col.appendChild(input);
                }
            }
           
           
            
            row.appendChild(col);
        });
    
        container_form.appendChild(row);
    }
   
}

function btn_delete_escala(id) {
    if(id == "escala-1"){
        document.getElementById('escala').value = '';
        document.getElementById('precio').value = '';
        document.getElementById('vol_min').value = '';
        document.getElementById('color').value = '';
    } else {
        const container_form = document.getElementById("form-escala-fenaseo");
        let div = document.getElementById(id);
        container_form.removeChild(div);
        input_escala--;
    }
   
}

function editarEscala(id) {
    $('#modal-title-lg').html("Editar Escala");
    $.ajax({

        url: '../fenaseo/form1.php',
        type: 'POST',
        data: { resp: 2, id: id },
        success: function(resp) {
            $('#largeModal-dialog').attr('style', 'min-width:1200px');
            $('#modal-body-lg').html(resp);
        }
    });

    $.ajax({
        url: '../fenaseo/boton.php',
        type: 'POST',
        data: { resp: 2 },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function editarEscalaProduct() {
    if (validarCampos() == 0) {
        var formulario = new FormData($("#form-escala-fenaseo")[0]);
        $.ajax({
            url: '../fenaseo/fenaseo.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                if(resp == 1){
                    alertSuccess('Escala actualiza correctamente', 'https://intranet.masterquimica.com/application/fenaseo', 2);
                } else if(resp == 2){
                    alertWarning('Campos no han sido modificados');
                } else {
                    alertError(resp);
                }
                
            }
        });
    }
}