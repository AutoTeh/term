<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open('reg', array('class' => 'form-horizontal'));
?>
  <div class="control-group">
    <label class="control-label" for="name_tct">Название ТСТ</label>
    <div class="controls">
      <input type="text" name="name_tct" value="<?php echo set_value('name_tct'); ?>" >
      <?php echo form_error('name_tct'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="type_mcc_tct">МСС</label>
    <div class="controls">
      <input type="text" name="type_mcc_tct" value="<?php echo set_value('type_mcc_tct'); ?>" >
      <?php echo form_error('type_mcc_tct'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="phone_tct">Телефон</label>
    <div class="controls">
      <input type="text" name="phone_tct" value="<?php echo set_value('phone_tct'); ?>" >
      <?php echo form_error('phone_tct'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="contact_name_tct">Контактное лицо(ФИО)</label>
    <div class="controls">
      <input type="text" name="contact_name_tct" value="<?php echo set_value('contact_name_tct'); ?>" >
      <?php echo form_error('contact_name_tct'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="num_merchant_tct">Номер мерчанта</label>
    <div class="controls">
      <input type="text" name="num_merchant_tct" value="<?php echo set_value('num_merchant_tct'); ?>" >
      <?php echo form_error('num_merchant_tct'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="type_kategoria_tct">Категория ТСТ</label>
    <div class="controls">
      <input type="text" name="type_kategoria_tct" value="<?php echo set_value('type_kategoria_tct'); ?>" >
      <?php echo form_error('type_kategoria_tct'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="mode_tct">Режим работы</label>
    <div class="controls">
      <input type="text" name="mode_tct" value="<?php echo set_value('mode_tct'); ?>" >
      <?php echo form_error('mode_tct'); ?>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Далее</button>
    </div>
  </div>
</form>