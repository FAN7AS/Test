<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact" style="display: inline !important">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

        <p>
            Note that if you turn on the Yii debugger, you should be able
            to view the mail message on the mail panel of the debugger.
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

        <?php else: ?>

            <p>
                If you have business inquiries or other questions, please fill out the following form to contact us.
                Thank you.
            </p>

            <div class="row">
                <div class="col-lg-5" >

                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'subject') ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6,'style'=>'max-width:470px;'])?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                    <?php ActiveForm::end();?>

                </div>
                <div class="col-lg-7" style="background-color: #5E5E5EFF;padding: 2px; border-radius: 3px;">
                 <div class="ContactInfo">

                    <ul>
                          <lh>Наши контакты:</lh>
                        <li>г. Ростов-на-Дону, ул. Юфимцева, д. 10/2</li>
                         <li>Телефоны: (8-928-906-26-09)</li>
                          <li>E-mail: statiusmarkov@gmail.com</li>
                           <li>Сайт: <?= Url::home(true);?></li>
                    </ul>
                </div>
                <div id="map"  style="height: 400px; width: 100%;"></div>
            </div>
        </div>

    <?php endif; ?>
</div>


<!-- Создаём карту -->
<script type="text/javascript">
    // Функция ymaps.ready() будет вызвана, когда
    // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
    ymaps.ready(init);

    function init() {
        // Создание карты.
        // https://tech.yandex.ru/maps/doc/jsapi/2.1/dg/concepts/map-docpage/
        var myMap = new ymaps.Map("map", {
            // Координаты центра карты.
            // Порядок по умолчнию: «широта, долгота».
            center: [47.24, 39.73],
            // Уровень масштабирования. Допустимые значения:
            // от 0 (весь мир) до 19.
            zoom: 12,
            // Элементы управления
            // https://tech.yandex.ru/maps/doc/jsapi/2.1/dg/concepts/controls/standard-docpage/
            controls: [

                'zoomControl', // Ползунок масштаба
                'rulerControl', // Линейка
                'routeButtonControl', // Панель маршрутизации
                'trafficControl', // Пробки
                'typeSelector', // Переключатель слоев карты
                'fullscreenControl', // Полноэкранный режим

                // Поисковая строка
                new ymaps.control.SearchControl({
                    options: {
                        text: 'dsd',
                        // вид - поисковая строка
                        size: 'large',
                        formLayuot:'house',
                        // Включим возможность искать не только топонимы, но и организации.
                        provider: 'yandex#search'
                    }
                })

                ]
            });

        // Добавление метки
        // https://tech.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Placemark-docpage/
        var myPlacemark = new ymaps.Placemark([47.2407, 39.7059], {
            // Хинт показывается при наведении мышкой на иконку метки.
            hintContent: 'Содержимое всплывающей подсказки',
            balloonContentHeader:'Метка',
            // Балун откроется при клике по метке.
            balloonContent: 'ТУРИСТИЧЕСКОЕ АГЕНТСТВО «АССОЛЬ»',

            balloonContentFooter : 'г. Ростов-на-Дону, ул. Юфимцева, д. 10/2',

        });

        // После того как метка была создана, добавляем её на карту.
        myMap.geoObjects.add(myPlacemark);

    }
</script>