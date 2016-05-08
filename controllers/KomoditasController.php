<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Komoditas;
use app\models\KomoditasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\grid\EditableColumnAction;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * KomoditasController implements the CRUD actions for Komoditas model.
 */
class KomoditasController extends Controller
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
                      // 'actions' => ['logout', 'index', 'create', 'update', 'delete', 'view'],
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

  public function actions()
  {
    return ArrayHelper::merge(parent::actions(), [
        'updateInline' => [
            'class' => EditableColumnAction::className(),
            'modelClass' => Komoditas::className(),
        ]
    ]);
  }

    /**
     * Lists all Komoditas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KomoditasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Komoditas model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Komoditas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // $model = new Komoditas();

        /* Ini untuk multi komoditas dan multi varietas

        if ($model->load(Yii::$app->request->post())) {
          $request = Yii::$app->request;
          if(empty($request->post('Komoditas')['parent'])) {

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
        */

        // if ($model->load(Yii::$app->request->post())) {
        //   $model->parent = 1; // Komoditas Bawang
        //   $model->level = 'Variatas';
        //   $model->kode = $this->buatkode();
        //   if($model->save()){
        //     return $this->redirect(['view', 'id' => $model->kode]);
        //   }
        // } else {
        //     return $this->renderAjax('create', [
        //         'model' => $model,
        //     ]);
        // }

        // $model = new AcuanHarga();
        $model = new Komoditas();

        if ($model->load(Yii::$app->request->post())) {
          $model->parent = 1; // Komoditas Bawang
          $model->level = 'Variatas';
          $model->kode = $this->buatkode();

          if($model->save(false)) {
            echo 1;
          } else {
            echo 0;
          }
            // return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing Komoditas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        /* Ini untuk multi komoditas dan multi varietas

        if ($model->load(Yii::$app->request->post())) {
          $request = Yii::$app->request;
          if(empty($request->post('Komoditas')['parent'])) {

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
        */

        // if ($model->load(Yii::$app->request->post())) {
        //   if($model->save(false)){
        //     return $this->redirect(['view', 'id' => $model->kode]);
        //   }
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //     ]);
        // }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['komoditas/index']);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Deletes an existing Komoditas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function buatkode()
    {
        // Kode utama komoditas bawang 1
        $kodeutama = 1;
        $records = Komoditas::find()->where(['parent' => 1, 'level' => 'Variatas'])->all();

        $codes = [];
        $id = [0];
        $i=0;
        foreach ($records as $key) {
          $codes[$i] = explode('-', $key['kode']);
          $id[] = $codes[$i][1] ? $codes[$i][1] : 0;
          $i++;
        }

        $maxId = max($id);

        $nextcode = $maxId+1;

        $code = $kodeutama.'-'.$nextcode;
        return $code;
    }

    /**
     * Finds the Komoditas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Komoditas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Komoditas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
