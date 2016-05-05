<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LapakLog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lapak Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lapak-log-view">

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
            'no_proposal',
            'no_antar_lapak',
            'no_antar_gudang',
            'status',
            'timbang_kotor_kg',
            'timbang_bersih_kg',
            'waktu_masuk',
            'waktu_keluar',
            'jml_karung_masuk',
            'jml_karung_keluar',
            'user_id',
            'created',
            'updated',
        ],
    ]) ?>

</div>
