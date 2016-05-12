<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pasar */

$this->title = 'Tambah Pasar';
$this->params['breadcrumbs'][] = ['label' => 'Pasar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
