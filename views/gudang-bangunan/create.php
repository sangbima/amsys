<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GudangBangunan */

$this->title = 'Create Gudang Bangunan';
$this->params['breadcrumbs'][] = ['label' => 'Gudang Bangunans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gudang-bangunan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
