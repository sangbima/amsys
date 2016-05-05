<?php

namespace app\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use app\models\Lahan;
use app\models\LahanSearch;
use app\models\Petani;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * LahanController implements the CRUD actions for Lahan model.
 */
class LahanController extends Controller
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
     * Lists all Lahan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LahanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lahan model.
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
     * Creates a new Lahan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lahan();

        if($model->load(Yii::$app->request->post())){
          $request = Yii::$app->request;
          if(empty($request->post('Lahan')['keldes'])) {
            if(empty($request->post('Lahan')['kec'])) {
              if(empty($request->post('Lahan')['kotakab'])) {
                $model->lokasi_kode = $request->post('Lahan')['provinsi'];
              } else {
                $model->lokasi_kode = $request->post('Lahan')['kotakab'];
              }
            } else {
              $model->lokasi_kode = $request->post('Lahan')['kec'];
            }
            if($model->save(false)){
              return $this->redirect(['view', 'id' => $model->id]);
            }
          } else {
            $model->lokasi_kode = $request->post('Lahan')['keldes'];
            if($model->save(false)){
              return $this->redirect(['view', 'id' => $model->id]);
            }
          }
        } else {
          return $this->render('create', [
            'model' => $model,
          ]);
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        // }
    }

    /**
     * Updates an existing Lahan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post())){
          $request = Yii::$app->request;
          if(empty($request->post('Lahan')['keldes'])) {
            if(empty($request->post('Lahan')['kec'])) {
              if(empty($request->post('Lahan')['kotakab'])) {
                $model->lokasi_kode = $request->post('Lahan')['provinsi'];
              } else {
                $model->lokasi_kode = $request->post('Lahan')['kotakab'];
              }
            } else {
              $model->lokasi_kode = $request->post('Lahan')['kec'];
            }
            if($model->save(false)){
              return $this->redirect(['view', 'id' => $model->id]);
            }
          } else {
            $model->lokasi_kode = $request->post('Lahan')['keldes'];
            if($model->save(false)){
              return $this->redirect(['view', 'id' => $model->id]);
            }
          }
        } else {
          return $this->render('update', [
            'model' => $model,
          ]);
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //     ]);
        // }
    }

    /**
     * Deletes an existing Lahan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    // public function actionListpetani()
    // {
    //   $out = [];
    //   if(isset($_POST['depdrop_parents'])) {
    //     $parents = $_POST['depdrop_parents'];
    //
    //     $lokasikode = empty($parents[3]) ? null : $parents[3];
    //
    //
    //     if($parents != null) {
    //       $out = self::getLokasi($lokasikode);
    //       echo Json::encode(['output'=>$out, 'selected'=>'']);
    //       return;
    //     }
    //   }
    //
    //   echo Json::encode(['output'=>'', 'selected'=>'']);
    // }

    // public function getLokasi($kode)
    // {
    //   $query = Petani::find()->where(['lokasi_kode' => $kode])->all();
    //
    //   $map = ArrayHelper::map($query, 'id', 'nama');
    //
    //   $mapping = array();
    //   $i = 0;
    //   foreach ($map as $key => $value) {
    //     $mapping[$i] = array('id' => $key, 'name' => $value);
    //     $i++;
    //   }
    //
    //   return $mapping;
    // }

    /**
     * Finds the Lahan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Lahan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lahan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
