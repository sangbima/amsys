<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GudangBangunan */

$this->title = 'Update Gudang Bangunan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gudang Bangunans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gudang-bangunan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
