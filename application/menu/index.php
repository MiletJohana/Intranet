<?php
include '../../resources/template/session.php';
include "../../conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Intranet | Inicio</title>

    <?php
    include('../../resources/template/head.php');
    ?>
</head>
<style>body {
    background-image: url('https://intranet.proyectosandres.com/build/img/fondo-dashboard.jpg');
}.dashboard-container{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
}

.dashboard-modulo{
    width: calc(20%);
    display: flex;
    align-items: center;
    flex-direction: column;
    cursor: pointer;
    transition: 1s;
    text-decoration: none;
}

.dashboard-modulo:hover{
    transform: scale(1.2);
}

.dashboard-modulo img{
    width: 40%;
}

.dashboard-modulo-name{
    color: white;
    text-align: center;
    font-size: 16px;
}.navbar{
    background-color: rgb(248 249 250 / 40%) !important;
}</style>

<body>
<div class="d-flex">
 
 <div class="w-100">
     <?php  include('../../resources/template/navbar2.php'); ?>
     <div class="container">
       <div class="mb-4 mt-5">
       <div class="dashboard-container">
                <a href="../../application/permisos/index.php?table=1" class="dashboard-modulo">
                    <img src="https://intranet.proyectosandres.com/build/img/iconos-dashboard/modulo-correspondencia.jpg" alt="">
                    <p class="dashboard-modulo-name">Recursos</p>
                </a>
    <a href="/mesaAyuda" class="dashboard-modulo mb-4">
        <img src="https://intranet.proyectosandres.com/build/img/iconos-dashboard/modulo-correspondencia.jpg" alt="">
        <p class="dashboard-modulo-name">Mensajería</p>
    </a>
    <a href="/administrar/usuarios" class="dashboard-modulo mb-4">
        <img src="https://intranet.proyectosandres.com/build/img/iconos-dashboard/modulo-correspondencia.jpg" alt="">
        <p class="dashboard-modulo-name">Inventario</p>
    </a>
    <a href="../../application/correspondencia2/index.php?table=1" class="dashboard-modulo mb-4">
        <img src="https://intranet.proyectosandres.com/build/img/iconos-dashboard/modulo-correspondencia.jpg" alt="">
        <p class="dashboard-modulo-name">Correspondencia</p>
    </a>
    <a href="../../application/cotizadorv3/index.php?table=1" class="dashboard-modulo">
        <img src="https://intranet.proyectosandres.com/build/img/iconos-dashboard/modulo-correspondencia.jpg" alt="">
        <p class="dashboard-modulo-name">Cotizador</p>
    </a>
    <a href="/correspondencia" class="dashboard-modulo">
        <img src="https://intranet.proyectosandres.com/build/img/iconos-dashboard/modulo-correspondencia.jpg" alt="">
        <p class="dashboard-modulo-name">Créditos</p>
    </a>
    <a href="/correspondencia" class="dashboard-modulo">
        <img src="https://intranet.proyectosandres.com/build/img/iconos-dashboard/modulo-correspondencia.jpg" alt="">
        <p class="dashboard-modulo-name">Talento Humano</p>
    </a>
    <a href="/correspondencia" class="dashboard-modulo">
        <img src="https://intranet.proyectosandres.com/build/img/iconos-dashboard/modulo-correspondencia.jpg" alt="">
        <p class="dashboard-modulo-name">Fenaseo</p>
    </a>
    <a href="/correspondencia" class="dashboard-modulo">
        <img src="https://intranet.proyectosandres.com/build/img/iconos-dashboard/modulo-correspondencia.jpg" alt="">
        <p class="dashboard-modulo-name">Administrar</p>
    </a>
    <a href="https://intranet.masterquimica.com/application/home/" class="dashboard-modulo">
        <img src="https://intranet.proyectosandres.com/build/img/iconos-dashboard/modulo-correspondencia.jpg" alt="">
        <p class="dashboard-modulo-name">Portal de Noticias</p>
    </a>
</div>
       </div> 
     </div>
 </div>
</div>

    <?php
    include('../../resources/template/scripts.php');
    ?>
</body>

</html>

