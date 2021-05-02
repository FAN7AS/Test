<?php

use yii\bootstrap\Carousel;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Countries;
use app\models\Cities;
use app\models\Resorts;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */

$this->title = 'Главная';
/* echo  Yii::$app->user->identity->Name ;
echo date('Y') - Yii::$app->user->identity->DateBirth;*/
?>
<?php
$carousel = [

    [
        'content' => '<img src="images/slider1.jpg">',
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
        'content' => '<img src="images/slider3.jpg">',
        'caption' => '',
        'options' => ['class' => 'my-class']
    ]

]; ?>

<div class="custom-carousel">
    <?= Carousel::widget([
        'items' => $carousel,
        'options' => ['class' => 'carousel slide', 'data-interval' => '4000', 'style' => 'background-size:cover !important'],
        'controls' => [
            '<span class="glyphicon glyphicon-chevron-left"  aria-hidden="true"></span>',
            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
        ]
    ]); ?>

    <div class="form-reservation">

        <?php $form = ActiveForm::begin([

            'fieldConfig' => [
                'template' => "<div class=''>{label}</div><div class='' style='width:130px'>{input}</div><div class=\"\">{error}</div>",
                'labelOptions' => ['style' => 'display:flex;justify-content:center;color:white;'],
            ],
        ]);
        /*$x=Countries::getChildDrop($[j]); //Удалить
        print_r($x);*/
        ?>
        <?= $form->field($model, 'idCity')->dropDownList(ArrayHelper::map(Cities::find()->all(), 'idCity', 'Title'), ['prompt' => 'Город вылета', 'id' => 's', 'autofocus' => true]) ?>
        <?= $form->field($model, 'idCountry')->dropDownList(ArrayHelper::map(Countries::find()->all(), 'idCountry', 'Title'), ['prompt' => 'Страна', 'id' => 'cat-id']) ?>
        <?= $form->field($model, 'idResort')->widget(DepDrop::classname(), [
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
        <?= $form->field($model, 'DateBirth')->widget(
            DatePicker::className(), [
            'language' => 'ru',
            'inline' => false,
            /* 'options' => ['style' => ' font-size: 18px; color:black;border:1px solid black; border-right: none !important;width:118px;',],*/
            'clientOptions' => [
                'autoclose' => true,
                'todayHighlight' => true,
                'format' => 'yyyy-mm-dd',
            ]
        ]); ?>
        <?= $form->field($model, 'LengthOfNights')->textInput(['style' => 'width:60px;margin-left:auto;margin-right:auto']) ?>
        <?= $form->field($model, 'mail')->textInput(['email']) ?>
        <?= $form->field($model, 'Number')->textInput([])->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '+7 (999) 999-99-99', 'options' => ['placeholder' => '+7 (XXX) XXX-XX-XX']]) ?>
        <?= $form->field($model, 'NumberOfPeople')->textInput([]) ?>
        <div class="form-group">
            <?= Html::submitButton('Забронировать', ['class' => 'btn btn-custom', 'name' => 'contact-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<div class="custom-body ">

</div>

