<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AngkutLapak */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Angkut Lapak', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="angkut-lapak-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-edit></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash></i> Delete', ['delete', 'id' => $model->id], [
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
        ],
    ]) ?>

</div>
