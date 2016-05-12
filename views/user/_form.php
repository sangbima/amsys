<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\SwitchInput;

?>
<div class="user-form">
    <?php $form = ActiveForm::begin(['id' => 'form-adduser']); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readonly'=>!$model->isNewRecord, 'placeholder'=>'Username']) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Nama Lengkap']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>

    <?php //echo $form->field($model, 'pass')->passwordInput(['placeholder' => 'Password']) ?>
    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
        'pluginOptions' => [
          'onText' => 'Active',
          'offText' => 'Banned',
        ]
      ])?>
    <?php if(!$model->isNewRecord) { ?>
      <strong> Leave blank if not change password</strong>
      <div class="ui divider"></div>
      <?= $form->field($model, 'new_password') ?>
      <?= $form->field($model, 'repeat_password') ?>
      <?= $form->field($model, 'old_password') ?>
    <?php } ?>
    <?php //echo $form->field($model, 'newPasswordConfirm')->passwordInput(['placeholder' => 'Ulangi Password']) ?>

    <?php //echo $form->field($model, 'status')->widget(Select2::classname(), [
    //     'data' => [ 10 => 'ACTIVE', 0 => 'INACTIVE'],
    //     'hideSearch' => true,
    //     'language' => 'en',
    //     'options' => [
    //       'placeholder' => 'Pilih Status ...',
    //       'id' => 'statususer'
    //     ],
    //     'pluginOptions' => [
    //         'allowClear' => true
    //     ],
    // ]);?>

    <div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> Tambah' : '<i class="fa fa-edit"></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
