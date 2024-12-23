<?php
 require_once('pruebas/vendor/autoload.php');
 require_once('App/Clases/google_auth.php');


 $googleClient = new Google_Client();
 $auth = new GoogleAuth($googleClient);

 if ($auth->checkRedirectCode()) {
     die($GET_['code']);
     header('Location: https://intranet.masterquimica.com/');
     //header('Location: ../index.php');
 }

 if ($auth->isLoggedIn() == true) {
     print "<script>location='application/home/index.php';</script>";
 } 
 include "conexion.php";

?>
<html lang="es">

<head>
    <title>MQ IntraNet</title>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link type="image/png" href="favicon.ico" rel="shortcut icon" />

    <link rel="stylesheet" type="text/css" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../resources/font/font-awesome/css/all.min.css">

    <link href="resources/css/login2/signin.css" rel="stylesheet">


</head>

<body class="text-center ">
    <div class="container-login">
        <?php
        include 'application/login2/body.php';
        ?>
    </div>
   
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if(localStorage.getItem("SesionExpirada")){
                alertError('Sesión cerrada por inactividad');
                localStorage.removeItem('SesionExpirada');
            }
        });
    </script>
    <script type="text/javascript" src="resources/js/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="resources/js/bootstrap.min.js"></script>
    <script type="text/javascript" src='application/js/login.js' ></script>
    <script type="text/javascript" src='application/js/alertas.js' ></script>
    <script type="text/javascript" src='resources/js/sweet-alert.js' ></script>
</body>

</html>