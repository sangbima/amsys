<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Komoditas */

$this->title = 'Tambah Varietas';
$this->params['breadcrumbs'][] = ['label' => 'Varietas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="komoditas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
