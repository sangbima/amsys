<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GudangDataKarungSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gudang Data Karungs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gudang-data-karung-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Gudang Data Karung', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'gudang_masuk_id',
            'gudang_lot_id',
            'bobot_kg',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
