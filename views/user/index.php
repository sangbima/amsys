<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="box-body">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'username',
            'nama',
            'email:email',
            // 'status',
            // [
            //   'attribute'=>'status',
            //   'filter'=>array("10"=>"Active","0"=>"Inactive"),
            //   'headerOptions'=>['width'=>'100'],
            //   'content'=>function($d){
            //       return $d->getStatusLabel($d->status);
            //   }
            // ],
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            //

            // 'created',
            // 'updated',
            // 'user_id',
            // 'token',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
