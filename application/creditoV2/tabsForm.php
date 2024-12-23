<?php
include '../../resources/template/credentials.php';
?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="formuIngComer-tab" data-bs-toggle="tab" href="#formuIngComer" role="tab" aria-controls="formuIngComer" aria-selected="true" onclick="newSolici(1,'Soliciud De Crédito', '')">Solicitud De Crédito</a>
    </li>
   
        <li class="nav-item">
            <a class="nav-link" id="formFina-tab" data-bs-toggle="tab" href="#formFina" role="tab" aria-controls="formFina" aria-selected="false" onclick="newSolici(2,'Información Financiera', '')">Inf.Financiera(Aux.)</a>
        </li>
  
    
        <li class="nav-item">
            <a class="nav-link" id="formAprob-tab" data-bs-toggle="tab" href="#formAprob" role="tab" aria-controls="formAprob" aria-selected="false" onclick="newSolici(3,'Aprobación De Crédito', '')">Aprobación de Crédito</a>
        </li>
</ul>

    <div class="tab-content mt-3" id="myTabContent">
        <div class="tab-pane fade show active" id="formuIngComer" role="tabpanel" aria-labelledby="formuIngComer-tab">
            <?php
            include 'form.php';
            ?>
        </div>
        <div class="tab-pane fade" id="formFina" role="tabpanel" aria-labelledby="formFina-tab">
            <?php include 'form4.php' ?>
        </div>
        <div class="tab-pane fade" id="formAprob" role="tabpanel" aria-labelledby="formAprob-tab">
            <?php include 'form5.php' ?>
        </div>
    </div>
   
<div class="row">
    <div class="col-md-12 col-sm-12" id="error-validation"></div>
</div>