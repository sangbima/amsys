<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'birthday')->widget(DatePicker::classname(),[
      'options' => ['placeholder' => 'Pilih tanggal lahir...'],
      'type' => DatePicker::TYPE_COMPONENT_APPEND,
      'pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd MM yyyy'
      ]
    ]); ?>

    <?= $form->field($model, 'gender')->widget(Select2::classname(), [
        'data' => [ 'laki-laki' => 'Laki-laki', 'perempuan' => 'Perempuan', ],
        'language' => 'en',
        'options' => [
          'placeholder' => 'Jenis Kelamin ...',
          'id' => 'genderId'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'avatar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'filename')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
