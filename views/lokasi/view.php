<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Lokasi */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Lokasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lokasi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> Ubah', ['update', 'id' => $model->kode], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash"></i> Hapus', ['delete', 'id' => $model->kode], [
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
            'nama',
            'level',
            [
              'attribute'=>'parent',
              'label' => 'Parent',
              'value' => $model->parentNama ? $model->parentNama : ' - ',
            ],
            'latitude',
            'longitude',
            // 'user_id',
            // 'created',
            // 'updated',
        ],
    ]) ?>

</div>
