<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Lahan */

$this->title = 'Tambah Lahan';
$this->params['breadcrumbs'][] = ['label' => 'Lahan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
