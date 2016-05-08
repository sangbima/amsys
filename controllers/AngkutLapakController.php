<?php

namespace app\controllers;

use Yii;
use app\models\AngkutLapak;
use app\models\AngkutLapakSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AngkutLapakController implements the CRUD actions for AngkutLapak model.
 */
class AngkutLapakController extends Controller
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
     * Lists all AngkutLapak models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AngkutLapakSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AngkutLapak model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AngkutLapak model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AngkutLapak();

        if ($model->load(Yii::$app->request->post())) {
          $model->no_surat = $this->generateNoSuratAngkutLapak();
          if($model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
          }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AngkutLapak model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * Deletes an existing AngkutLapak model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function generateNoSuratAngkutLapak()
    {

      $helper_nomor = \app\models\HelperNomor::findOne(['parameter' => 'last_angkut_lapak']);
      $prev_no = $helper_nomor->value;
      $bln = date('m');
      $thn = date('y');
      $next_no = 0;

      $lastDayOfTheMonth=new \DateTime('last day of this month');
      // echo $lastDayOfTheMonth->format('d');

      $firstDayOfTheMonth = new \DateTime('first day of this month');
      // echo $firstDayOfTheMonth->format('d');
      // $firstDayOfTheMonth = 2;
      // // echo date('d');
      // $prev_no = 10;
      if(date('j') == $firstDayOfTheMonth) {
        $next_no = 1;
      } else {
        $next_no = $prev_no+1;
      }
      $helper_nomor->value = $next_no;
      if($helper_nomor->save()) {
          return $next_no . "/LAPAK/".$bln."/".$thn;
      } else {
        return false;
      }
    }

    /**
     * Finds the AngkutLapak model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AngkutLapak the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AngkutLapak::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
