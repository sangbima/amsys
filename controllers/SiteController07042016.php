<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\AdduserForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use app\models\Petani;
use app\models\PetaniSearch;
use app\models\Lahan;
use app\models\Produksi;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
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

    public function actionIndex()
    {
        $modelPetani = Petani::find()->count();
        $modelLahan = Lahan::find()->all();
        $modelEstimasi = Produksi::find()->all();
        $modelProduksi = Produksi::find()->all();
        $this->layout = 'dashboard';
        return $this->render('index',[
            'modelPetani' => $modelPetani,
            'modelLahan' => $modelLahan,
            'modelEstimasi' => $modelEstimasi,
            'modelProduksi' => $modelProduksi,
            ]);

        $modeInfoHarga = \app\models\InfoHarga::find()->all();
    }

    public function actionLogin()
    {
        $this->layout = 'loginLayout';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

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

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionDashboard()
    {
      $this->layout = 'dashboard';
      return $this->render('dashboard');
    }

    public function actionBulan()
    {
      $response = [
        "labels" => ["January","February","March","April","May","June","July"],
        "data" => [65, 59, 80, 81, 56, 55, 40]
      ];

      return \yii\helpers\Json::encode($response);
    }
}
