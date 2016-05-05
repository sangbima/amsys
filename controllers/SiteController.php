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
        $modelHarga = InfoHarga::find()->select('pasar')->distinct()->all();
        $bulan=date('m');
        $tahun=date('Y');
        // $beforex="SELECT DISTINCT tanggal FROM info_harga WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun'";
        $beforex="SELECT DISTINCT tanggal FROM info_harga WHERE tanggal BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
        $_xseries = InfoHarga::findBysql($beforex)->all();
        $beforn = "SELECT DISTINCT pasar from info_harga";
        $_nseries = InfoHarga::findBysql($beforn)->all();

        $_xseries_data = array();
        $data_series =array();
        $_data = array ();
        $_data_series = array ();


        foreach ($_xseries as $xs)
        {
             $_xseries_data[] = date('d M Y', strtotime($xs["tanggal"]));
        }

        $num=0;
        $nsj=null;
        foreach ($_nseries as $ns)
        {

            array_push($data_series,array("name"=>$ns["pasar"],));

            $nsj=$ns['pasar'];

        }

        $beforn2 = "SELECT DISTINCT pasar from info_harga";
        $_nseries2 = InfoHarga::findBysql($beforn2)->all();

        foreach ($_nseries2 as $ds)
        {
            $num++;
            $pasar=$ds['pasar'];
            $beforem  =  "SELECT harga_kg from info_harga WHERE tanggal BETWEEN NOW() - INTERVAL 30 DAY AND NOW() AND pasar='$pasar'";
            // $beforem  =  "SELECT harga_kg from info_harga WHERE tanggal between NOW() AND NOW()";
            $months = InfoHarga::findBysql($beforem)->all();

            foreach ($months as $m)
            {
                $_data_series[] = (int)$m["harga_kg"];
            }
            array_push($_data,array(
                'name'=>$ds["pasar"],
                'data'=>$_data_series,
            ));


            if($num==5)
            break;
            unset($_data_series);


        }


        // $this->layout = 'dashboard';
        // return $this->render('index',[
        //     'modelPetani' => $modelPetani,
        //     'modelLahan' => $modelLahan,
        //     'modelEstimasi' => $modelEstimasi,
        //     'modelProduksi' => $modelProduksi,
        //     'modelHarga' => $modelHarga,
        //     'modelNama' => $_data,
        //     'dataX' => $_xseries_data,
        //     ]);


        $graphOk = array();
        $graphLahanOk = array();

        $pilihLokasi = 'SELECT distinct lokasi_kode from petani group by substr(lokasi_kode,1,6)';
        $eksLokasi = Petani::findBySql($pilihLokasi)->all();
        $numPet=0;
        foreach ($eksLokasi as $lokasi) {
                $kodeLokasi = substr($lokasi['lokasi_kode'],0,6);
                $sqlgraphPetani ="SELECT distinct nama from lokasi where substr(kode,1,6)='$kodeLokasi' group by substr(kode,0,6)";
                $graphPetani = Lokasi::findBysql($sqlgraphPetani)->one();

                $pilihCount = "SELECT * from petani where substr(lokasi_kode,1,6)='$kodeLokasi'";
                $eksCount = Petani::findBySql($pilihCount)->count();

                array_push($graphOk,array(
                'name'=>$graphPetani->nama,
                'data'=>array((int)$eksCount),
            ));

        }

        $pilihLahan = 'SELECT distinct lokasi_kode from lahan group by substr(lokasi_kode,1,6)';
        $eksLahan = Lahan::findBySql($pilihLokasi)->all();

        foreach ($eksLahan as $lahan) {
                $kodeLokasi = substr($lahan['lokasi_kode'],0,6);
                $sqlgraphLahan ="SELECT distinct nama from lokasi where substr(kode,1,6)='$kodeLokasi' group by substr(kode,0,6)";
                $graphLahan = Lokasi::findBysql($sqlgraphLahan)->one();

                $pilihCountLahan = "SELECT luas_m2 from lahan where substr(lokasi_kode,1,6)='$kodeLokasi'";
                $eksCountLahan = Lahan::findBySql($pilihCountLahan)->all();
                $luasLahan =0;
                foreach ($eksCountLahan as $eksCountLahan) {
                        $luasLahan+=$eksCountLahan['luas_m2'];

                }

                $luasLahan=$luasLahan/1000;
                array_push($graphLahanOk,array(
                'name'=>$graphLahan->nama,
                'data'=>array($luasLahan),
            ));

        }


        $this->layout = 'dashboard';
        return $this->render('index',[
            'modelPetani' => $modelPetani,
            'modelLahan' => $modelLahan,
            'modelEstimasi' => $modelEstimasi,
            'modelProduksi' => $modelProduksi,
            'modelHarga' => $modelHarga,
            'modelNama' => $_data,
            'dataX' => $_xseries_data,
            'graphOk' => $graphOk,
            'graphLahanOk' => $graphLahanOk
            ]);


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
}
