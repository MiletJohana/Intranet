<div class="col-md-3 mb-3">
      <input type="text" class="form-control" id="pun_u" name="" value="">
</div>
<div class="col-md-2 mb-3">
      <input type="text" class="form-control" id="ciu" name="" value="">
</div>
<div class="col-md-2 mb-3">
      <input type="number" class="form-control" id="tel_fij" name="" value="">
</div>
<div class="col-md-2 mb-3">
      <select type="time" class="form-select" id="hor" name="hor" value=>
            <option value="">Horario</option>
            <?php for ($i = 1; $i <= 24; $i++) { ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
      </select>
</div>
<div class="col-md-2 mb-3">
      <select type="text" class="form-select" id="hora" name="hora" value="">
            <option value="">Horario</option>
            <?php for ($i = 1; $i <= 24; $i++) { ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
      </select>
</div>
<?php if($_POST['resp'] == 2){ ?>
<div class="col-md-1 col-sm-12 d-flex mb-3" id="btnMen11">
      <button id="btnMen2" type="button" class="btn btn-sm btn-danger" onclick="remove(2);">
            <i class="fa-solid fa-trash" ></i>
      </button>
</div> 
<?php } else if($_POST['resp'] == 3){ ?>
<div class="col-md-1 col-sm-12 d-flex mb-3" id="btnMen22">
      <button id="btnMen3" type="button" class="btn btn-sm btn-danger" onclick="remove(3);">
            <i class="fa-solid fa-trash" ></i>
      </button>
</div> 
<?php } ?>