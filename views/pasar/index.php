<?php

use yii\helpers\Html;
use yii\grid\GridView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PasarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pasar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        if ((Mimin::checkRoute($this->context->id.'/create'))){
          echo Html::a('<i class="fa fa-plus"></i> Pasar', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nama_pasar',
            'latitude',
            'longitude',

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => Mimin::filterActionColumn([
                'view', 'update', 'delete'
              ], $this->context->route)
            ],
        ],
    ]); ?>
</div>
