<?php
use yii\bootstrap\Carousel;
/* @var $this yii\web\View */

$this->title = 'Главная';
/* echo  Yii::$app->user->identity->Name ;
 echo date('Y') - Yii::$app->user->identity->DateBirth;*/
?>
<?php
$carousel = [
  
 [
 'content' => '<img src="http://assol-tver.ru/wp-content/uploads/2016/11/slider1.jpg">',
 'caption' => '',
 'options' => ['class' => 'my-class']
 ],
 [
 'content' => '<img src="http://assol-tver.ru/wp-content/uploads/2016/11/slider2.jpg"/>',
 'caption' => '',
 'options' => ['class' => 'my-class']
 ]
 ,
 [
 'content' => '<img src="http://assol-tver.ru/wp-content/uploads/2016/11/slider3.jpg">',
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

?>
<div class="site-index">

    <div class="jumbotron">

    </div>

    <div class="body-content">

        <div class="row">
          <ymaps id='ymaps161896209150977838'></ymaps>
            
        </div>

    </div>
</div>
