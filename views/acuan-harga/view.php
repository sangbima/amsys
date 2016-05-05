<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AcuanHarga */

$this->title = $model->komoditasKode->nama;
$this->params['breadcrumbs'][] = ['label' => 'Acuan Harga', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acuan-harga-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?php //echo Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php //echo Html::a('Hapus', ['delete', 'id' => $model->id], [
        //     'class' => 'btn btn-danger',
        //     'data' => [
        //         'confirm' => 'Are you sure you want to delete this item?',
        //         'method' => 'post',
        //     ],
        // ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'komoditas_kode',
            'komoditasKode.nama',
            'harga',
            'created',
            'updated',
        ],
    ]) ?>

</div>
