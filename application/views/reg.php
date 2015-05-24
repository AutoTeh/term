<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open('reg', array('class' => 'form-horizontal'));
?>
  <div class="control-group">
    <label class="control-label" for="login">Логин</label>
    <div class="controls">
      <input type="text" name="login" placeholder="Логин" value="<?php echo set_value('login'); ?>" >
      <?php echo form_error('login'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="pass">Пароль</label>
    <div class="controls">
      <input type="password" name="pass" placeholder="Пароль" value="<?php echo set_value('pass'); ?>" >
      <?php echo form_error('pass'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="fio">ФИО</label>
    <div class="controls">
      <input type="text" name="fio" placeholder="ФИО" value="<?php echo set_value('fio'); ?>">
      <?php echo form_error('fio'); ?></br>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="e_mail">E-mail</label>
    <div class="controls">
      <input type="text" name="e_mail" placeholder="E-mail" "<?php echo set_value('e_mail'); ?>">
      <?php echo form_error('e_mail'); ?>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Зарегистрироваться</button>
    </div>
  </div>
</form>