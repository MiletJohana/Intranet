var diligencias = document.getElementById("diligencias");
var ruta = document.getElementById("ruta");

Sortable.create(diligencias,{
    group:"ordenes"
});
Sortable.create(ruta,{
    group:"ordenes",
});


var crear_json = function(){
    var orders = []
    var childrens = $("#ruta").children();
    for (var i = 0; i < childrens.length; i++) {
        var id_order = $(childrens[i]).data("id")
        orders.push(id_order)
    }
    post(JSON.stringify(orders))
}


function post(json) {
    var form = $('<form></form>');

    form.attr("method", "POST");
    form.attr("action", "http://192.168.0.30:8080/mq_agenda/enrutamientos/enrutamiento.php");
    
    var field = $('<input></input>');
    
    field.attr("type", "hidden");
    field.attr("name", "route");
    field.attr("value", json);

    form.append(field);

    $("body").append(form);

    form.submit();
}