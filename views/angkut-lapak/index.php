<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AngkutLapakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Angkut Lapak';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="angkut-lapak-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        if((Mimin::checkRoute($this->context->id.'/create'))) {
          echo Html::a('<i class="fa fa-plus"></i> Angkut Lapak', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'no_surat',
            'no_proposal',
            'armada_id',
            'sopir_id',
            // 'produksi_id',
            // 'lapak_id',
            'waktu_rencana',
            'waktu_realisasi',
            'status',
            'diterima_oleh',
            'diterima_pada',
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
