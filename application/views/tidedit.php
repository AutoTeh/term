<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open($UrlPage, array('class' => 'form-horizontal'));
?>
  <div class="control-group">
    <label class="control-label" for="Num_TID">TID</label>
    <div class="controls">
      <input type="text" name="Num_TID" value="<?php echo $Num_TID; ?>" >
      <?php echo form_error('Num_TID'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Kod_TID">Код активации</label>
    <div class="controls">
      <input type="text" name="Kod_TID" value="<?php echo $Kod_TID; ?>" >
      <?php echo form_error('Kod_TID'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date_Reg_CA_TID">Дата регистрации ЦА</label>
    <div class="controls">
      <input type="date" name="Date_Reg_CA_TID" value="<?php echo $Date_Reg_CA_TID; ?>" >
      <?php echo form_error('Date_Reg_CA_TID'); ?>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Сохранить</button>
    </div>
  </div>
</form>