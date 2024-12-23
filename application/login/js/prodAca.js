var
    table = document.getElementById("table");

function verificarProd(value) {
    if (value == 2) {
        var isEmpty = false,
            nom_proA = document.getElementById("nom_proA").value,
            pre_unidad = document.getElementById("pre_unidad").value;

        if (nom_proA === "") {
            alert("Debes Seleccionar un producto");
            isEmpty = true;
        } else
        if (pre_unidad === "") {
            alert("Debes Poner un precio valido");
            isEmpty = true;
        }
        return isEmpty;

    } else if (value == 3) {
        var isEmpty = false,
            nom_proC = document.getElementById("nom_proC").value,
            va_admin = document.getElementById("va_admin").value,
            va_impre = document.getElementById("va_impre").value,
            va_util = document.getElementById("va_util").value;

        if (nom_proC === "") {
            alert("Debes Seleccionar un producto");
            isEmpty = true;
        } else
        if (va_admin === "") {
            alert("Debes Poner un precio valido de Administración");
            isEmpty = true;
        }
        if (va_impre === "") {
            alert("Debes Poner un precio valido de Imprevistos");
            isEmpty = true;
        }
        if (va_util === "") {
            alert("Debes Poner un precio valido de Utilidad");
            isEmpty = true;
        }
        return isEmpty;

    } else if (value == 4) {
        var isEmpty = false,
            nom_proE = document.getElementById("nom_proE").value;
        if (nom_proE === "") {
            alert("Debes Seleccionar un producto");
            isEmpty = true;
        }
        return isEmpty;
    }
}

function agregarProd(values) {
    if (values == 2) {

    }


}