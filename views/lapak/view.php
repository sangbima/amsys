<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Lapak */

$this->title = $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Lapak', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lapak-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-plus"></i> Hapus', ['delete', 'id' => $model->id], [
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
            'kode',
            'penanggung_jawab',
            'alamat',
            'lokasiKode.nama',
            'keterangan:ntext',
        ],
    ]) ?>

</div>
