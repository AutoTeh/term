<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form method="post" action="../auth" class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="login">�����</label>
    <div class="controls">
      <input type="text" id="login" placeholder="�����">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="pass">������</label>
    <div class="controls">
      <input type="password" id="pass" placeholder="������">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">�����</button>
    </div>
  </div>
</form>