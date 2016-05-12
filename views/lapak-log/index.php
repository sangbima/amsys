<?php

use yii\helpers\Html;
use yii\grid\GridView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LapakLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lapak Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lapak-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        if((Mimin::checkRoute($this->context->id.'/create'))) { 
          echo Html::a('Create Lapak Log', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_proposal',
            'no_antar_lapak',
            'no_antar_gudang',
            'status',
            // 'timbang_kotor_kg',
            // 'timbang_bersih_kg',
            // 'waktu_masuk',
            // 'waktu_keluar',
            // 'jml_karung_masuk',
            // 'jml_karung_keluar',
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
