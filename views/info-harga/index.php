<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InfoHargaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Info Harga';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-harga-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Info Harga', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
              'attribute'=>'komoditas_kode',
              'label'=>'Komoditas',
              'value'=>'komoditasKode.nama'
            ],
            'tanggal',
            'harga_kg',
            'pasar',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
