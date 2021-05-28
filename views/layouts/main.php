<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=f9403677-2f13-4241-8676-a824c716c011&lang=ru_RU"
            type="text/javascript"></script>

</head>
<body id="body">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('images/BrandLabel/BrandLabel.png', ['alt'=>Yii::$app->name, 'class' => 'brand-picture', 'style' => '']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],

        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Сотрудник', 'visible' => Yii::$app->user->identity->Role != 'user' && !Yii::$app->user->isGuest],
            ['label' => 'О нас', 'url' => ['/site/about'], 'visible' => Yii::$app->user->isGuest || Yii::$app->user->identity->Role == 'user'],

            ['label' => 'Контакты', 'url' => ['/site/contact'], 'visible' => Yii::$app->user->isGuest || Yii::$app->user->identity->Role == 'user'],
            Yii::$app->user->isGuest ? (
            ['label' => 'Войти', 'url' => ['/site/login']]
            ) : (
            ['label' => Yii::$app->user->identity->Username, 'items' => [
                Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти',
                    ['class' => 'btn btn-link logout']
                ) .
                Html::endForm(),
                ['label' => 'Личный кабинет', 'url' => ['/site/about'],
                    ['class' => 'btn btn-link logout']],

            ], 'options' => ['id' => 'test']]

            ), ['label' => 'Регистрация', 'url' => ['site/signup'], 'visible' => Yii::$app->user->isGuest],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">

        <?/*= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) */?><!--
        --><?/*= Alert::widget() */?>
        <?= $content ?>
        <div id="upbutton"><img src="images/Other/Arrow.png" width="50px"></div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
</body>
</html>
<?php $this->endPage() ?>
