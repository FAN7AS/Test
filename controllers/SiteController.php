<?php

namespace app\controllers;

use Yii;
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
        $model = new Reservation();
        if(Yii::$app->request->isAjax){
            if ($model->load(Yii::$app->request->post()) && $model->validate() ) {
                Reservation::AddReservation($model);
            }
        }
        $err=$model->errors;
        $CountryList= Countries::getCountry();
        return $this->render('index', compact('model','err','CountryList'));

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
                return ['output' => $st, 'selected' => $ParentDrop];

            }
        }
     return  true;
    }
}

