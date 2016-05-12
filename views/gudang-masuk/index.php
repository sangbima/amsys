<?php

use yii\helpers\Html;
use yii\grid\GridView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GudangMasukSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gudang Masuks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gudang-masuk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        if((Mimin::checkRoute($this->context->id.'/create'))) {
          echo Html::a('Create Gudang Masuk', ['create'], ['class' => 'btn btn-success']); 
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
            'no_antar_gudang',
            'gudang_id',
            'timbang_masuk_kg',
            // 'waktu_masuk',
            // 'petugas_gudang',
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
