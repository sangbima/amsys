<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AngkutLapak */

$this->title = 'Update Angkut Lapak: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Angkut Lapaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="angkut-lapak-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
