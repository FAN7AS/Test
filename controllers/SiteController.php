<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\ActiveRecord;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\User;
use yii\helpers\Url;
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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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

    public function actionSignup(){
       if (!Yii::$app->user->isGuest) {
           return $this->goHome();
       }
       $model = new SignupForm();
       $bool= true;
       if($model->load(\Yii::$app->request->post()) && $model->validate())
       {

           $NamesUsers= User::find()->select(['Username'])->all();
           foreach ($NamesUsers as $value) {
            if($value->Username == $model->Username)
            {
             $bool=false;   
            }
     }
     if ($bool) {
        $user = new User();
        $user->Username = $model->Username;
        $user->Password = \Yii::$app->security->generatePasswordHash($model->Password);
        $user->Name = $model->Name;
          $user->LastName = $model->LastName;
            $user->DateBirth = $model->DateBirth;
              $user->Sex = $model->Sex;
                $user->Mail = $model->Mail;
                  $user->Number = $model->Number;
        if($user->save()){
           \Yii::$app->session->setFlash('flashMessage', 'Hello world!');
           return Yii::$app->response->redirect(['site/login']);
       }

   }

}

return $this->render('signup', compact('model','NamesUsers','bool'));
}
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
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
    public function actionLogout()
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
}
