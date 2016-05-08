<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GudangBangunanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gudang Bangunan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gudang-bangunan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Gudang Bangunan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
              'attribute' => 'gudang_id',
              'label' => 'Gudang',
              'value' => 'gudang.nama'
            ],
            'kode',
            'kapasitas_m3',
            'latitude',
            'longitude',
            // 'user_id',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
