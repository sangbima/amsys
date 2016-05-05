<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
        <?= Html::a('Create Gudang Masuk', ['create'], ['class' => 'btn btn-success']) ?>
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
