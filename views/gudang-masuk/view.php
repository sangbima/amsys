<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GudangMasuk */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gudang Masuks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gudang-masuk-view">

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
            'no_antar_gudang',
            'gudang_id',
            'timbang_masuk_kg',
            'waktu_masuk',
            'petugas_gudang',
            'user_id',
            'created',
            'updated',
        ],
    ]) ?>

</div>
