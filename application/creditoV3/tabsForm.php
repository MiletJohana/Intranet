<?php
include '../../resources/template/credentials.php';
?>
<ul class="nav nav-underline" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="formuIngComer-tab" data-bs-toggle="tab" href="#formuIngComer" role="tab" aria-controls="formuIngComer" aria-selected="true">Solicitud De Crédito</a>
    </li>
    <?php if ((isset($_POST["id_est"]) && $_POST["id_est"] == 1) && (isset($_POST['rol']) && $_POST['rol'] == 200)) { ?>
        <li class="nav-item">
            <a class="nav-link" id="formFina-tab" data-bs-toggle="tab" href="#formFina" role="tab" aria-controls="formFina" aria-selected="false">Inf.Financiera(Aux.)</a>
        </li>
    <?php } else if ((isset($_POST["id_est"]) && $_POST["id_est"] == 2) && (isset($_POST['rol']) && ($_POST['rol'] == 300 || $_POST['rol'] == 400))) { ?>
        <li class="nav-item">
            <a class="nav-link" id="formFina-tab" data-bs-toggle="tab" href="#formFina" role="tab" aria-controls="formFina" aria-selected="false">Inf.Financiera(Aux.)</a>
        </li>
    <?php } else if (isset($_POST["id_est"]) && ($_POST["id_est"] == 2 || $_POST["id_est"] == 3 || $_POST["id_est"] == 4 || $_POST["id_est"] == 8)) { ?>
        <li class="nav-item">
            <a class="nav-link" id="formFina-tab" data-bs-toggle="tab" href="#formFina" role="tab" aria-controls="formFina" aria-selected="false">Inf.Financiera(Aux.)</a>
        </li>
    <?php }
    if ((isset($_POST["id_est"]) && $_POST["id_est"] == 2) && (isset($_POST['rol']) && ($_POST['rol'] == 300 || $_POST['rol'] == 400))) { ?>
        <li class="nav-item">
            <a class="nav-link" id="formAprob-tab" data-bs-toggle="tab" href="#formAprob" role="tab" aria-controls="formAprob" aria-selected="false">Aprobación de Crédito</a>
        </li>
    <?php } else if (isset($_POST["id_est"]) && ($_POST["id_est"] == 3 || $_POST["id_est"] == 4)) { ?>
        <li class="nav-item">
            <a class="nav-link" id="formAprob-tab" data-bs-toggle="tab" href="#formAprob" role="tab" aria-controls="formAprob" aria-selected="false">Aprobación de Crédito</a>
        </li>
    <?php } ?>
</ul>
<form role="form" id="form-crm">
    <div class="tab-content mt-3" id="myTabContent">
        <div class="tab-pane fade show active" id="formuIngComer" role="tabpanel" aria-labelledby="formuIngComer-tab">
            <?php
            include 'form.php';
            include 'form2.php';
            include 'form3.php';
            ?>
        </div>
        <div class="tab-pane fade" id="formFina" role="tabpanel" aria-labelledby="formFina-tab">
            <?php include 'form4.php' ?>
        </div>
        <div class="tab-pane fade" id="formAprob" role="tabpanel" aria-labelledby="formAprob-tab">
            <?php include 'form5.php' ?>
        </div>
    </div>
    <input type="hidden" id="reg" value="<?php echo $_SESSION['reg']; ?>">
    <input type="hidden" id="id" value="<?php echo $_SESSION['id']; ?>">
    <input type="hidden" id="rol" value="<?php echo $_SESSION['rol']; ?>">
</form>
<div class="row">
    <div class="col-12 col-sm-12 mb-3" id="error-validation"></div>
</div>