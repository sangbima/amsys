<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AngkutLapak */

$this->title = 'Ubah Angkut Lapak: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Angkut Lapak', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="angkut-lapak-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
