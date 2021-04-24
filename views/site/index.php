<?php
use yii\bootstrap\Carousel;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Countries;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
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
		'options' => ['class' => 'my-class']
	]
	,
	[
		'content' => '<img src="images/slider3.jpg">',
		'caption' => '',
		'options' => ['class' => 'my-class']
	]

];

echo Carousel::widget([
	'items' => $carousel,
	'options' => ['class' => 'carousel slide', 'data-interval' => '10000'],
	'controls' => [
		'<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
		'<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
	]
]);
echo Html::dropDownList('country_id','', array(1=>'USA',2=>'France',3=>'Japan'));
$form = ActiveForm::begin([

	'fieldConfig' => [
		'template' => "{label}<div class=\"col-lg-2\">{input}</div>",
		'labelOptions' => ['class' => 'col-lg-1 control-label'],
	],
]); ?>
<?= $form->field($model, 'CountryNames',['inputOptions' => ['id' => 'test']])->dropDownList(ArrayHelper::map(Countries::find()->all(),'idCountry','Title'))?>
<?= $form->field($model, 'CountryNames')->widget(DepDrop::classname(), [
     'options' => ['id'=>'subcat-id'],
     'pluginOptions'=>[
         'depends'=>['cat-id'],
         'placeholder' => 'Select...',
         'url' => Url::to(['/site/subcat'])
     ]
 ]); ?>
<div class="form-group">
	<?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
</div>

<?php ActiveForm::end();print_r($CountryNames); ?>
