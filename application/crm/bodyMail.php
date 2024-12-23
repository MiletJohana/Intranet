<?php $body = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
    <style>
        @font-face {
            font-family: "Product-Sans";
            src: url("https://intranet.masterquimica.com/resources/font/product-sans/Product%20Sans%20Regular.ttf");
        }

        .product-sans {
            font-family: "Product-Sans";
        }
    </style>
</head>

<body class="product-sans">
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-4 col-12 offset-md-4 px-5 pt-5 text-center">
                <img src="https://intranet.masterquimica.com/resources/img/Logo_Master.png" class="img-fluid" alt="Logotipo Master Quimica">
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-md-6 col-12 offset-md-3 text-center">
                <h1>' . $app . '</h1>
            </div>
        </div>

        <div class="row pt-2">
            <div class="col-10 offset-md-1 text-center">
                <div class="card">
                    <div class="card-body">
                        <p class="h5">'. $message . '</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row pt-2">
        <div class="col-12 text-center">
            <div class="text-center">
                <a href="https://intranet.masterquimica.com/index.php" class="btn btn-danger disabled" style="padding-top: 0.45em;" target="_blank">
                    <img src="https://intranet.masterquimica.com/resources/img/logo1.png" style="width: 1.5em; height: 1.5em;" alt="">
                </a>
            </div>
        </div>
    </div>
</body>

</html>';