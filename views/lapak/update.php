<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lapak */

$this->title = 'Ubah Lapak: ' . $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Lapak', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lapak-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
