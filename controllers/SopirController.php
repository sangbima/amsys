<?php

namespace app\controllers;

use Yii;
use app\models\Sopir;
use app\models\SopirSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kartik\grid\EditableColumnAction;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * SopirController implements the CRUD actions for Sopir model.
 */
class SopirController extends Controller
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

    public function actions()
    {
      return ArrayHelper::merge(parent::actions(), [
          'updateInline' => [
              'class' => EditableColumnAction::className(),
              'modelClass' => Sopir::className(),
          ]
      ]);
    }
    /**
     * Lists all Sopir models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SopirSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sopir model.
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
     * Creates a new Sopir model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // $model = new Sopir();
        //
        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        // }

        $model = new Sopir();

        if ($model->load(Yii::$app->request->post())) {
          if($model->save()) {
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
     * Updates an existing Sopir model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        // $model = $this->findModel($id);
        //
        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //     ]);
        // }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()) {
              return $this->redirect(['sopir/index']);
            }
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Sopir model.
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
     * Finds the Sopir model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Sopir the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sopir::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSopirList($q = null, $id = null)
    {
      // $q='Ace';
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $out = ['results' => ['id' => '', 'text' => '']];
      if (!is_null($q)) {
          $query = new \yii\db\Query;
          $query->select('id AS id, nama AS text')
              ->from('sopir')
              ->where(['like', 'nama', $q])
              ->limit(20);
          $command = $query->createCommand();
          $data = $command->queryAll();
          $out['results'] = array_values($data);
      }
      elseif ($id > 0) {
          $out['results'] = ['id' => $id, 'text' => Sopir::find($id)->name];
      }
      return $out;
    }
}
