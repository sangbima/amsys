<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AngkutGudangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Angkut Gudangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="angkut-gudang-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Angkut Gudang', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'lapak_log_id',
            // 'gudang_id',
            // 'waktu_rencana',
            // 'waktu_realisasi',
            // 'status',
            // 'petugas_lapak',
            // 'bobot_angkut_kg',
            // 'jml_karung_angkut',
            // 'petugas_gudang',
            // 'bobot_serah_kg',
            // 'jml_karung_serah',
            // 'user_id',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
