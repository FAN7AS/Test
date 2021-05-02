<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;

?>
    <div style="margin-left: auto;margin-right: auto;">
        <?php
        $this->title = 'Регистрация';

        ?>
        <h1><?= Html::encode($this->title) ?></h1>
        <p>Пожалуйста, заполните следующие поля для регистрации:</p>
        <?php
        $items = [
            'Мужской' => 'Мужской',
            'Женский' => 'Женский',

        ];
        $params = [
            'prompt' => 'Выберите пол...'
        ];
        $form = ActiveForm::begin([
            'id' => 'login-form1',
            'options' => ['class' => 'form-signup'],
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-2\">{input}</div>\n<div class=\"col-lg-3\"><div style='margin-left:2em;width:100%'>{error}</div></div>",
                'horizontalCssClasses' => [

                    'error' => 'ssss',
                    'hint' => 'sss',
                ],
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]) ?>
        <?= $form->field($model, 'Username')->textInput(['style' => 'width:250px']) ?>
        <?= $form->field($model, 'Password')->passwordInput()->textInput(['style' => 'width:250px']) ?>
        <?= $form->field($model, 'Name')->textInput(['style' => 'width:250px']) ?>
        <?= $form->field($model, 'LastName')->textInput(['style' => 'width:250px']) ?>
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
        <?= $form->field($model, 'Sex')->dropDownList($items, $params) ?>
        <?= $form->field($model, 'Mail')->textInput(['style' => 'width:250px']) ?>
        <?= $form->field($model, 'Number')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '+7 (999) 999-99-99', 'options' => ['placeholder' => '+7 (XXX) XXX-XX-XX']]) ?>

        <div class="form-group">
            <div>
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
<?php if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
    if (!$bool) {
        echo Html::tag('p', 'Пользователь с данным логином уже существует.', ['style' => ['color' => 'red', 'font-size' => '20px']]);
    }
}
?>