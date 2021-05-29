<?php

use yii\helpers\Html;


$country = [];

foreach ($CountryData as $item) {
    $country = $item;
}

$this->title = $country['Title'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="promo">
    <img src="images/Country/Promo/<?= $country['PromoPath']; ?>" width="100%" alt="Изображение не найдено">
</div>
<div class="country-details">
    <div class="country-header">
        <?= $country['Title']; ?>
        <?= Html::img('images/Country/' . $country['FlagPath'], ['class' => 'image-country']); ?>
    </div>
    <h1> Курорты </h1>
    <div class="resort">
        <?php
        foreach ($ResortsData as $item) {

            echo '<div class="country-container">';

            echo Html::a(Html::img('images/Resorts/'.$item['ResortPicture']), ['site/resortdetails', 'country' => $item['idCountry'], 'resort' => $item['idResorts']]);
            echo $item['Title'];

            echo '</a></div>';
        }
        ?>
    </div>
    <div class="text">
    <?php include '../views/Files/TurkeyDetails.php'?>
    </div>
</div>






