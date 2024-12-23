$(function () {
    $("#search").autocomplete({
        source: '../autocomplete/usuarios/buscador.php',
        minLength: 3,
        select: function (event, ui) {
            searchTable();
        }
    });
});