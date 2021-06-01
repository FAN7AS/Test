<?php

namespace app\controllers;

use app\models\Cities;
use app\models\Hotels;
use app\models\Resorts;
use Yii;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\Reservation;
use app\models\Employees;
use app\models\Countries;
use app\models\User;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['contact'],
                'rules' => [
                    [
                        'actions' => ['contact'],
                        'allow' => true,

                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupForm();
        $bool = true;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $NamesUsers = User::getUsername();
            foreach ($NamesUsers as $value) {
                if ($value->Username == $model->Username) {
                    $bool = false;
                }
            }

            if (User::SignUp($bool, $model)) //Если пользователь добавлен(зарегестрирован)
            {
                Yii::$app->session->setFlash('flashMessage', 'Signup Successful!'); //Создаем флешку
                return Yii::$app->response->redirect(['site/login']);
            }
        }

        return $this->render('signup', compact('model', 'NamesUsers', 'bool'));
    }

    /**
     * Displays homepage.
     *
     * @return string
     */

    public function actionIndex(): string
    {
        $modelSearchCountry = new Countries();
        $model = new Reservation();
        if (Yii::$app->request->isAjax) {


            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                Reservation::AddReservation($model);

            }
 $err = $model->errors;
            $idCity = $_POST["Reservation"]["idCity"];
            $idCountry = $_POST["Reservation"]["idCountry"];
            $idResort = $_POST["Reservation"]["idResort"];
            $idHotel = $_POST["Reservation"]["idHotel"];
            $city = Cities::getCity($idCity);
            $country = Countries::getCountry2($idCountry);
            $resort = Resorts::getResort($idResort);
            $hotel = Hotels::getHotel($idHotel);
            foreach ($city as $cityTarget) {

                echo '<div style="margin: 1em">' . $cityTarget['Title'], '</div>';


            }
            foreach ($hotel as $hotelTarget) {

                echo '<div style="margin: 1em">' . $hotelTarget['Title'], '</div>';
                echo Html::img('images/Hotels/' . $hotelTarget['pictureHotel']);
                /* echo Html::img('images/Hotels/' . $hotelTarget['pictureHotel']);*/
                echo '<div style="margin: 1em"><font style="font-size: 15px">
Цена от:</font><div style="padding: 5px;background-color: red;border-radius: 3px;
box-shadow: 0 0 10px rgba(239,19,19,0.5); color: white">' . $hotelTarget['minCost'], '</div><font style="font-size: 15px;">Руб.</font></div>';

            }
            foreach ($resort as $resortTarget) {

                echo '<div style="margin: 1em">' . $resortTarget['Title'], '</div>';
                echo Html::a(Html::img('images/Resorts/' . $resortTarget['ResortPicture']), ['site/resortdetails', 'country' => $resortTarget['idCountry'], 'resort' => $resortTarget['idResorts']]);
// echo Html::img('images/Resorts/' . $resortTarget['blazon']);


            }
            foreach ($country as $countryTarget) {
                echo '<div style="margin: 1em">' . $countryTarget['Title'], '</div>';
                echo Html::a(Html::img('images/Country/' . $countryTarget['FlagPath']), ['site/countrydetails', 'country' => $countryTarget['idCountry']]);

                /* echo Html::img('images/Country/' . $countryTarget['FlagPath']);*/


            }
            exit;

        }

        $CountryList = Countries::getCountry();
        return $this->render('index', compact('model', 'err', 'CountryList', 'modelSearchCountry', 'res',));

    }


    public function actionCountrydetails(): string
    {
        $idCountry = $_GET['country'] ?? '';
        $CountryData = Countries::getCountryDeatails($idCountry);
        $ResortsData = Resorts::getCountryResorts($idCountry);
        return $this->render('Countrydetails', compact('CountryData', 'ResortsData'));

    }

    public function actionResortdetails(): string
    {
        $idResort = $_GET['resort'] ?? '';
        $ResortData = Resorts::getCountryResort($idResort);
        return $this->render('Resortdetails', compact('ResortData'));

    }

    public function actionHoteldetails(): string
    {
        $idHotel = $_GET['hotel'] ?? '';
        $HotelData = Resorts::getCountryResort($idResort);
        return $this->render('Resortdetails', compact('ResortData'));

    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionChildDrop() //Дейсттие для DepDrop ajax
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        if (isset($post['depdrop_parents'])) {
            $parents = $post['depdrop_parents'];

            if ($parents != null) {
                $ParentDrop = $parents[0];

                $ChildDrop = Countries::getChildDrop($ParentDrop);

                if (!$ChildDrop) {
                    return ['output' => '', 'selected' => ''];
                }
                $st = [];

                foreach ($ChildDrop as $value) {

                    $st[] = ['id' => $value['idResorts'], 'name' => $value['Title']];
                }
                return ['output' => $st, 'selected' => ''];

            }
        }
        return true;
    }

    public function actionProd()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        if (isset($post['depdrop_parents'])) {
            $parents = $post['depdrop_parents'];

            if ($parents != null) {
                $ParentDrop = $parents[0];

                $ChildDrop = Countries::getChildDrop2($ParentDrop);

                if (!$ChildDrop) {
                    return ['output' => '', 'selected' => ''];
                }
                $st = [];

                foreach ($ChildDrop as $value) {

                    $st[] = ['id' => $value['idHotel'], 'name' => $value['Title']];
                }
                return ['output' => $st, 'selected' => ''];

            }
        }
        return true;
    }


}

