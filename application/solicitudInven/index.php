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

    <title>Intranet | Solicitud</title>

    <?php
    include('../../resources/template/head.php');
    ?>
    <link rel="stylesheet" href="../../resources/css/inventarios/inventarios.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.3.3/css/searchPanes.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/2.1.0/css/select.dataTables.css">
</head>

<body>
    <div class="container-fluid">
        <?php
            include('../../resources/template/navbar.php');
        ?>
        <main>
            <?php include('content.php'); ?>
            <div id="content-table">
                <?php
                if (isset($_GET['table']) && $_GET['table'] == 1) {
                    include('tabla.php');
                } else if (isset($_GET['table']) && $_GET['table'] == 2) {
                    include('tabla2.php');
                } else if (isset($_GET['table']) && $_GET['table'] == 3) {
                    include('tabla3.php');
                } ?>
            </div>
            <?php include('../../resources/template/modals.php');
            ?>
        </main>
    </div>
    <script type="text/javascript" src="../js/inventarios.js"></script>
    <?php
    include('../../resources/template/scripts.php');
    ?>

    <script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.5.0/js/dataTables.rowGroup.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.5.0/js/rowGroup.dataTables.js"></script>
    <script>
        const url = "https://tiendamq-com.myshopify.com/admin/api/2024-10/graphql.json"; // Asegúrate de usar la versión correcta de la API
const query = `
{
  product(id: "gid://shopify/Product/47345908089025") {
    id
    variants(first: 10) {
      edges {
        node {
          id
          barcode
          title
        }
      }
    }
  }
}`;

fetch(url, {
  method: "POST",
  headers: {
    "Content-Type": "application/json",
    "X-Shopify-Access-Token": "TU_ACCESS_TOKEN",
  },
  body: JSON.stringify({ query }),
})
  .then((response) => response.json())
  .then((data) => {
    console.log("EAN (Barcode):", data.data.product.variants.edges[0].node.barcode);
  })
  .catch((error) => console.error("Error:", error));
    </script>
</body>

</html>

