<?php

use yii\helpers\Html;
use yii\grid\GridView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LokasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lokasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="box-body">

    <h3><i class="fa fa-map-marker"></i> <?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        if ((Mimin::checkRoute($this->context->id.'/create'))){
          Html::a('<i class="fa fa-plus"></i> Lokasi', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode',
            'nama',
            'level',
            // 'parent',
            // 'user_id',
            // 'created',
            // 'updated',

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
