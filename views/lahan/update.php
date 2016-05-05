<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lahan */

$this->title = 'Ubah Lahan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="lahan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
