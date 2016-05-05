<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;
use app\models\Komoditas;

/* @var $this yii\web\View */
/* @var $model app\models\Produksi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produksi-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="form-group bgform">
      <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'lahan_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($model->lahanPetani, 'id', 'nama'),
                'language' => 'en',
                'options' => [
                  'placeholder' => 'Pilih Petani ...',
                  'id' => 'lahanId'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);?>
        </div>
        <div class="col-md-6">
          <?= $form->field($model, 'komoditas_kode')->widget(Select2::classname(), [
              'data' => ArrayHelper::map(Komoditas::find()->where(['level'=>'Variatas'])->all(), 'kode', 'nama'),
              'language' => 'en',
              'options' => [
                'placeholder' => 'Pilih Varietas ...',
                'id' => 'varietaskode'
              ],
              'pluginOptions' => [
                  'allowClear' => true
              ],
          ]);?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <?= $form->field($model, 'tgl_tanam')->widget(DatePicker::classname(),[
            'options' => ['placeholder' => 'Pilih tanggal tanam...'],
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
              'autoclose' => true,
              'format' => 'dd MM yyyy'
            ]
          ]); ?>
        </div>

        <div class="col-md-6">
    
          <?= $form->field($model, 'tgl_panen')->widget(DatePicker::classname(),[
            'options' => ['placeholder' => 'Pilih tanggal panen...'],
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
              'autoclose' => true,
              'format' => 'dd MM yyyy'
            ]
          ]); ?>
          

        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <?php //$form->field($model, 'est_bobot_panen')->textInput(['maxlength' => true]) ?>
          <?= $form->field($model, 'est_bobot_panen')->widget(\yii\widgets\MaskedInput::className(),[
            'clientOptions' => [
              'alias' => 'decimal',
            ]
            ]) ?>
        </div>
        <div class="col-md-4">
          <?php //$form->field($model, 'harga_panen')->textInput(['maxlength' => true]) ?>
          <?= $form->field($model, 'harga_panen')->widget(\yii\widgets\MaskedInput::className(),[
            'clientOptions' => [
              'alias' => 'decimal',
            ]
            ]) ?>
        </div>
        <div class="col-md-4">
          <?= $form->field($model, 'status')->widget(Select2::classname(), [
              'data' => app\models\Produksi::get_status(),
              'language' => 'en',
              'options' => [
                'placeholder' => 'Status ...',
                'id' => 'statusid'
              ],
              'pluginOptions' => [
                  'allowClear' => true
              ],
          ]);?>
        </div>
    </div>
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    
    <?php //echo $form->field($model, 'bobot_panen_kotor')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> Tambah' : '<i class="fa fa-edit"></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
    

    <?php ActiveForm::end(); ?>

</div>
