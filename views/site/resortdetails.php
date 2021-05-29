<?php

use yii\helpers\Html;

$resorts = [];
foreach ($ResortData as $item) {
    $resorts = $item;
}

$this->title = $resorts['Title'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promo">
    <img src="images/Resorts/<?= $resorts['ResortPicture']; ?>" width="100%" alt="Изображение не найдено">
</div>
<div class="resort-details">
    <div class="resort-header">
        <?= $resorts['Title']; ?>
        <?= Html::img('images/Resorts/' . $resorts['blazon'], ['class' => 'image-resort']); ?>
    </div>
    <div class="text">
<?php include '../views/Files/TurkeyResorts.php'?>
    </div>
</div>