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

/* @var $this yii\web\View */

$this->title = 'Главная';
/* echo  Yii::$app->user->identity->Name ;
echo date('Y') - Yii::$app->user->identity->DateBirth;*/
?>

<?php
Yii::$app->user->isGuest ? $_COOKIE['Sub'] = true : $_COOKIE['Sub'] = false;
$CityDeparture  = ArrayHelper::map(Cities::find()->all(), 'idCity', 'Title');
$CountryTarget  = ArrayHelper::map(Countries::find()->all(), 'idCountry', 'Title');
$carousel = [

    [
        'content' => '<img src="Images/Slider1.jpg">',
        'caption' => '',
        'options' => ['class' => 'my-class']
    ],
    [
        'content' => '<img src="images/slider2.jpg"/>',
        'caption' => '',
        'options' => ['style' => 'background-size:cover ']
    ]
    ,
    [
        'content' => '<img src="images/slider3.jpg" alt="sd"/>',
        'caption' => '',
        'options' => ['class' => 'my-class']
    ]

]; ?>

<div class="custom-carousel" id="carous">
    <?= Carousel::widget([
        'items' => $carousel,
        'options' => ['class' => 'carousel slide', 'data-interval' => '4000', 'style' => 'background-size:cover !important'],
        'controls' => [
            '<span class="glyphicon glyphicon-chevron-left"  aria-hidden="true"></span>',
            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
        ]
    ]); ?>
    <div class="middle">
        <div id="simple-msg"  hidden>
            <code class="alert alert-success">Данные успешно отправлены, с вами свяжутся в ближайшее время<span class="close-alert">&times;</span></code>
        </div>
        <div id="simple-msg-form"  hidden>
            <code class="alert alert-success">Заполните все поля </code>
        </div>
        <div class="form-reservation" id="res">
            <?php
            $form = ActiveForm::begin([
                'id' => 'FormAjax',
                'fieldConfig' => [
                    'template' => "{label}<div class='col-lg-12' style=''>{input}</div><div style=height: auto;margin-left: auto;margin-right: auto'>{error}</div>",
                    //  'labelOptions' => ['style' => 'display:flex;justify-content:center;color:white;'],
                ],
            ]);
            ?>
            <?= $form->field($model, 'idCity')->dropDownList($CityDeparture, ['prompt' => 'Город вылета', 'id' => 'City', 'autofocus' => true]) ?>
            <?= $form->field($model, 'idCountry')->dropDownList($CountryTarget, ['prompt' => 'Страна', 'id' => 'cat-id']) ?>
            <?= $form->field($model, 'idResort')->widget(DepDrop::class, [
                'type' => DepDrop::TYPE_DEFAULT,
                'options' => ['id' => 'subcat-id'],
                'pluginOptions' => [
                    'depends' => ['cat-id'],
                    'emptyMsg' => 'Нет данных',
                    'placeholder' => 'Курорт',
                    'url' => Url::to(['/site/child-drop']),
                    'initialize' => true,
                ]
            ]); ?>

            <?= $form->field($model, 'LengthOfNights')->textInput(['style' => '']) ?>
            <?= $form->field($model, 'NumberOfPeople')->textInput([]) ?>
            <?php if (!Yii::$app->user->isGuest) { ?>
                <div class="form-group">
                    <?= Html::submitButton('Забронировать', ['class' => 'btn btn-custom', 'name' => 'contact-button', 'id' => 'Sub']) ?>
                </div>
            <?php } ?>

            <?php if (Yii::$app->user->isGuest) { ?>
                <button type="button" id="myBtn" class="btn btn-custom">Забронировать</button>

                <div id="myModal" class="modal">
                    <div class="modal-content">
 <span class="close">&times;</span>
                        <div class="modal-text">
                            <p>Пожалуйста, введите дополнительную информацию: </p>
                        </div>

                        <?= $form->field($model, 'DateBirth')->widget(
                            DatePicker::class, [
                            'language' => 'ru',
                            'inline' => false,

                            'clientOptions' => [
                                'autoclose' => true,
                                'todayHighlight' => true,
                                'format' => 'yyyy-mm-dd',
                            ]
                        ]); ?>
                        <?= $form->field($model, 'mail')->textInput(['email']) ?>
                        <?= $form->field($model, 'Number')->widget(\yii\widgets\MaskedInput::class, [
                            'mask' => '+7 (999) 999-99-99', 'options' => ['placeholder' => '+7 (XXX) XXX-XX-XX', '' => '']]) ?>

                        <div class="form-group sub-middle">
                            <?= Html::submitButton('Забронировать', ['class' => 'btn btn-custom', 'name' => 'contact-button', 'id' => 'Sub']) ?>
                        </div>
                        <div class="modal-text-bottom">
                            <p>Или <?=  Html::a('Зарегестрирйтесь' , ['/site/signup'])?> здесь</p>
                        </div>
                    </div>
                </div>
            <?php }
            ActiveForm::end() ?>

        </div>
    </div>
</div>
<div class="custom-body">
<form action="countrydetails.php" method=""></form>

<?php
foreach ($CountryList as $item) {

    echo '<div class="country-container">';
    echo Html::a('Профиль', ['site/countrydetails', 'id' => $item['idCountry']], ['class' => 'profile-link']) ;
    echo "<a type='button' href='countrydetails.php'><img src='images/Country/".$item['FlagPath'] ."'>";
    echo  $item['Title'];
    echo  $item['idCountry'];
    echo '</a></div>';
}

?>

</div>
