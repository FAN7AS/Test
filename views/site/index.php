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
$this->params['breadcrumbs'][] = $this->title;
/* echo  Yii::$app->user->identity->Name ;
echo date('Y') - Yii::$app->user->identity->DateBirth;*/
?>

<?php
Yii::$app->user->isGuest ? $_COOKIE['Sub'] = true : $_COOKIE['Sub'] = false;
$CityDeparture = ArrayHelper::map(Cities::find()->all(), 'idCity', 'Title');
$CountryTarget = ArrayHelper::map(Countries::find()->all(), 'idCountry', 'Title');
$carousel = [

    [
        'content' => '<img src="images/Slider/Slider1.jpg">',
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
            <code class="text">Данные успешно отправлены, с вами свяжутся в ближайшее время<span
                        class="close-alert">&times;</span></code>
        </div>
        <div id="simple-msg-form" hidden>
            <code class="alert alert-success">Заполните все поля </code>
        </div>


        <div class="glob-form">
            <div id="modalGlob" class="modalGlob">
                <div class="form-direction">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'FormAjax',
                        'fieldConfig' => [

                            //  'labelOptions' => ['style' => 'display:flex;justify-content:center;color:white;'],
                        ],
                    ]);
                    ?>
                    <?= $form->field($model, 'idCity')->dropDownList($CityDeparture, ['prompt' => 'Город вылета', 'id' => 'City', 'autofocus' => true]) ?>
                    <?= $form->field($model, 'idCountry')->dropDownList($CountryTarget, ['prompt' => 'Страна', 'id' => 'cat-id']) ?>
                    <?= $form->field($model, 'idResort')->widget(DepDrop::classname(), [
                        'options' => ['id' => 'subcat-id'],
                        'pluginOptions' => [
                            'depends' => ['cat-id'],
                            'placeholder' => 'Курорт...',
                            'url' => Url::to(['/site/child-drop'])
                        ]
                    ]); ?>
                    <?= $form->field($model, 'idHotel')->widget(DepDrop::classname(), [
                        'pluginOptions' => [
                            'depends' => ['subcat-id'],
                            'placeholder' => 'Отель',
                            'url' => Url::to(['/site/prod'])
                        ]
                    ]); ?>
                    <?= $form->field($model, 'RoomType')->dropDownList(['1' => '1', '2' => '2', '3' => '3'],['prompt' => 'Количество ночей']) ?>
                    <?= $form->field($model, 'LengthOfNights')->textInput(['style' => '']) ?>
                    <?= $form->field($model, 'NumberOfPeople')->textInput([]) ?>
                    <?php if (Yii::$app->user->isGuest) { ?>
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


                    <?php } ?>
                    <div class="form-group sub-middle">
                        <?= Html::submitButton('Забронировать', ['class' => 'btn btn-custom', 'name' => 'contact-button', 'id' => 'Sub']) ?>

                    </div>

                    <?php
                    ActiveForm::end() ?>
                </div>
                <div class="form-direction-info">
                    <div class="city-choice"></div>
                    <div class="country-choice">

                    </div>
                    <div class="resort-choice"></div>
                    <div class="hotel-choice"></div>
                    <div class="other-choice">
                        <div class="TypeRoom"></div>
                        <div class="AmmountNigths"></div>
                        <div class="AmmountTourists"></div>

                    </div>
                </div>
                <div class="form-direction-disable"><span class="close">&times;</span></div>
            </div>
        </div>
    </div>
</div>
<div class="custom-body">
    <div class="text-index">
        <div class="head-reservation">
            <button id="ter" class="btn btn-custom" name="dd">Забронировать тур</button>
        </div>
        <h2>Турагентство «EASY Tour»</h2>
        <p>
            Крупное туристическое агентство «Easy Tour», которое уже много лет делает отдых за границей доступнее для
            жителей России и стран СНГ. Нашей главной задачей является предоставление лучшего тура каждому нашему
            клиенту,
            поэтому мы постоянно пополняем наш каталог доступных для поездок стран и туристических мест, а также
            организуем
            автобусные туры по Европе и России.
        </p>
        <p>
            Нашей визитной карточкой является то, что нашим клиентам мы составляем индивидуальные туры с учетом их
            предпочтений и финансовых возможностей. «Easy Tour» может организовать поездку в 32 страны Европы, Азии и
            Америки, а также путешествие по городам России.
        </p>
        <p>
            Наш сайт туристического агентства в Ростове-на-Дону помогает с выбором страны на основе ваших
            пожеланий, места проживания, отеля, оформлением страховки и визы, покупкой билетов на самолет и подбором
            интересующих вас экскурсий.
        </p>
        <h2>Турагентство EASY Tour — поиск горящих туров из Ростова-на-Дону</h2>
        <div class="text-icons">
            <div class="icon-image">
                <?php
                $directory = "images/Icons";    // Папка с изображениями
                $allowed_types = array("jpg", "png", "gif");  //разрешеные типы изображений
                $file_parts = array();
                $ext = "";
                $title = "";
                $i = 0;
                //пробуем открыть папку
                $dir_handle = @opendir($directory) or die("Ошибка при открытии папки !!!");
                while ($file = readdir($dir_handle))    //поиск по файлам
                {
                    if ($file == "." || $file == "..") continue;  //пропустить ссылки на другие папки
                    $file_parts = explode(".", $file);          //разделить имя файла и поместить его в массив
                    $ext = strtolower(array_pop($file_parts));   //последний элеменет - это расширение


                    if (in_array($ext, $allowed_types)) {

                        echo '<div class="Icon-Item">
                <img src="' . $directory . '/' . $file . '" />';
                        echo pathinfo($file, PATHINFO_FILENAME) . '</div>';
                        $i++;
                    }

                }
                closedir($dir_handle);  //закрыть папку
                ?>
            </div>
            <div class="text-advantage">
                <h2>Преимущества турагентства «Easy Tour»</h2>
                <ul>
                    <li>
                        Наша фирма существует долгое время, за которое мы успели построить стабильные отношения с
                        туристическими
                        местами и курортами в России и других странах;
                    </li>
                    <li>
                        Мы продолжаем развиваться и искать все новые пути поездок для наших клиентов. Ежегодно к списку
                        доступных нам направлений добавляется две-три страны, и наша компания не намерена
                        останавливаться на
                        достигнутом;
                    </li>
                    <li>
                        Мы можем найти отличный тур на любой кошелек, достаточно лишь назвать ваши пожелания и примерное
                        направление;
                    </li>
                    <li>
                        Постоянным клиентам мы первым сообщаем о появившихся горящих турах и других выгодных
                        предложениях;
                    </li>
                    <li>
                        Наша турфирма открыта к сотрудничеству с другими российскими компаниями в этой сфере, чтобы
                        иметь
                        возможность предложить нашим клиентам наилучшее возможное обслуживание.
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        <h3>Здесь вы можете найти более подробную информацию о странах и курортах</h3>

        <hr>
    </div>

<!--    <div class="live-search">
        <?php /*$form = ActiveForm::begin([
            'id' => 'login-form',
            'fieldConfig' => [
                'template' => "{input}",
                'template' => "{input}",

            ],
            'layout' => 'horizontal',

        ]); */?>
        <?/*= $form->field($modelSearchCountry, 'Title')->textInput()->label('') */?>
        <?php /*ActiveForm::end(); */?>
    </div>-->

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
    <div class="chatbot-btn" style="">
        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" width="20" height="20"><path fill="currentColor" d="M14 8.999v-5a2.003 2.003 0 00-2-2H3a2.003 2.003 0 00-2 2v5a2.003 2.003 0 002 2v1.694a.302.302 0 00.486.244l2.587-1.945H12A1.997 1.997 0 0014 9zm3-2h-2v2a3.003 3.003 0 01-3 3H7v2a2.003 2.003 0 002 2h3.927l2.59 1.941c.198.15.483.004.483-.243v-1.701h1a2.003 2.003 0 002-1.997v-5a2.003 2.003 0 00-2-2z" /></svg>
    </div>
</div>
