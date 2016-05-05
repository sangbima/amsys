<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GudangDataKarung */

$this->title = 'Update Gudang Data Karung: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gudang Data Karungs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gudang-data-karung-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
