<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Armada */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="armada-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_polisi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kapasitas_mesin')->widget(\yii\widgets\MaskedInput::className(),[
      'clientOptions' => [
        'alias' => 'decimal',
      ]
      ]) ?>

    <?= $form->field($model, 'kapasitas_mesin')->widget(\yii\widgets\MaskedInput::className(),[
      'clientOptions' => [
        'alias' => 'decimal',
      ]
      ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> Tambah' : '<i class="fa fa-edit"></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
