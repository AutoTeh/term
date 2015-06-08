<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open($UrlPage, array('class' => 'form-horizontal'));
?>
  <div class="control-group">
    <label class="control-label" for="Num_Dogovor">Номер договора</label>
    <div class="controls">
      <input type="text" name="Num_Dogovor" value="<?php echo set_value('Num_Dogovor'); ?>" >
      <?php echo form_error('Num_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date_Dogovor">Дата договора</label>
    <div class="controls">
      <input type="date" name="Date_Dogovor" value="<?php echo set_value('Date_Dogovor'); ?>" >
      <?php echo form_error('Date_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Diskont_Dogovor">Дисконт</label>
    <div class="controls">
      <input type="text" name="Diskont_Dogovor" value="<?php echo set_value('Diskont_Dogovor'); ?>" >
      <?php echo form_error('Diskont_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date_Diskont_Dogovor">Дата дисконта</label>
    <div class="controls">
      <input type="date" name="Date_Diskont_Dogovor" value="<?php echo set_value('Date_Diskont_Dogovor'); ?>" >
      <?php echo form_error('Date_Diskont_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Internat_Card_Dogovor">Международные карты</label>
    <div class="controls">
      <input type="text" name="Internat_Card_Dogovor" value="<?php echo set_value('Internat_Card_Dogovor'); ?>" >
      <?php echo form_error('Internat_Card_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Debet_Card_Dogovor">Дебетовые</label>
    <div class="controls">
      <input type="text" name="Debet_Card_Dogovor" value="<?php echo set_value('Debet_Card_Dogovor'); ?>" >
      <?php echo form_error('Debet_Card_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Thank_Dogovor">Спасибо</label>
    <div class="controls">
      <input type="text" name="Thank_Dogovor" value="<?php echo set_value('Thank_Dogovor'); ?>" >
      <?php echo form_error('Thank_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Money_Movement_Dogovor">Оборот</label>
    <div class="controls">
      <input type="text" name="Money_Movement_Dogovor" value="<?php echo set_value('Money_Movement_Dogovor'); ?>" >
      <?php echo form_error('Money_Movement_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Money_Income_Dogovor">Доход</label>
    <div class="controls">
      <input type="text" name="Money_Income_Dogovor" value="<?php echo set_value('Money_Income_Dogovor'); ?>" >
      <?php echo form_error('Money_Income_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date_Dissolution_Dogovor">Дата расторжения</label>
    <div class="controls">
      <input type="date" name="Date_Dissolution_Dogovor" value="<?php echo set_value('Date_Dissolution_Dogovor'); ?>" >
      <?php echo form_error('Date_Dissolution_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Сохранить</button>
    </div>
  </div>
</form>