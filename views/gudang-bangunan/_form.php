<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Gudang;
use kartik\select2\Select2;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\GudangBangunan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gudang-bangunan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $proposalDesc = empty($model->gudang_id) ? '' : Gudang::findOne($model->gudang_id)->nama;

    echo $form->field($model, 'gudang_id')->widget(Select2::classname(), [
      'initValueText' => $proposalDesc, // set the initial display text
      'options' => ['placeholder' => 'Cari Gudang ...'],
      'pluginOptions' => [
          'allowClear' => true,
          'minimumInputLength' => 3,
          'language' => [
              'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
          ],
          'ajax' => [
              'url' => \yii\helpers\Url::to(['/gudang/gudang-list']),
              'dataType' => 'json',
              'data' => new JsExpression('function(params) { return {q:params.term}; }')
          ],
          'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
          'templateResult' => new JsExpression('function(gudang) { return gudang.text; }'),
          'templateSelection' => new JsExpression('function (gudang) { return gudang.text; }'),
      ],
    ]);
    ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kapasitas_m3')->widget(\yii\widgets\MaskedInput::className(),[
      'clientOptions' => [
        'alias' => 'decimal',
      ]
      ]) ?>

    <?= $form->field($model, 'latitude')->widget(\yii\widgets\MaskedInput::className(),[
      'clientOptions' => [
        'alias' => 'decimal',
      ]
      ]) ?>

    <?= $form->field($model, 'longitude')->widget(\yii\widgets\MaskedInput::className(),[
      'clientOptions' => [
        'alias' => 'decimal',
      ]
      ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> Tambah' : '<i class="fa fa-edit"></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
