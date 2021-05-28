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
$CityDeparture = ArrayHelper::map(Cities::find()->all(), 'idCity', 'Title');
$CountryTarget = ArrayHelper::map(Countries::find()->all(), 'idCountry', 'Title');
$carousel = [

    [
        'content' => '<img src="Images/Slider/Slider1.jpg">',
        'caption' => '',
        'options' => ['class' => 'my-class']
    ],
    [
        'content' => '<img src="images/Slider/slider2.jpg"/>',
        'caption' => '',
        'options' => ['style' => 'background-size:cover ']
    ]
    ,
    [
        'content' => '<img src="images/Slider/slider3.jpg" alt="sd"/>',
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
        <div id="simple-msg" hidden>
            <code class="alert alert-success">Данные успешно отправлены, с вами свяжутся в ближайшее время<span
                        class="close-alert">&times;</span></code>
        </div>
        <div id="simple-msg-form" hidden>
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
                            <p>Или <?= Html::a('Зарегестрирйтесь', ['/site/signup']) ?> здесь</p>
                        </div>
                    </div>
                </div>
            <?php }
            ActiveForm::end() ?>

        </div>
    </div>
</div>
<div class="custom-body">
    <div class="text-index">
        <h2>Турагентство «EASY Tour»</h2>
        <p>
        Крупное туристическое агентство «Easy Tour», которое уже много лет делает отдых за границей доступнее для
        жителей России и стран СНГ. Нашей главной задачей является предоставление лучшего тура каждому нашему клиенту,
        поэтому мы постоянно пополняем наш каталог доступных для поездок стран и туристических мест, а также организуем
        автобусные туры по Европе и России.
        </p>
        <p>
        Нашей визитной карточкой является то, что нашим клиентам мы составляем индивидуальные туры с учетом их
        предпочтений и финансовых возможностей. «Easy Tour» может организовать поездку в 32 страны Европы, Азии и
        Америки, а также путешествие по городам России.
        </p>
        <p>
        Наш сайт туристического агентства  в Ростове-на-Дону помогает с выбором страны на основе ваших
        пожеланий, места проживания, отеля, оформлением страховки и визы, покупкой билетов на самолет и подбором
        интересующих вас экскурсий.
        </p>
        <h2>Турагентство EASY Tour — поиск горящих туров из Ростова-на-Дону</h2>
        <hr>
        <h3>Здесь вы можете найти более подробную информацию о странах</h3>
        <hr>
    </div>

<div class="country-list">
    <?php
    foreach ($CountryList as $item) {

        echo '<div class="country-container">';
        echo Html::a(Html::img('images/Country/' . $item['FlagPath']), ['site/countrydetails', 'country' => $item['idCountry']]);

        echo $item['Title'];

        echo '</a></div>';
    }

    ?>
</div>
   <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',

    ]); ?>
    <?= $form->field($modelSearchCountry, 'Title')->textInput(['autofocus' => true])->label('') ?>
    <?php ActiveForm::end(); ?>
</div>
