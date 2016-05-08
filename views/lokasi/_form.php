<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Lokasi;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Lokasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lokasi-form">
    <div class="form-group bgform">
      <div class="row">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'level')->widget(Select2::classname(), [
                'data' => ['Provinsi' => 'Provinsi',
                'KabKota' => 'Kabupaten/Kota',
                'Kecamatan' => 'Kecamatan',
                'DesaKelurahan' => 'Desa/Kelurahan',],
                'language' => 'en',
                'options' => [
                  'placeholder' => 'Pilih Level ...',
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);?>
        </div>
        <div class="col-md-6">
            <?php
            // echo Html::hiddenInput('initial-parent', $model->parent, ['id' => 'initial-parent']);
            // echo $form->field($model, 'parent')->widget(DepDrop::classname(), [
            //     'type'=>DepDrop::TYPE_SELECT2,
            //     // 'data' => $model->parent,
            //     'select2Options'=>[
            //       'pluginOptions'=>['allowClear'=>true],
            //       'pluginEvents' => [
            //         'change' => 'function() {
            //           $("#lokasi-kode").val($(this).find("option:selected").attr("value"));
            //         }',
            //         "init"=>"function() { log('depdrop.init'); }",
            //       ]
            //     ],
            //     'options' =>['id' => 'parent'],
            //     'pluginOptions'=>[
            //         'depends'=>[
            //           Html::getInputId($model, 'level'),
            //         ],
            //         'placeholder'=>'Pilih Parent...',
            //         'url'=>Url::to(['/lokasi/list-parent']),
            //         'initialize'=>true,
            //         'params' => ['initial-parent']
            //     ]
            // ]);

            // if($model->isNewRecord){
            //   echo $form->field($model, 'parent')->widget(DepDrop::classname(), [
            //       'type'=>DepDrop::TYPE_SELECT2,
            //       'select2Options'=>[
            //         'pluginOptions'=>['allowClear'=>true],
            //         'pluginEvents' => [
            //           'change' => 'function() {
            //             $("#lokasi-kode").val($(this).find("option:selected").attr("value"));
            //           }'
            //         ]
            //       ],
            //       'options' =>['id' => 'parent'],
            //       'pluginOptions'=>[
            //           'depends'=>['level'],
            //           'placeholder'=>'Pilih Parent...',
            //           'url'=>Url::to(['/lokasi/list-parent'])
            //       ]
            //   ]);
            // } else {
            //   echo $form->field($model, 'parent')->widget(Select2::classname(), [
            //       'data' => ArrayHelper::map(Lokasi::find()->all(), 'kode', 'nama'),
            //       'language' => 'en',
            //       'options' => [
            //         'placeholder' => 'Pilih Parent ...',
            //         'id' => 'parent'
            //       ],
            //       'pluginOptions' => [
            //           'allowClear' => true
            //       ],
            //       'pluginEvents' => [
            //         'change' => 'function() {
            //           $("#lokasi-kode").val($(this).find("option:selected").attr("value"));
            //         }'
            //       ]
            //   ]);
            // }

            $lokasiDesc = empty($model->parent) ? '' : Lokasi::findOne($model->parent)->nama;

            echo $form->field($model, 'parent')->widget(Select2::classname(), [
              'initValueText' => $lokasiDesc, // set the initial display text
              'options' => ['placeholder' => 'Cari Parent ...'],
              'pluginEvents' => [
                'change' => 'function() {
                  $("#lokasi-kode").val($(this).find("option:selected").attr("value"));
                }'
              ],
              'pluginOptions' => [
                  'allowClear' => true,
                  'minimumInputLength' => 3,
                  'language' => [
                      'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                  ],
                  'ajax' => [
                      'url' => \yii\helpers\Url::to(['location-list']),
                      'dataType' => 'json',
                      'data' => new JsExpression('function(params) { return {q:params.term}; }')
                  ],
                  'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                  'templateResult' => new JsExpression('function(lokasi) { return lokasi.text; }'),
                  'templateSelection' => new JsExpression('function (lokasi) { return lokasi.text; }'),
              ],
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
                <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-8">
                <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'latitude')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'longitude')->textInput() ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> Tambah' : '<i class="fa fa-edit"></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
