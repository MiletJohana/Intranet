<div class="col-md-3">
      <input type="text" class="form-control" id="pun_u" name="" value="">
</div>
<div class="col-md-2">
      <input type="text" class="form-control" id="ciu" name="" value="">
</div>
<div class="col-md-2">
      <input type="number" class="form-control" id="tel_fij" name="" value="">
</div>
<div class="col-md-2">
      <select type="time" class="form-control" id="hor" name="hor" value=>
            <option value="">Horario</option>
            <?php for ($i = 1; $i <= 24; $i++) { ?>
                  <option value="<?php $i ?>"><?php $i ?></option>
            <?php } ?>
      </select>
</div>
<div class="col-md-2">
      <select type="text" class="form-control" id="hora" name="hora" value="">
            <option value="">Horario</option>
            <?php for ($i = 1; $i <= 24; $i++) { ?>
                  <option value="<?php $i ?>"><?php $i ?></option>
            <?php } ?>
      </select>
</div>