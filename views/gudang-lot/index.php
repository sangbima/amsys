<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GudangLotSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gudang Lot';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gudang-lot-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        if((Mimin::checkRoute($this->context->id.'/create'))) {
          echo Html::a('<i class="fa fa-plus"></i> Gudang Lot', ['create'], ['class' => 'btn btn-success']); 
        }
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
              'attribute'=>'gudang_bangunan_id',
              'label'=>'Gudang Bangunan',
              'value'=>'gudangBangunan.kode'
            ],
            'kode',
            'kapasitas_m3',
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
