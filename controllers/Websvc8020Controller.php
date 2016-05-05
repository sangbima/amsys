<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;

/**
* Edit/Update: Lokasi, Petani, Lahan, Varietas, Produksi
*/

class Websvc8020Controller extends \yii\rest\Controller
{
  protected function verbs()
  {

    return [
      'edit-petani' => ['POST','OPTIONS'],
      'edit-lahan' => ['POST','OPTIONS'],
      'edit-produksi' => ['POST','OPTIONS'],
      'update-pemilik-lahan' => ['POST','OPTIONS'],
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
  * Edit Petani
  * Method POST
  * Request id, nama, alamat, no_ktp, lokasi_kode
  * Response Success
  * {
  *   "status" : "success",
  *   "data" : {"id":"<val>", "nama":"<val>", "alamat":"<val>", "no_ktp":"<val>",
  *             "lokasi_kode":"<val>", "lokasi_nama":"<val>"}
  * }
  * Response Failed
  * {"status":""}
  */
  public function actionEditPetani()
  {
    $request = Yii::$app->request;

    if (isset($request)) {
      // $model->id = $request->post('id');
      $model = \app\models\Petani::findOne($request->post('id'));

      $model->nama = $request->post('nama');
      $model->alamat = $request->post('alamat');
      $model->no_ktp = $request->post('no_ktp');
      $model->lokasi_kode = $request->post('lokasi_kode');

      if($model->save(false)){
        $response = [
          "status" => "success",
          "data" => [
            "id" => $model->id,
            "nama" => $model->nama,
            "alamat" => $model->alamat,
            "no_ktp" => $model->no_ktp,
            "lokasi_kode" => $model->lokasi_kode,
            "lokasi_nama" => $model->lokasiKode->nama
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
  * Edit Lahan
  * Method POST
  * Request id, petani_id, lokasi_kode, luas_m2, keterangan
  * Response Success
  * {
  *   "status" : "success",
  *   "data" : {"id":"<val>", "petani_id":"<val>", "petani_nama":"<val>",
  *             "lokasi_kode":"<val>", "lokasi_nama":"<val>", "luas_m2":"<val>", "keterangan":"<val>"}
  * }
  * Response Failed
  * {"status":""}
  */
  public function actionEditLahan()
  {
    $request = Yii::$app->request;
    if (isset($request)) {
      $model = \app\models\Lahan::findOne($request->post('id'));

      $model->petani_id = $request->post('petani_id');
      $model->lokasi_kode = $request->post('lokasi_kode');
      $model->luas_m2 = $request->post('luas_m2');
      $model->keterangan = $request->post('keterangan');
      // $model->status = $request->post('status');

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
            // "status" => $model->status,
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
  * Edit Produksi
  * Method POST
  * Request id, user_id, lahan_id, komoditas_kode, tgl_tanam, tgl_panen, est_bobot_panen, harga_panen
  * Response Success
  * {
  *   "status" : "success",
  *   "data" : {"id":"<val>", "lahan_id":"<val>", "komoditas_kode":"<val>",
  *             "tgl_tanam":"<val>", "tgl_panen":"<val>", "est_bobot_panen":"<val>","harga_panen":"<val>",
  *             "no_proposal":"<val>","created":"<val>","updated":"<val>"
  *             }
  * }
  * Response Failed
  * {"status":""}
  */
  public function actionEditProduksi()
  {
    $request = Yii::$app->request;

    if (isset($request)) {
        $model = \app\models\Produksi::findOne($request->post('id'));
        $model->status = 'diganti';
        if($model->save(false)) {
          $newModel = new \app\models\Produksi();
          $newModel->lahan_id = $request->post('lahan_id');
          $newModel->no_proposal = $model->no_proposal;
          $newModel->komoditas_kode = $request->post('komoditas_kode');
          $newModel->tgl_tanam = date('Y-m-d', strtotime($request->post('tgl_tanam')));
          $newModel->tgl_panen = date('Y-m-d', strtotime($request->post('tgl_panen')));
          $newModel->est_bobot_panen = $request->post('est_bobot_panen');
          $newModel->harga_panen = $request->post('harga_panen');
          $newModel->status = 'pending';

          if($newModel->save(false)){
            $response = [
              "status" => "success",
              "data" => [
                "id" => $newModel->id,
                "no_proposal" => $newModel->no_proposal,
                "lahan_id" => $newModel->lahan_id,
                "petani_nama" => $newModel->petani->nama,
                "luas_m2" => $newModel->lahan->luas_m2,
                "lokasi_nama" => $newModel->lokasi->nama,
                "komoditas_kode" => $newModel->komoditas_kode,
                "komoditas_nama" => $newModel->komoditasKode->nama,
                "tgl_tanam" => date('d F Y', strtotime($newModel->tgl_tanam)),
                "tgl_panen" => date('d F Y', strtotime($newModel->tgl_panen)),
                "est_bobot_panen" => $newModel->est_bobot_panen,
                "harga_panen" => $newModel->harga_panen,
                "status" => $newModel->status,
                "created" => $newModel->created,
                "updated" => $newModel->updated,
              ]
            ];
          } else {
            $response = "";
          }
        } else {
          $response = "";
        }
    } else {
      $response = "";
    }

    return $response;
  }

  /**
  * Update Pemilik Lahan
  * Method POST
  * Request petani_id, lahan_id
  * Response Success
  * {
  *   "status" : "success",
  *   "data" : {"id":"<val>", "petani_id":"<val>", "petani_nama":"<val>",
  *             "lokasi_kode":"<val>", "lokasi_nama":"<val>", "luas_m2":"<val>", "keterangan":"<val>"}
  * }
  * Response Failed
  * {"status":""}
  */
  public function actionUpdatePemilikLahan()
  {
    $request = Yii::$app->request;
    // $idLahan = $request->post('lahan_id');
    //
    // $model = \app\models\Produksi::findOne($idLahan);

    if (isset($request)) {
      $idLahan = $request->post('lahan_id');
      $model = \app\models\Lahan::findOne($idLahan);

      $model->petani_id = $request->post('petani_id');
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
            "keterangan" => $model->keterangan
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
