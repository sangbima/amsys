<?php

namespace app\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use app\models\Lokasi;
use app\models\LokasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * LokasiController implements the CRUD actions for Lokasi model.
 */
class LokasiController extends Controller
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
    public function actionIndex()
    {
        $searchModel = new LokasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lokasi model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Lokasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lokasi();

        if ($model->load(Yii::$app->request->post())) {
          $request = Yii::$app->request;
          if(empty($request->post('Lokasi')['parent'])) {

            $model->parent = null;
            if($model->save()){
              return $this->redirect(['view', 'id' => $model->kode]);
            }
          } else {
            if($model->save()){
              return $this->redirect(['view', 'id' => $model->kode]);
            }
          }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Lokasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
          $request = Yii::$app->request;
          if(empty($request->post('Lokasi')['parent'])) {

            $model->parent = null;
            if($model->save()){
              return $this->redirect(['view', 'id' => $model->kode]);
            }
          } else {
            if($model->save()){
              return $this->redirect(['view', 'id' => $model->kode]);
            }
          }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->kode]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //     ]);
        // }
    }

    /**
     * Deletes an existing Lokasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
      $parent = Lokasi::findAll(['parent'=>$id]);
      //var_dump($parent);die();
      if($parent){
        Yii::$app->session->setFlash('error', 'Data gagal dihapus');
        return $this->redirect(['index']);
      } else {
        Yii::$app->session->setFlash('success', 'Data berhasil dihapus');
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
      }
        // $this->findModel($id)->delete();
        //
        // return $this->redirect(['index']);
    }

    public function actionListkotakab()
    {
      $out = [];
      if(isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if($parents != null) {
          $kodeprov = $parents[0];
          $out = self::getKotakab($kodeprov);
          echo Json::encode(['output'=>$out, 'selected'=>'']);
          return;
        }
      }
      echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionListkec()
    {
      $out = [];
      if(isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        $kotakabid = empty($parents[1]) ? null : $parents[1];

        if($parents != null) {
          $out = self::getKec($kotakabid);
          echo Json::encode(['output'=>$out, 'selected'=>'']);
          return;
        }
      }
      echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionListkeldes()
    {
      $out = [];
      if(isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if($parents != null) {
          $kodekec = $parents[2];
          $out = self::getKeldes($kodekec);
          echo Json::encode(['output'=>$out, 'selected'=>'']);
          return;
        }
      }
      echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionListParent()
    {
      // $out = [];
      // if(isset($_POST['depdrop_parents'])) {
      //   $level = end($_POST['depdrop_parents']);
      //   $list = Lokasi::find()->select(['kode as id', 'nama as name'])
      //             ->where(['level' => $level])->asArray()->all();
      //   $selected = null;
      //   if($level != null && count($list) > 0){
      //     $selected = '';
      //     if(!empty($_POST['depdrop_parents'])) {
      //       $params = $_POST['depdrop_parents'];
      //       $kode = $params[0];
      //
      //       foreach ($list as $key => $value) {
      //         $out[] = ['id' => $value['id'], 'name' => $value['name']];
      //         if($key == 0) {
      //           $aux = $value['id'];
      //         }
      //
      //         ($value['id'] == $kode) ? $selected = $kode : $selected = $aux;
      //       }
      //     }
      //
      //     echo Json::encode(['output' => $out, 'selected' => $selected]);
      //   }
      // }
      // echo Json::encode(['output' => '', 'selected' => '']);

      // $out = [];
      // if(isset($_POST['depdrop_parents'])) {
      //   $parents = $_POST['depdrop_parents'];
      //   if($parents != null) {
      //     $level = $parents[0];
      //
      //     switch ($level) {
      //       case 'DesaKelurahan':
      //         $plevel = "Kecamatan";
      //         break;
      //       case 'Kecamatan':
      //         $plevel = "KabKota";
      //         break;
      //       case 'KabKota':
      //         $plevel = "Provinsi";
      //         break;
      //       default:
      //         $plevel = null;
      //         break;
      //     }
      //
      //     $list = Lokasi::find()->select(['kode as id', 'nama as name'])
      //             ->where(['level' => $plevel])->asArray()->all();
      //
      //     $selected = null;
      //     if(!empty($_POST['depdrop_parents'])) {
      //       $params = $_POST['depdrop_parents'];
      //
      //       foreach ($list as $key => $value) {
      //         $out[] = ['id' => $value['id'], 'name' => $value['name']];
      //         if($key == 0) {
      //           $aux = $value['id'];
      //         }
      //
      //         ($value['id'] == $level) ? $selected = $level : $selected = $aux;
      //       }
      //     }
      //
      //     // $out = self::getLevel($level);
      //
      //     echo Json::encode(['output'=>$out, 'selected'=>$selected]);
      //     return;
      //   }
      // }
      // echo Json::encode(['output'=>'', 'selected'=>'']);

      // $out = [];
      // if(isset($_POST['depdrop_parents'])) {
      //   $params = $_POST['depdrop_parents'];
      //   // $level = end($_POST['depdrop_parents']);
      //   // $parent = empty($params[0]) ? null : $params[0];
      //
      //   $level = empty($params[0]) ? null : $params[0];
      //   $parent = empty($params[1]) ? null : $params[1];
      //
      //   // $parent = 33;
      //   if($level != null) {
      //     $data = self::getLevel($level, $parent);
      //
      //     echo Json::encode([
      //       'output' => $data['out'],
      //       'selected' => $data['selected']
      //     ]);
      //     return;
      //   }
      // }
      // echo Json::encode(['output' => '', 'selected' => '']);

      $out = [];
      if(isset($_POST['depdrop_parents'])) {
        $params = $_POST['depdrop_parents'];
        $level = $params[0];

        if($level != null) {
          $data = self::getLevel($level);

          echo Json::encode(['output' => $data, 'selected' => '']);
          return;
        }
      }
      echo Json::encode(['output' => '', 'selected' => '']);
    }

    // public function getLevel($level, $parent)
    // {
    //   switch ($level) {
    //     case 'DesaKelurahan':
    //       $plevel = "Kecamatan";
    //       break;
    //     case 'Kecamatan':
    //       $plevel = "KabKota";
    //       break;
    //     case 'KabKota':
    //       $plevel = "Provinsi";
    //       break;
    //     default:
    //       $plevel = null;
    //       break;
    //   }
    //
    //   $query = Lokasi::find()->select(['kode as id', 'nama as name'])
    //           ->where(['level' => $plevel])->asArray()->all();
    //   $selected = Lokasi::findOne(['parent' => $parent]);
    //   $output = [
    //     'out' => $query,
    //     'selected' => $selected,
    //   ];
    //   return $output;
    // }

    public function getLevel($level)
    {
      switch ($level) {
        case 'DesaKelurahan':
          $plevel = "Kecamatan";
          break;
        case 'Kecamatan':
          $plevel = "KabKota";
          break;
        case 'KabKota':
          $plevel = "Provinsi";
          break;
        default:
          $plevel = null;
          break;
      }

      $query = Lokasi::find()->select(['kode as id', 'nama as name'])
              ->where(['level' => $plevel])->asArray()->all();
      return $query;
    }

    public function getSubLevel($level, $initKode)
    {
      $query = Lokasi::find()->select(['kode as id', 'nama as name'])
              ->where(['level' => $level, 'kode'=>$initKode])->asArray()->all();

      return $query;
    }

    public function getKotakab($kode)
    {
      $query = Lokasi::find()->where(['level' => 'KabKota', 'parent' => $kode])->all();

      $map = ArrayHelper::map($query, 'kode', 'nama');

      $mapping = array();
      $i = 0;
      foreach ($map as $key => $value) {
        $mapping[$i] = array('id' => $key, 'name' => $value);
        $i++;
      }

      return $mapping;
    }

    public function getKec($kode)
    {
      $query = Lokasi::find()->where(['level' => 'Kecamatan', 'parent' => $kode])->all();

      $map = ArrayHelper::map($query, 'kode', 'nama');

      $mapping = array();
      $i = 0;
      foreach ($map as $key => $value) {
        $mapping[$i] = array('id' => $key, 'name' => $value);
        $i++;
      }

      return $mapping;
    }

    public function getKeldes($kode)
    {
      $query = Lokasi::find()->where(['level' => 'DesaKelurahan', 'parent' => $kode])->all();

      $map = ArrayHelper::map($query, 'kode', 'nama');

      $mapping = array();
      $i = 0;
      foreach ($map as $key => $value) {
        $mapping[$i] = array('id' => $key, 'name' => $value);
        $i++;
      }

      return $mapping;
    }

    public function actionLocationList($q = null, $id = null)
    {
      // $q='Ace';
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $out = ['results' => ['id' => '', 'text' => '']];
      if (!is_null($q)) {
          $query = new \yii\db\Query;
          $query->select('kode AS id, nama AS text')
              ->from('lokasi')
              ->where(['like', 'nama', $q])
              ->limit(20);
          $command = $query->createCommand();
          $data = $command->queryAll();
          $out['results'] = array_values($data);
      }
      elseif ($id > 0) {
          $out['results'] = ['id' => $id, 'text' => Lokasi::find($id)->name];
      }
      return $out;
    }

    /**
     * Finds the Lokasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Lokasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lokasi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
