<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Petani;
use app\models\PetaniSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Lokasi;

/**
 * PetaniController implements the CRUD actions for Petani model.
 */
class PetaniController extends Controller
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
                        'actions' => ['logout', 'index', 'create', 'update', 'delete', 'view'],
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
     * Lists all Petani models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PetaniSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Petani model.
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
     * Creates a new Petani model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Petani();
        $model->user_id = Yii::$app->user->identity->username;

        if($model->load(Yii::$app->request->post())){
          $request = Yii::$app->request;
          if(empty($request->post('Petani')['keldes'])) {
            if(empty($request->post('Petani')['kec'])) {
              if(empty($request->post('Petani')['kotakab'])) {
                $model->lokasi_kode = $request->post('Petani')['provinsi'];
              } else {
                $model->lokasi_kode = $request->post('Petani')['kotakab'];
              }
            } else {
              $model->lokasi_kode = $request->post('Petani')['kec'];
            }
            // $model->user_id = Yii::$app->user->identity->username;
            // var_dump($model->lokasi_kode);die();
            if($model->save(false)){
              return $this->redirect(['view', 'id' => $model->id]);
            }
          } else {
            $model->lokasi_kode = $request->post('Petani')['keldes'];
            //var_dump($model->save());die();
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
     * Updates an existing Petani model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Petani model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Petani model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Petani the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Petani::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
