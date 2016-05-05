<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LapakLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lapak-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_proposal') ?>

    <?= $form->field($model, 'no_antar_lapak') ?>

    <?= $form->field($model, 'no_antar_gudang') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'timbang_kotor_kg') ?>

    <?php // echo $form->field($model, 'timbang_bersih_kg') ?>

    <?php // echo $form->field($model, 'waktu_masuk') ?>

    <?php // echo $form->field($model, 'waktu_keluar') ?>

    <?php // echo $form->field($model, 'jml_karung_masuk') ?>

    <?php // echo $form->field($model, 'jml_karung_keluar') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
