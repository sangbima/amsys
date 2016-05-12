<?php

use yii\helpers\Html;
use yii\grid\GridView;
use hscstudio\mimin\components\Mimin;

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
        <?php
        if ((Mimin::checkRoute($this->context->id.'/create'))){
          echo Html::a('<i class="fa fa-plus"></i> User', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
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
            [
              'attribute' => 'roles',
              'format' => 'raw',
              'value' => function ($data) {
                $roles = [];
                foreach ($data->roles as $role) {
                  $roles[] = $role->item_name;
                }
                return Html::a(implode(',', $roles), ['view', 'id' => $data->id]);
              }
            ],
            [
              'attribute' => 'status',
              'filter'=>array("10"=>"Active","0"=>"Banned"),
              'format' => 'raw',
              'options' => [
                'width' => '100px',
              ],
              'value' => function ($data) {
                return $data->getStatusLabel($data->status);
              }
            ],
            [
              'attribute' => 'created_at',
              'format' => ['date', 'php:d M Y H:i:s'],
            ],

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => Mimin::filterActionColumn([
                'view', 'update', 'delete'
              ], $this->context->route)
            ],
        ],
    ]); ?>
</div>
</div>
