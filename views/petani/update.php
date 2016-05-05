<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Petani */

$this->title = 'Ubah Petani: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Petanis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="petani-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
