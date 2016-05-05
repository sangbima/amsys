<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AngkutGudang */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Angkut Gudangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="angkut-gudang-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
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
            'user_id',
            'created',
            'updated',
        ],
    ]) ?>

</div>
