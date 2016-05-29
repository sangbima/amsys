<?php

namespace app\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;

class PasarController extends ActiveController
{
  public $modelClass = '\app\models\Pasar';

  // protected function verbs()
  // {
  //
  //   return [
  //     'daftar-lokasi' => ['GET','OPTIONS'],
  //     'daftar-petani' => ['GET','OPTIONS'],
  //     'daftar-lahan' => ['GET','OPTIONS'],
  //     'daftar-varietas' => ['GET','OPTIONS'],
  //     'daftar-produksi' => ['GET','OPTIONS'],
  //     'acuan-harga' => ['GET','OPTIONS'],
  //     'options' => ['OPTIONS'],
  //   ];
  //
  // }

  /**
   * @inheritdoc
   */
  public function behaviors()
  {
      $behaviors = parent::behaviors();

      $behaviors['authenticator'] = [
          // 'class' => QueryParamAuth::className(),
          'class' => \app\components\CustomAuth::className(),
          'tokenParam' => 'X-Auth-Token',
          'except' => ['options']
      ];

      $behaviors['corsFilter'] = [
          'class' => \yii\filters\Cors::className(),
          'cors' => [
              'Origin' => ['*'],
              'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
              'Access-Control-Request-Headers' => ['*'],
              'Access-Control-Allow-Credentials' => true,
              //'Access-Control-Max-Age' => 86400,
          ]
      ];

      return $behaviors;
  }

  // public function behaviors()
  // {
  //       $behaviors = parent::behaviors();
  //       $behaviors['authenticator'] = [
  //           'class' => QueryParamAuth::className(),
  //       ];
  //       return $behaviors;
  // }

}
