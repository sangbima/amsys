<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pasar */

$this->title = 'Ubah Pasar: ' . $model->nama_pasar;
$this->params['breadcrumbs'][] = ['label' => 'Pasars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_pasar, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="pasar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
