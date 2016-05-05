<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Petani */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Petani', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="petani-view">

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
            'nama',
            'alamat',
            [
              'attribute' => 'lokasi_kode',
              'label' => 'Lokasi',
              'value' => $model->lokasiKode->nama
            ],
            'no_ktp',
            [
              'attribute' => 'status',
              'format' => 'raw',
              'label' => 'Status',
              'value' => $model->status_style($model->status)
            ],
            'keterangan',
            // 'user_id',
            // 'created',
            // 'updated',
        ],
    ]) ?>

</div>
<?php
$js = <<< JS
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
JS;
$this->registerJs($js);
?>
