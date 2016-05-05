<?php

namespace app\controllers;

use Yii;
use app\models\InfoHarga;
use app\models\Pasar;
use app\models\InfoHargaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InfoHargaController implements the CRUD actions for InfoHarga model.
 */
class InfoHargaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all InfoHarga models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InfoHargaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionMap()
    {
        $tanggal='2016-04-20';
        $sqlModel = "SELECT distinct info_harga.pasar, pasar.id, pasar.nama_pasar, pasar.latitude, pasar.longitude, info_harga.harga_kg, info_harga.tanggal FROM info_harga inner join pasar on info_harga.pasar=pasar.nama_pasar where info_harga.tanggal='$tanggal'";
        // $sqlModel = "SELECT * FROM pasar";
        // $model = Pasar::findBySql($sqlModel)->all();
        $items = \app\models\Pasar::findBySql($sqlModel)->asArray()->all();
        $dataJson = json_encode($items);
        

        return $this->render('map', [
            'model' => $dataJson,
        ]);
    }

    /**
     * Displays a single InfoHarga model.
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
     * Creates a new InfoHarga model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InfoHarga();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing InfoHarga model.
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
     * Deletes an existing InfoHarga model.
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
     * Finds the InfoHarga model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return InfoHarga the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InfoHarga::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
