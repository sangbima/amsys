<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Produksi;
use app\models\ProduksiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\SetupDateHelpers;
use kartik\grid\EditableColumnAction;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * ProduksiController implements the CRUD actions for Produksi model.
 */
class ProduksiController extends Controller
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
          'modelClass' => Produksi::className(),
          'outputValue' => function($model, $attribute, $key, $index) {
            $value = $model->$attribute;
            return '';
          },
          'outputMessage' => function($model, $attribute, $key, $index) {
            return '';
          }
        ]
      ]);

      // return ArrayHelper::merge(parent::actions(), [
      //     'update' => [
      //         'class' => EditableColumnAction::className(),
      //         'modelClass' => Produksi::className(),
      //     ]
      // ]);
    }

    /**
     * Lists all Produksi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProduksiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Produksi model.
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
     * Creates a new Produksi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Produksi();
        $model->no_proposal = $this->generateProposalNo();

        if ($model->load(Yii::$app->request->post())) {
          $model->tgl_tanam = date('Y-m-d', strtotime($model->tgl_tanam));
          $model->tgl_panen = date('Y-m-d', strtotime($model->tgl_panen));
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
     * Updates an existing Produksi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            // return $this->redirect(['view', 'id' => $model->id]);
            $model->tgl_tanam = date('Y-m-d', strtotime($model->tgl_tanam));
            $model->tgl_panen = date('Y-m-d', strtotime($model->tgl_panen));
            if($model->save()) {
              return $this->redirect(['produksi/index']);
            }
        } else {
            $model->tgl_tanam = date('d F Y', strtotime($model->tgl_tanam));
            $model->tgl_panen = date('d F Y', strtotime($model->tgl_panen));
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Produksi model.
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
     * Finds the Produksi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Produksi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produksi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionProduksiList($q = null, $id = null)
    {
      // $q='Ace';
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $out = ['results' => ['id' => '', 'text' => '']];
      if (!is_null($q)) {
          $query = new \yii\db\Query;
          $query->select('id AS id, no_proposal AS text')
              ->from('produksi')
              ->where(['like', 'no_proposal', $q])
              ->andWhere(['status' => 'selesai'])
              ->limit(20);
          $command = $query->createCommand();
          $data = $command->queryAll();
          $out['results'] = array_values($data);
      }
      elseif ($id > 0) {
          $out['results'] = ['id' => $id, 'text' => Produksi::find($id)->no_proposal];
      }
      return $out;
    }

    public function generateProposalNo()
    {
      // Format Nomor proposal: <NO_URUT>/TEBAS/BLN/TAHUN

      $modelHelperNo = \app\models\HelperNomor::findOne(['parameter' => 'last_proposal_tebas']);
      $modelHelperNo->value = $modelHelperNo->value + 1;

      if($modelHelperNo->save(false)){
        return $modelHelperNo->value."/TEBAS/".date('m')."/".date('Y');
      } else {
        return false;
      }
    }
}
