<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Lapak */

$this->title = 'Tambah Lapak';
$this->params['breadcrumbs'][] = ['label' => 'Lapak', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lapak-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
