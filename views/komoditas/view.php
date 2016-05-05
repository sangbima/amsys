<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Komoditas */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Varietas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="komoditas-view">

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
            // 'kode',
            'nama',
            // 'created',
            // 'updated',
            // 'user_id',
            // 'level',
            'keterangan:ntext',
            // 'parent',
        ],
    ]) ?>

</div>
