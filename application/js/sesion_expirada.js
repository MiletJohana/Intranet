let registrarInactividad = function () {
    let time;
   
    window.onload = reiniciarTiempo;
    // Eventos del DOM
    document.onmousemove = reiniciarTiempo;
    document.onload = reiniciarTiempo;
    document.onmousedown = reiniciarTiempo;
    document.ontouchstart = reiniciarTiempo;
    document.onclick = reiniciarTiempo;     
    document.onscroll = reiniciarTiempo; 

    function tiempoExcedido() {
        localStorage.setItem("SesionExpirada", 'true');
        window.location = '../../session/logout.php';
    }

    function reiniciarTiempo() {
        clearTimeout(time);
        time = setTimeout(tiempoExcedido, 1200000);
    }
};

//1200000

//registrarInactividad();