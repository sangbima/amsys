<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InfoHarga */

$this->title = 'Create Info Harga';
$this->params['breadcrumbs'][] = ['label' => 'Info Hargas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-harga-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
