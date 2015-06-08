<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open($UrlPage, array('class' => 'form-horizontal'));
?>
  <div class="control-group">
    <label class="control-label" for="Type_Operator_SIM">Оператор</label>
    <div class="controls">
      <?php echo $ID_Type_Operator_SIM; ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="SN_Num_SIM">Серийный номер</label>
    <div class="controls">
      <input type="text" name="SN_Num_SIM" value="<?php echo $SN_Num_SIM; ?>" >
      <?php echo form_error('SN_Num_SIM'); ?>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Сохранить</button>
    </div>
  </div>
</form>