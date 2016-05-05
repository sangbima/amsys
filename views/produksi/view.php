<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Produksi */

$this->title = $model->petani->nama . ' - ' . $model->lahan->luas_m2 .' m2';
$this->params['breadcrumbs'][] = ['label' => 'Produksi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produksi-view">

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
            'no_proposal',
            [
              'attribute' => 'lahan_id',
              'label' => 'Pemilik Lahan',
              'value' => $model->lahan->petani->nama,
            ],
            [
              'attribute' => 'lahan_id',
              'label' => 'Luas (m2)',
              'value' => $model->lahan->luas_m2
            ],
            'komoditasKode.nama',
            'tgl_tanam',
            'tgl_panen',
            'est_bobot_panen',
            'harga_panen',
            [
              'attribute' => 'status',
              'format' => 'raw',
              'label' => 'Status',
              'value' => $model->status_style($model->status)
            ],
            'keterangan',
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