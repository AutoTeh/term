<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open($UrlPage, array('class' => 'form-horizontal'));
?>


<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#org" data-toggle="tab">ТСТ</a></li>
  <li><a href="#paddress" data-toggle="tab">Почтовый адрес <?php echo form_error('errPost'); ?></a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="org">
    <div class="control-group">
    <label class="control-label" for="Name_TCT">Название ТСТ</label>
    <div class="controls">
      <input type="text" name="Name_TCT" value="<?php echo $Name_TCT; ?>" >
      <?php echo form_error('Name_TCT'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Mode_TCT">Режим работы</label>
    <div class="controls">
      <textarea name="Mode_TCT" cols="40" rows="3" wrap="soft | hard"><?php echo $Mode_TCT; ?></textarea>
      <?php echo form_error('Mode_TCT'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Phone_TCT">Телефон</label>
    <div class="controls">
      <input type="text" name="Phone_TCT" value="<?php echo $Phone_TCT; ?>" >
      <?php echo form_error('Phone_TCT'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Kind_Activity">Вид деятельности</label>
    <div class="controls">
      <input type="text" name="Kind_Activity" value="<?php echo $Kind_Activity; ?>" >
      <?php echo form_error('Kind_Activity'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Contact_Name_TCT">Контактное лицо(ФИО)</label>
    <div class="controls">
      <input type="text" name="Contact_Name_TCT" value="<?php echo $Contact_Name_TCT; ?>" >
      <?php echo form_error('Contact_Name_TCT'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Num_Merchant_TCT">Номер мерчанта</label>
    <div class="controls">
      <input type="text" name="Num_Merchant_TCT" value="<?php echo $Num_Merchant_TCT; ?>" >
      <?php echo form_error('Num_Merchant_TCT'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Type_Kategoria_TCT">Категория ТСТ</label>
    <div class="controls">
      <?php echo $ID_Type_Kategoria_TCT; ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Type_MCC_TCT">МСС</label>
    <div class="controls">
      <?php echo $ID_Type_MCC_TCT; ?>
    </div>
  </div>
  </div>

  <div class="tab-pane" id="paddress">
    <div class="control-group">
    <label class="control-label" for="Post_region">Регион</label>
    <div class="controls">
      <div class="controls_Post_region"><?PHP echo $Post_region; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Post_area">Район</label>
    <div class="controls">
      <div class="controls_Post_area"><?PHP echo $Post_area; ?></div>
   </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Post_city">Город</label>
    <div class="controls">
      <div class="controls_Post_city"><?PHP echo $Post_city; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Post_city_area">Внутригородской район</label>
    <div class="controls">
      <div class="controls_Post_city_area"><?PHP echo $Post_city_area; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Post_locality">Населенный пункт</label>
    <div class="controls">
      <div class="controls_Post_locality"><?PHP echo $Post_locality; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Post_street">Улица</label>
    <div class="controls">
      <div class="controls_Post_street"><?PHP echo $Post_street; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Post_add_area">Доп. территория</label>
    <div class="controls">
      <div class="controls_Post_add_area"><?PHP echo $Post_add_area; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Post_street_add_area">Улица на доп. территории</label>
    <div class="controls">
      <div class="controls_Post_street_add_area"><?PHP echo $Post_street_add_area; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Home_Address_TCT">Дом/квартира/номер офиса</label>
    <div class="controls">
      <input type="text" name="Home_Address_TCT" value="<?PHP echo $Home_Address_TCT; ?>">
    </div>
  </div>
  </div>
</div>

  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Сохранить</button>
    </div>
  </div>

</form>
