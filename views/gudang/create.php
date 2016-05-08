<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Gudang */

$this->title = 'Tambah Gudang';
$this->params['breadcrumbs'][] = ['label' => 'Gudang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gudang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
