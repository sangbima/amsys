<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AngkutGudang */

$this->title = 'Ubah Angkut Gudang: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Angkut Gudang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="angkut-gudang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
