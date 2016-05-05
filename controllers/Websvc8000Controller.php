<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;

/**
* List/Daftar: Lokasi, Petani, Lahan, Varietas, Produksi
*/
class Websvc8000Controller extends \yii\rest\Controller
{

  protected function verbs()
  {

    return [
      'daftar-lokasi' => ['GET','OPTIONS'],
      'daftar-petani' => ['GET','OPTIONS'],
      'daftar-lahan' => ['GET','OPTIONS'],
      'daftar-varietas' => ['GET','OPTIONS'],
      'daftar-produksi' => ['GET','OPTIONS'],
      'acuan-harga' => ['GET','OPTIONS'],
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
  * Daftar Lokasi
  * Method GET
  * Request -
  * return kode, nama, level, parent
  */
  public function actionDaftarLokasi()
  {
    $model = \app\models\Lokasi::find()
            ->select('kode, nama, level, parent')
            ->orderBy([
              'kode' => SORT_ASC
            ])
            ->all();

    return $model;
  }

  /**
  * Daftar Petani
  * Method GET
  * Request -
  * return id, nama, alamat, lokasi_kode, lokasi_nama, no_ktp
  */
  public function actionDaftarPetani()
  {
    $query = new \yii\db\Query;
    $query->select('petani.id, petani.nama, petani.alamat, petani.lokasi_kode, lokasi.nama as lokasi_nama, petani.no_ktp')
          ->from('petani')
          ->leftJoin('lokasi', 'petani.lokasi_kode = lokasi.kode')
          ->where(['petani.user_id' => Yii::$app->user->id, 'petani.status' => 'aktif'])
          ->orderBy([
            'petani.id' => SORT_DESC,
          ]);
    $command = $query->createCommand();

    $model = $command->queryAll();

    return $model;
  }

  /**
  * Daftar Semua Petani Tanpa Filter User
  * Method GET
  * Request -
  * return id, nama, alamat, lokasi_kode, lokasi_nama, no_ktp
  */
  public function actionDaftarSemuaPetani()
  {
    $query = new \yii\db\Query;
    $query->select('petani.id, petani.nama, petani.alamat, petani.lokasi_kode, lokasi.nama as lokasi_nama, petani.no_ktp')
          ->from('petani')
          ->leftJoin('lokasi', 'petani.lokasi_kode = lokasi.kode')
          ->where(['petani.status' => 'aktif'])
          ->orderBy([
            'petani.id' => SORT_DESC,
          ]);
    $command = $query->createCommand();

    $model = $command->queryAll();

    return $model;
  }

  /**
  * Daftar Lahan
  * Method GET
  * Request -
  * return id, petani_id, petani_nama, luas, lokasi_kode, lokasi_nama
  */
  public function actionDaftarLahan()
  {
    $query = new \yii\db\Query;
    $query->select('lahan.id, lahan.petani_id, petani.nama as petani_nama, lahan.luas_m2 as luas, lahan.lokasi_kode as lokasi_kode, lokasi.nama as lokasi_nama')
          ->from('lahan')
          ->leftJoin('petani', 'lahan.petani_id = petani.id')
          ->leftJoin('lokasi', 'lahan.lokasi_kode = lokasi.kode')
          ->where(['lahan.user_id' => Yii::$app->user->id, 'lahan.status' => 'aktif'])
          ->andWhere(['not', ['lahan.petani_id' => null]])
          ->orderBy([
            'lahan.id' => SORT_DESC,
          ]);


    $command = $query->createCommand();
    $model = $command->queryAll();

    return $model;
  }

  /**
  * Daftar Semua Lahan Tanpa Filter User
  * Method GET
  * Request -
  * return id, petani_id, petani_nama, luas, lokasi_kode, lokasi_nama
  */
  public function actionDaftarSemuaLahan()
  {
    $query = new \yii\db\Query;
    $query->select('lahan.id, lahan.petani_id, petani.nama as petani_nama, lahan.luas_m2 as luas, lahan.lokasi_kode as lokasi_kode, lokasi.nama as lokasi_nama')
          ->from('lahan')
          ->leftJoin('petani', 'lahan.petani_id = petani.id')
          ->leftJoin('lokasi', 'lahan.lokasi_kode = lokasi.kode')
          ->where(['lahan.status' => 'aktif'])
          ->andWhere(['not', ['lahan.petani_id' => null]])
          ->orderBy([
            'lahan.id' => SORT_DESC,
          ]);

    $command = $query->createCommand();
    $model = $command->queryAll();

    return $model;
  }


  /**
  * Daftar Komoditas
  */
  public function actionDaftarVarietas()
  {
    $model = \app\models\Komoditas::find()->select('kode, nama, keterangan, parent')
                                          ->where(['parent' => 1])
                                          ->all();

    return $model;
  }

  /**
  * Daftar Produksi
  * Method GET
  * Request -
  * return id, lahan_id, petani_id, petani_nama, lokasi_kode, lokasi_nama,
  *       komoditas_kode, komoditas_nama, tgl_tanam, tgl_panen,
  *       est_bobot_panen, harga_panen, no_proposal, created, updated, status
  */
  public function actionDaftarProduksi()
  {
    $query = new \yii\db\Query;
    $query->select('
            produksi.id, produksi.lahan_id, lahan.petani_id, petani.nama as petani_nama, lahan.lokasi_kode,
            lokasi.nama as lokasi_nama, lahan.luas_m2 as lahan_luas,produksi.komoditas_kode, komoditas.nama as komoditas_nama,
            produksi.tgl_tanam, produksi.tgl_panen, produksi.est_bobot_panen, produksi.harga_panen, produksi.no_proposal,
            produksi.created, produksi.updated, produksi.status
          ')
          ->from('produksi')
          ->leftJoin('lahan', 'produksi.lahan_id = lahan.id')
          ->leftJoin('petani', 'lahan.petani_id = petani.id')
          ->leftJoin('lokasi', 'lahan.lokasi_kode = lokasi.kode')
          ->leftJoin('komoditas', 'produksi.komoditas_kode = komoditas.kode')
          ->where(['produksi.user_id' => Yii::$app->user->id])
          ->andWhere(['<>','produksi.status','dihapus'])
          ->andWhere(['not', ['lahan.petani_id' => null]])
          ->orderBy([
            'produksi.id' => SORT_DESC,
          ]);

    $command = $query->createCommand();
    $model = $command->queryAll();

    return $model;
  }

  /**
  * Daftar Acuan Harga
  * Method GET
  * Request -
  * return komoditas_kode, komoditas_nama, harga, created
  */
  public function actionAcuanHarga()
  {
    $query = new \yii\db\Query;
    $query->select(
            'sub.komoditas_kode, komoditas.nama as komoditas_nama, sub.harga, sub.created'
            )
          ->from(
          '(SELECT * FROM acuan_harga order by acuan_harga.created desc) as sub'
          )
          ->leftJoin('komoditas', 'komoditas.kode = sub.komoditas_kode')
          ->groupBy(['sub.komoditas_kode'])
          ->orderBy([
            'sub.komoditas_kode' => SORT_ASC,
          ]);

    $command = $query->createCommand();
    $model = $command->queryAll();

    return $model;
  }
}
