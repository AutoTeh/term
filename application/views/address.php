<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open('reg', array('class' => 'form-horizontal'));
?>
<input type="hidden" name="group" value="" />
  <div class="control-group">
    <label class="control-label" for="region">Регион</label>
    <div class="controls">
      <div class="controls_region"><?PHP echo $region; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="area">Район</label>
    <div class="controls">
      <div class="controls_area"><?PHP echo $area; ?></div>
   </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="city">Город</label>
    <div class="controls">
      <div class="controls_city"><?PHP echo $city; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="city_area">Внутригородской район</label>
    <div class="controls">
      <div class="controls_city_area"><?PHP echo $city_area; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="locality">Населенный пункт</label>
    <div class="controls">
      <div class="controls_locality"><?PHP echo $locality; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="street">Улица</label>
    <div class="controls">
      <div class="controls_street"><?PHP echo $street; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="add_area">Доп. территория</label>
    <div class="controls">
      <div class="controls_add_area"><?PHP echo $add_area; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="street_add_area">Улица на доп. территории</label>
    <div class="controls">
      <div class="controls_street_add_area"><?PHP echo $street_add_area; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="house">Дом/квартира/номер офиса</label>
    <div class="controls">
      <input type="text" name="house" value="<?PHP echo $House; ?>">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Далее</button>
    </div>
  </div>
</form>