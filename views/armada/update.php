<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Armada */

$this->title = 'Ubah Armada: ' . $model->no_polisi;
$this->params['breadcrumbs'][] = ['label' => 'Armada', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_polisi, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="armada-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
