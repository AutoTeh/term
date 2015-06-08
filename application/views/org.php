<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open('reg', array('class' => 'form-horizontal'));
?>
  <div class="control-group">
    <label class="control-label" for="name_org">Название организации</label>
    <div class="controls">
      <input type="text" name="name_org" value="<?php echo set_value('name_org'); ?>" >
      <?php echo form_error('name_org'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="INN">ИНН</label>
    <div class="controls">
      <input type="text" name="INN" value="<?php echo set_value('INN'); ?>" >
      <?php echo form_error('INN'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="FIO_Boss">ФИО руководителя</label>
    <div class="controls">
      <input type="text" name="FIO_Boss" value="<?php echo set_value('FIO_Boss'); ?>" >
      <?php echo form_error('FIO_Boss'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="E_mail">E-mail</label>
    <div class="controls">
      <input type="text" name="E_mail" value="<?php echo set_value('E_mail'); ?>" >
      <?php echo form_error('E_mail'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="phone_boss">Телефон руководителя</label>
    <div class="controls">
      <input type="text" name="phone_boss" value="<?php echo set_value('phone_boss'); ?>" >
      <?php echo form_error('phone_boss'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="type_rank_boss">Должность</label>
    <div class="controls">
      <input type="text" name="type_rank_boss" value="<?php echo set_value('type_rank_boss'); ?>" >
      <?php echo form_error('type_rank_boss'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="type_org">Тип организации</label>
    <div class="controls">
      <input type="text" name="type_org" value="<?php echo set_value('type_org'); ?>" >
      <?php echo form_error('type_org'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Juristical_Address_Org">Юридический адрес</label>
    <div class="controls">
      <input type="text" name="Juristical_Address_Org" value="<?php echo set_value('Juristical_Address_Org'); ?>" >
      <?php echo form_error('Juristical_Address_Org'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Home_Juristical_Address_Org">Юридический адрес(дом)</label>
    <div class="controls">
      <input type="text" name="Home_Juristical_Address_Org" value="<?php echo set_value('Home_Juristical_Address_Org'); ?>" >
      <?php echo form_error('Home_Juristical_Address_Org'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Post_Address_Org">Почтовый адрес</label>
    <div class="controls">
      <input type="text" name="Post_Address_Org" value="<?php echo set_value('Post_Address_Org'); ?>" >
      <?php echo form_error('Post_Address_Org'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Home_Post_Address_Org">Почтовый адрес(дом)</label>
    <div class="controls">
      <input type="text" name="Home_Post_Address_Org" value="<?php echo set_value('Home_Post_Address_Org'); ?>" >
      <?php echo form_error('Home_Post_Address_Org'); ?>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">далее</button>
    </div>
  </div>
</form>