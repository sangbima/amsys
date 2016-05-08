<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GudangBangunan */

$this->title = $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Gudang Bangunan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gudang-bangunan-view">

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
            'gudang.nama',
            'kode',
            'kapasitas_m3',
            'latitude',
            'longitude',
            // 'user_id',
            // 'created',
            // 'updated',
        ],
    ]) ?>

</div>
