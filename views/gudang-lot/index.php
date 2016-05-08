<?php

use yii\helpers\Html;
use kartik\grid\GridView;

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
        <?= Html::a('<i class="fa fa-plus"></i> Gudang Lot', ['create'], ['class' => 'btn btn-success']) ?>
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
