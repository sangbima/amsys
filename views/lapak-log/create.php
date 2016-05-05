<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LapakLog */

$this->title = 'Create Lapak Log';
$this->params['breadcrumbs'][] = ['label' => 'Lapak Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lapak-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
