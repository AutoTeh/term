<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open('reg', array('class' => 'form-horizontal'));
?>
  <div class="control-group">
    <label class="control-label" for="num_dogovor">Номер договора</label>
    <div class="controls">
      <input type="text" name="num_dogovor" value="<?php echo set_value('num_dogovor'); ?>" >
      <?php echo form_error('num_dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="date_dogovor">Дата договора</label>
    <div class="controls">
      <input type="text" name="date_dogovor" value="<?php echo set_value('date_dogovor'); ?>" >
      <?php echo form_error('date_dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="diskont">Дисконт</label>
    <div class="controls">
      <input type="text" name="diskont" value="<?php echo set_value('diskont'); ?>" >
      <?php echo form_error('diskont'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="date_diskont">Дата дисконта</label>
    <div class="controls">
      <input type="text" name="date_diskont" value="<?php echo set_value('date_diskont'); ?>" >
      <?php echo form_error('date_diskont'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inter_card">Международные карты</label>
    <div class="controls">
      <input type="text" name="inter_card" value="<?php echo set_value('inter_card'); ?>" >
      <?php echo form_error('inter_card'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="debet_card">Дебетовые</label>
    <div class="controls">
      <input type="text" name="debet_card" value="<?php echo set_value('debet_card'); ?>" >
      <?php echo form_error('debet_card'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="thank">Спасибо</label>
    <div class="controls">
      <input type="text" name="thank" value="<?php echo set_value('thank'); ?>" >
      <?php echo form_error('thank'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="money_movement">Оборот</label>
    <div class="controls">
      <input type="text" name="money_movement" value="<?php echo set_value('money_movement'); ?>" >
      <?php echo form_error('money_movement'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="money_income">Доход</label>
    <div class="controls">
      <input type="text" name="money_income" value="<?php echo set_value('money_income'); ?>" >
      <?php echo form_error('money_income'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="date_dissolution">Дата расторжения</label>
    <div class="controls">
      <input type="text" name="date_dissolution" value="<?php echo set_value('date_dissolution'); ?>" >
      <?php echo form_error('date_dissolution'); ?>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Зарегистрироваться</button>
    </div>
  </div>
</form>