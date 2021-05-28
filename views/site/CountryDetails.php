<?php

use yii\bootstrap\Carousel;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Countries;
use app\models\Cities;

//use app\models\Resorts;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use dosamigos\datepicker\DatePicker;

$this->title = 'Страна';

$country= [];
foreach ($CountryData as $item) {
  $country =$item;
}

?>
<img src="images/Country/<?=$country['PromoPath'] ;?>" width="100%" alt="Изображение не найдено">
<div class="country-details">

    <?= $country['PromoPath'] ;?>
</div>






