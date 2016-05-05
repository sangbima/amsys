<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InfoHarga */

$this->title = 'Update Info Harga: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Info Hargas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="info-harga-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
