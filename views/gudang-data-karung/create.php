<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GudangDataKarung */

$this->title = 'Create Gudang Data Karung';
$this->params['breadcrumbs'][] = ['label' => 'Gudang Data Karungs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gudang-data-karung-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
