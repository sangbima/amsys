<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GudangDataKarung */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gudang-data-karung-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'gudang_masuk_id')->textInput() ?>

    <?= $form->field($model, 'gudang_lot_id')->textInput() ?>

    <?= $form->field($model, 'bobot_kg')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
