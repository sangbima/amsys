<?php

namespace app\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use app\models\Lokasi;
use app\models\Lahan;
use app\models\LokasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * LokasiController implements the CRUD actions for Lokasi model.
 */
class MapController extends Controller
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

    /**
     * Lists all Lokasi models.
     * @return mixed
     */
    
    public function actionLokasi()
    {
        // $pilihLahan = 'SELECT lahan.lokasi_kode, lahan.luas_m2, lokasi.nama, lokasi.latitude, lokasi.longitude from lahan inner join lokasi on lahan.lokasi_kode=lokasi.kode group by substr(lahan.lokasi_kode,1,6)';

        $pilihLahan = 'SELECT SUM(lahan.luas_m2) as luasLahan, lahan.lokasi_kode, lahan.luas_m2, lokasi.nama, lokasi.latitude, lokasi.longitude from lahan inner join lokasi on substr(lahan.lokasi_kode,1,6)=lokasi.kode GROUP BY substr(lahan.lokasi_kode,1,6)';
        
        $items = \app\models\Lahan::findBySql($pilihLahan)->asArray()->all();

        $pilihLahan2 = 'SELECT substr(lahan.lokasi_kode,1,6) as kodekec, lahan.lokasi_kode, lahan.luas_m2, lokasi.nama, lokasi.latitude, lokasi.longitude from lahan inner join lokasi on lahan.lokasi_kode=lokasi.kode GROUP BY substr(lahan.lokasi_kode,1,6)';
        
        $items2 = Lahan::findBysql($pilihLahan2)->all();
        

        $dataJson = json_encode($items);

        return $this->render('lokasi', [
            'model' => $dataJson,
            'model2' => $items2,
        ]);
    }


    public function actionInfoHarga()
    {
        $tanggal='2016-04-20';
        $sqlModel = "SELECT distinct info_harga.pasar, pasar.id, pasar.nama_pasar, pasar.latitude, pasar.longitude, info_harga.harga_kg, info_harga.tanggal FROM info_harga inner join pasar on info_harga.pasar=pasar.nama_pasar where info_harga.tanggal='$tanggal'";
        // $sqlModel = "SELECT * FROM pasar";
        // $model = Pasar::findBySql($sqlModel)->all();
        $items = \app\models\Pasar::findBySql($sqlModel)->asArray()->all();
        $dataJson = json_encode($items);
        

        return $this->render('info-harga', [
            'model' => $dataJson,
        ]);
    }

    
}
