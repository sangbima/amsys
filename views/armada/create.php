<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Armada */

$this->title = 'Tambah Armada';
$this->params['breadcrumbs'][] = ['label' => 'Armada', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armada-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
