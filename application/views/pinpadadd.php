<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open($UrlPage, array('class' => 'form-horizontal'));
?>
  <div class="control-group">
    <label class="control-label" for="Type_PinPad">Модель пин-пада</label>
    <div class="controls">
      <?php echo $ID_Type_PinPad; ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="SN_Num_PinPad">Серийный номер</label>
    <div class="controls">
      <input type="text" name="SN_Num_PinPad" value="<?php echo set_value('SN_Num_PinPad'); ?>" >
      <?php echo form_error('SN_Num_PinPad'); ?>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Сохранить</button>
    </div>
  </div>
</form>