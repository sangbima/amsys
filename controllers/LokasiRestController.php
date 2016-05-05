<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\filters\auth\QueryParamAuth;

class LokasiRestController extends \yii\rest\Controller
{

  protected function verbs()
  {

    return [
      'index' => ['GET'],
    ];

  }

  public function behaviors()
  {

    $behaviors = parent::behaviors();
    $behaviors['authenticator'] = [
      'class' => QueryParamAuth::className(),
    ];

    return $behaviors;

  }

  public function actionIndex()
  {

    $lokasis = \app\models\Lokasi::find()->all();
    return [
      'results' => $lokasis,
    ];

  }

}
