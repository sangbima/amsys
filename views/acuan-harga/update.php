<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AcuanHarga */

$this->title = 'Acuan Harga: ' . $model->komoditasKode->nama;
$this->params['breadcrumbs'][] = ['label' => 'Acuan Harga', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->komoditasKode->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="acuan-harga-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
