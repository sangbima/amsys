<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AngkutLapakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Angkut Lapaks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="angkut-lapak-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Angkut Lapak', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_surat',
            'no_proposal',
            'armada_id',
            'sopir_id',
            // 'produksi_id',
            // 'lapak_id',
            // 'waktu_rencana',
            // 'waktu_realisasi',
            // 'status',
            // 'diterima_oleh',
            // 'diterima_pada',
            // 'user_id',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
