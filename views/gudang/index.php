<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GudangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gudang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gudang-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        if((Mimin::checkRoute($this->context->id.'/create'))) {
          echo Html::a('<i class="fa fa-plus"></i> Gudang', ['create'], ['class' => 'btn btn-success']); 
        }
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nama',
            'alamat',
            [
              'attribute'=>'lokasi_kode',
              'label' => 'Lokasi',
              'value' => 'lokasiKode.nama'
            ],
            'latitude',
            'longitude',
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
