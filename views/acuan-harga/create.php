<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AcuanHarga */

$this->title = 'Tambah Acuan Harga';
$this->params['breadcrumbs'][] = ['label' => 'Acuan Harga', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acuan-harga-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
