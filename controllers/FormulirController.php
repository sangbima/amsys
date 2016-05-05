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
use app\models\Lahan;
use app\models\Produksi;
use app\models\InfoHarga;
use app\models\Lokasi;
// use kartik\mpdf\Pdf;
use mPDF;

class FormulirController extends \yii\web\Controller
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
                    'logout' => ['POST'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
      $query = \app\models\Produksi::find();
      $query->where(['status' => 'selesai']);
      $dataProvider = new \yii\data\ActiveDataProvider([
          'query' => $query,
      ]);

      return $this->render('index', [
        'dataProvider' => $dataProvider,
      ]);
    }

    public function actionPrintPdf($id)
    {
      $model = \app\models\Produksi::findOne($id);

      $dataQR = '{"no_proposal":"'.$model->no_proposal.'",
      "no_surat":"1/AL/04/2016"}';

      $mpdf = new mPDF('utf-8', 'A4');
      $mpdf->useOnlyCoreFonts = true;
      $mpdf->SetProtection(array('print'));
      $mpdf->SetTitle("BGR - SPK");
      $mpdf->SetAuthor("BGR (Persero)");
      $mpdf->WriteHTML($this->renderPartial('pdf',[
        'data' => $model,
        'dataQR' => $dataQR
      ]));
      $response = Yii::$app->response;
      $response->format = \yii\web\Response::FORMAT_RAW;
      $headers = Yii::$app->response->headers;
      $headers->add('Content-Type', 'application/pdf');
      $mpdf->Output();
      exit;
    }

}
