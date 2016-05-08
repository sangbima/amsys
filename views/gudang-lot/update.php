<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GudangLot */

$this->title = 'Ubah Gudang Lot: ' . $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Gudang Lot', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gudang-lot-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
