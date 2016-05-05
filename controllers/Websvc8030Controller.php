<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;

/**
* Delete: Lokasi, Petani, Lahan, Varietas, Produksi
*/

class Websvc8030Controller extends \yii\rest\Controller
{
  protected function verbs()
  {

    return [
      'delete-petani' => ['POST','OPTIONS'],
      'delete-lahan' => ['POST','OPTIONS'],
      'delete-produksi' => ['POST','OPTIONS'],
      'options' => ['OPTIONS'],
    ];

  }

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

  public function actions()
  {
      return [
          'options' => [
              'class'             => 'yii\rest\OptionsAction',
              'collectionOptions' => ['OPTIONS'],
              'resourceOptions'   => ['OPTIONS'],
          ],
      ];
  }

  public function actionOptions()
  {
    \Yii::$app->getResponse()->getHeaders()->set('Allow', 'OPTIONS');
  }

  /**
  * DELETE Petani
  * Method POST
  * Request id, keterangan
  * Response Success
  * {
  *   "status" : "success",
  *   "data" : {"id":"<val>", "nama":"<val>", "alamat":"<val>", "no_ktp":"<val>",
  *             "lokasi_kode":"<val>", "lokasi_nama":"<val>", "status":"<val>"}
  * }
  * Response Failed
  * {"status":""}
  */
  public function actionDeletePetani()
  {
    $request = Yii::$app->request;

    if (isset($request)) {
      // $model->id = $request->post('id');
      $model = \app\models\Petani::findOne($request->post('id'));

      $model->status = 'dihapus';
      $model->keterangan = $request->post('keterangan');

      if($model->save(false)){
        $response = [
          "status" => "success",
          "data" => [
            "id" => $model->id,
            "nama" => $model->nama,
            "alamat" => $model->alamat,
            "no_ktp" => $model->no_ktp,
            "lokasi_kode" => $model->lokasi_kode,
            "lokasi_nama" => $model->lokasiKode->nama,
            "keterangan" => $model->keterangan,
            "status" => $model->status
          ]
        ];
      } else {
        $response = "";
      }
    } else {
      $response = "";
    }

    return $response;
  }

  /**
  * DELETE Lahan
  * Method POST
  * Request id, keterangan
  * Response Success
  * {
  *   "status" : "success",
  *   "data" : {"id":"<val>", "petani_id":"<val>", "petani_nama":"<val>",
  *           "lokasi_kode":"<val>", "lokasi_nama":"<val>", "luas_m2":"<val>",
  *           "keterangan":"<val>", "status":"<val>"}
  * }
  * Response Failed
  * {"status":""}
  */
  public function actionDeleteLahan()
  {
    $request = Yii::$app->request;
    if (isset($request)) {
      $model = \app\models\Lahan::findOne($request->post('id'));

      $model->status = 'dihapus';

      if($model->save(false)){
        $response = [
          "status" => "success",
          "data" => [
            "id" => $model->id,
            "petani_id" => $model->petani_id,
            "petani_nama" => $model->petani->nama,
            "lokasi_kode" => $model->lokasi_kode,
            "lokasi_nama" => $model->lokasiKode->nama,
            "luas_m2" => $model->luas_m2,
            "keterangan" => $model->keterangan,
            "status" => $model->status,
          ]
        ];
      } else {
        $response = "";
      }
    } else {
      $response = "";
    }

    return $response;
  }

  /**
  * DELETE Produksi
  * Method POST
  * Request id, keterangan
  * Response Success
  * {
  *   "status" : "success",
  *   "data" : {"id":"<val>", "lahan_id":"<val>", "petani_nama":"<val>", "luas_m2":"<val>",
  *           "lokasi_nama":"<val>", "komoditas_kode":"<val>", "komoditas_nama":"<val>",
  *           "tgl_tanam":"<val>", "tgl_panen":"<val>", "est_bobot_panen":"<val>",
  *           "harga_panen":"<val>", "keterangan":"<val>", "status":"<val>"}
  * }
  * Response Failed
  * {"status":""}
  */
  public function actionDeleteProduksi()
  {
    $request = Yii::$app->request;

    if (isset($request)) {
        $model = \app\models\Produksi::findOne($request->post('id'));
        $model->status = 'dihapus';
        if($model->save(false)) {
          $response = [
            "status" => "success",
            "data" => [
              "id" => $model->id,
              "lahan_id" => $model->lahan_id,
              "petani_nama" => $model->petani->nama,
              "luas_m2" => $model->lahan->luas_m2,
              "lokasi_nama" => $model->lokasi->nama,
              "komoditas_kode" => $model->komoditas_kode,
              "komoditas_nama" => $model->komoditasKode->nama,
              "tgl_tanam" => date('d F Y', strtotime($model->tgl_tanam)),
              "tgl_panen" => date('d F Y', strtotime($model->tgl_panen)),
              "est_bobot_panen" => $model->est_bobot_panen,
              "harga_panen" => $model->harga_panen,
              "keterangan" => $model->keterangan,
              "status" => $model->status,
            ]
          ];

        } else {
            $response = "";
        }
      } else {
        $response = "";
      }

    return $response;
  }

}
