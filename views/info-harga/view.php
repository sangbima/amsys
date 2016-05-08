<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\InfoHarga */

$this->title = $model->komoditasKode->nama;
$this->params['breadcrumbs'][] = ['label' => 'Info Harga', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-harga-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'komoditasKode.nama',
            'tanggal',
            'harga_kg',
            'pasar',
            // 'created',
            // 'updated',
        ],
    ]) ?>

</div>
