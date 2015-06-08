<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open($UrlPage, array('class' => 'form-horizontal'));
?>


<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#org" data-toggle="tab">Организация</a></li>
  <li><a href="#jaddress" data-toggle="tab">Юр. адрес <?php echo form_error('errJuristical'); ?></a></li>
  <li><a href="#paddress" data-toggle="tab">Почтовый адрес <?php echo form_error('errPost'); ?></a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="org">
    <div class="control-group">
    <label class="control-label" for="Name_Org">Название организации</label>
    <div class="controls">
      <input type="text" name="Name_Org" value="<?php echo set_value('Name_Org'); ?>" >
      <?php echo form_error('Name_Org'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="INN_Org">ИНН</label>
    <div class="controls">
      <input type="text" name="INN_Org" value="<?php echo set_value('INN_Org'); ?>" >
      <?php echo form_error('INN_Org'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="FIO_Boss_Org">ФИО руководителя</label>
    <div class="controls">
      <input type="text" name="FIO_Boss_Org" value="<?php echo set_value('FIO_Boss_Org'); ?>" >
      <?php echo form_error('FIO_Boss_Org'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="E_Mail_Org">E-mail</label>
    <div class="controls">
      <input type="text" name="E_Mail_Org" value="<?php echo set_value('E_Mail_Org'); ?>" >
      <?php echo form_error('E_Mail_Org'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Phone_Boss_Org">Телефон руководителя</label>
    <div class="controls">
      <input type="text" name="Phone_Boss_Org" value="<?php echo set_value('Phone_Boss_Org'); ?>" >
      <?php echo form_error('Phone_Boss_Org'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="type_rank_boss">Должность</label>
    <div class="controls">
      <?php echo $ID_Type_Rank_Org; ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="type_org">Тип организации</label>
    <div class="controls">
      <?php echo $ID_Type_Org; ?>
    </div>
  </div>
  </div>

  <div class="tab-pane" id="jaddress">
    <div class="control-group">
    <label class="control-label" for="region">Регион</label>
    <div class="controls">
      <div class="controls_Juristical_region"><?PHP echo $Juristical_region; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="area">Район</label>
    <div class="controls">
      <div class="controls_Juristical_area"><?PHP echo $Juristical_area; ?></div>
   </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="city">Город</label>
    <div class="controls">
      <div class="controls_Juristical_city"><?PHP echo $Juristical_city; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="city_area">Внутригородской район</label>
    <div class="controls">
      <div class="controls_Juristical_city_area"><?PHP echo $Juristical_city_area; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="locality">Населенный пункт</label>
    <div class="controls">
      <div class="controls_Juristical_locality"><?PHP echo $Juristical_locality; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="street">Улица</label>
    <div class="controls">
      <div class="controls_Juristical_street"><?PHP echo $Juristical_street; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="add_area">Доп. территория</label>
    <div class="controls">
      <div class="controls_Juristical_add_area"><?PHP echo $Juristical_add_area; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="street_add_area">Улица на доп. территории</label>
    <div class="controls">
      <div class="controls_Juristical_street_add_area"><?PHP echo $Juristical_street_add_area; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Home_Juristical_Address_Org">Дом/квартира/номер офиса</label>
    <div class="controls">
      <input type="text" name="Home_Juristical_Address_Org" value="<?PHP echo set_value('Home_Juristical_Address_Org'); ?>">
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
    <label class="control-label" for="Home_Post_Address_Org">Дом/квартира/номер офиса</label>
    <div class="controls">
      <input type="text" name="Home_Post_Address_Org" value="<?PHP echo set_value('Home_Post_Address_Org'); ?>">
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
