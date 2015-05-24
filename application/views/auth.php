<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open('auth', array('class' => 'form-horizontal'));
?>
  <div class="control-group">
    <label class="control-label" for="login">Логин</label>
    <div class="controls">
      <input type="text" name="login" placeholder="Логин">
      <?php echo form_error('login'); ?></br>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="pass">Пароль</label>
    <div class="controls">
      <input type="password" name="pass" placeholder="Пароль">
      <?php echo form_error('pass'); ?></br>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Войти</button>
    </div>
  </div>
</form>