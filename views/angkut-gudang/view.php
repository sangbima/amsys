<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AngkutGudang */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Angkut Gudang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="angkut-gudang-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-edit></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash"></i> Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no_surat',
            'no_proposal',
            'armada_id',
            'sopir_id',
            'lapak_log_id',
            'gudang_id',
            'waktu_rencana',
            'waktu_realisasi',
            'status',
            'petugas_lapak',
            'bobot_angkut_kg',
            'jml_karung_angkut',
            'petugas_gudang',
            'bobot_serah_kg',
            'jml_karung_serah',
        ],
    ]) ?>

</div>
