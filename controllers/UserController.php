<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\User;
use app\models\UserSearch;
use app\models\AuthAssignment;
use app\models\AuthItem;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AdduserForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\helpers\ArrayHelper;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      $model = $this->findModel($id);
      $authAssignments = AuthAssignment::find()->where([
   			'user_id' => $model->id,
   		])->column();

   		$authItems = ArrayHelper::map(
   			AuthItem::find()->where([
   				'type' => 1,
   			])->asArray()->all(),
   			'name', 'name');

   		$authAssignment = new AuthAssignment([
   			'user_id' => $model->id,
   		]);

   		if (Yii::$app->request->post()) {
   			$authAssignment->load(Yii::$app->request->post());
   			// delete all role
   			AuthAssignment::deleteAll(['user_id' => $model->id]);
   			if (is_array($authAssignment->item_name)) {
   				foreach ($authAssignment->item_name as $item) {
   					if (!in_array($item, $authAssignments)) {
   						$authAssignment2 = new AuthAssignment([
   							'user_id' => $model->id,
   						]);
              // var_dump($authAssignment2);die();
   						$authAssignment2->item_name = $item;
   						$authAssignment2->created_at = time();
   						$authAssignment2->save();

   						$authAssignments = AuthAssignment::find()->where([
   							'user_id' => $model->id,
   						])->column();
   					}
   				}
   			}
   			Yii::$app->session->setFlash('success', 'Data tersimpan');
   		}
   		$authAssignment->item_name = $authAssignments;
   		return $this->render('view', [
   			'model' => $model,
   			'authAssignment' => $authAssignment,
   			'authItems' => $authItems,
   		]);
   	}

    public function actionCreate()
    {
      $model = new User();

      if($model->load(Yii::$app->request->post())) {
        $model->setPassword('123456');
        $model->status = $model->status == 1 ? 10 : 0;
        if($model->save()) {
          Yii::$app->session->setFlash('success', 'User berhasil dibuat dengan password 123456');
        } else {
          Yii::$app->session->setFlash('error', 'User gagal dibuat');
        }

        return $this->redirect(['view', 'id' => $model->id]);
      } else {
        return $this->render('create', [
          'model' => $model,
        ]);
      }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
      $model = $this->findModel($id);

      $request = Yii::$app->request;
      if($model->load(Yii::$app->request->post()) && $model->save()) {
        if(!empty($model->new_password)) {
          if($model->validatePassword($model->new_password)) {
            $model->setPassword($model->new_password);
          }
        }
        $model->status = $request->post('User')['status'] == 1 ? 10 : 0;
        if($model->save()) {
          Yii::$app->session->setFlash('success', 'User berhasil diupdate');
        } else {
          Yii::$app->session->setFlash('error', 'User gagal diupdate');
        }
        return $this->redirect(['view', 'id' => $model->id]);
      } else {
        $model->status = $model->status == 10 ? 1 : 0;
        return $this->render('update', [
          'model' => $model,
        ]);
      }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
