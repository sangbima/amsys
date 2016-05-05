<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GudangMasuk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gudang-masuk-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_proposal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_antar_gudang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gudang_id')->textInput() ?>

    <?= $form->field($model, 'timbang_masuk_kg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'waktu_masuk')->textInput() ?>

    <?= $form->field($model, 'petugas_gudang')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
