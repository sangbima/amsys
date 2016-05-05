<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProduksiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produksi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'lahan_id') ?>

    <?= $form->field($model, 'komoditas_kode') ?>

    <?= $form->field($model, 'tgl_tanam') ?>

    <?= $form->field($model, 'tgl_panen') ?>

    <?php // echo $form->field($model, 'est_bobot_panen') ?>

    <?php // echo $form->field($model, 'harga_panen') ?>

    <?php // echo $form->field($model, 'bobot_panen_kotor') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
