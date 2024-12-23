<?php
include('../../conexion.php');

if($_POST['opcion'] == 1){
    if (isset($_POST['id_cli'])) {
        $id_cli = $_POST['id_cli'];
        $sql = "SELECT * FROM contactos WHERE id_cli = '" . $id_cli . "'";
        $query = $conexion->query($sql);
    }
    
    ?>
   
   <select class="form-select" id="nom_com" name="nom_com" onchange="selectContact(this.value);" required>
            <option value="">Seleccione</option>
        <?php  while ($rContactos = $query->fetch(PDO::FETCH_ASSOC)) { ?>
            <option value="<?php echo $rContactos['id_cont']; ?>"><?php echo $rContactos['nom_cont']; ?></option>
        <?php } ?>
    </select>
    
  
    <button type="button" id="btn_addContat" onclick="crearContactCred(1, <?php echo $id_cli ?>, '', '', 5);" class="btn btn-danger btn-sm ms-2">
        <i class="fa-solid fa-plus"></i>
    </button>

   


<?php
} else if($_POST['opcion'] == 2){
    if (isset($_POST['id_cont'])) {
        $id_cont = $_POST['id_cont'];
        $sql1 = "SELECT * FROM contactos WHERE id_cont = '" . $id_cont . "'";
        $query1 = $conexion->query($sql1);

        $result=$query1->fetch(PDO::FETCH_ASSOC);

		$datos=array("id_cont"=>$result['id_cont'],
                     "nom_cont"=>$result['nom_cont'],
					 "tel_cont"=>$result['tel_cont'],
					 "eml_cont"=>$result['eml_cont'],
					 "car_cont"=>$result['car_cont']
		);
		
        echo json_encode($datos);
    }
    
} else if($_POST['opcion'] == 3){
    if (isset($_POST['id_cli']) && isset($_POST['id_sol'])) {

        $sqlInfoSol = "SELECT id_cont FROM cre_solicitud WHERE id_sol = '" . $_POST['id_sol'] . "';";
        $queryInfoSol = $conexion->query($sqlInfoSol);
        while ($rInfoSol = $queryInfoSol->fetch(PDO::FETCH_OBJ)) {
            $infoSolicitud = $rInfoSol;
            break;
        }
        $id_cont = $infoSolicitud->id_cont;
        $id_cli = $_POST['id_cli'];
        $sql3 = "SELECT * FROM contactos WHERE id_cli = '" . $id_cli . "' AND id_cont = '" . $id_cont . "'";
        $query3 = $conexion->query($sql3);
        while ($rCont3 = $query3->fetch(PDO::FETCH_OBJ)) {
            $contacto3 = $rCont3;
            break;
        }

        $sql33 = "SELECT * FROM contactos WHERE id_cli = '" . $id_cli . "' AND id_cont != '" . $id_cont . "'";
        $query33 = $conexion->query($sql33);
    }
    
    ?>
   
   <select class="form-select" id="nom_com" name="nom_com" onchange="selectContact(this.value);" required>
        <option value="<?php echo $contacto3->id_cont; ?>"><?php echo $contacto3->nom_cont; ?></option>
        <?php  while ($rContactos33 = $query33->fetch(PDO::FETCH_ASSOC)) { ?>
            <option value="<?php echo $rContactos33['id_cont']; ?>"><?php echo $rContactos33['nom_cont']; ?></option>
        <?php } ?>
    </select>
    
  
    <button type="button" id="btn_addContat" onclick="crearContactCred(1, <?php echo $id_cli; ?>, <?php echo $_POST['id_sol']; ?>, <?php echo $_POST['id_est']; ?>, 6);" class="btn btn-danger btn-sm ms-2">
        <i class="fa-solid fa-plus"></i>
    </button>
<?php } ?>

