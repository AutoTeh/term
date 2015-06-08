<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open($UrlPage, array('class' => 'form-horizontal'));
?>
  <div class="control-group">
    <label class="control-label" for="Type_Terminal">Модель терминала</label>
    <div class="controls">
      <?php echo $ID_Type_Terminal; ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="SN_Num_Terminal">Серийный номер</label>
    <div class="controls">
      <input type="text" name="SN_Num_Terminal" value="<?php echo $SN_Num_Terminal; ?>" >
      <?php echo form_error('SN_Num_Terminal'); ?>
    </div>
  </div>
  <div class="control-group">
  	<label class="control-label" for="Inv_Num_Terminal">Инвентарный номер</label>
    <div class="controls">
      <input type="text" name="Inv_Num_Terminal" value="<?php echo $Inv_Num_Terminal; ?>" >
      <?php echo form_error('Inv_Num_Terminal'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Price_Terminal">Цена</label>
    <div class="controls">
      <input type="text" name="Price_Terminal" value="<?php echo $Price_Terminal; ?>" >
      <?php echo form_error('Price_Terminal'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date_Terminal">Дата</label>
    <div class="controls">
      <input type="date" name="Date_Terminal" value="<?php echo $Date_Terminal; ?>" >
      <?php echo form_error('Date_Terminal'); ?>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Сохранить</button>
    </div>
  </div>
</form>