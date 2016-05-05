<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Lokasi;
use app\models\Petani;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\Lahan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lahan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'petani_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Petani::find()->all(), 'id', 'nama'),
        'language' => 'en',
        'options' => [
          'placeholder' => 'Pilih Petani ...',
          'id' => 'petaniid'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'provinsi')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Lokasi::find()->where(['level'=>'Provinsi'])->all(), 'kode', 'nama'),
        'language' => 'en',
        'options' => [
          'placeholder' => 'Pilih Provinsi ...',
          'id' => 'provinsikode'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'kotakab')->widget(DepDrop::classname(), [
        'type'=>DepDrop::TYPE_SELECT2,
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'options' =>['id' => 'kotakabkode'],
        'pluginOptions'=>[
            'depends'=>['provinsikode'],
            'placeholder'=>'Pilih Provinsi Kabupaten/kota...',
            'url'=>Url::to(['/lokasi/listkotakab'])
        ]
    ]); ?>

    <?= $form->field($model, 'kec')->widget(DepDrop::classname(), [
        'type'=>DepDrop::TYPE_SELECT2,
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'options' =>['id' => 'keckode'],
        'pluginOptions'=>[
            'depends'=>['provinsikode', 'kotakabkode'],
            'placeholder'=>'Pilih Kecamatan ...',
            'url'=>Url::to(['/lokasi/listkec'])
        ]
    ]); ?>

    <?= $form->field($model, 'keldes')->widget(DepDrop::classname(), [
        'type'=>DepDrop::TYPE_SELECT2,
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'options' =>['id' => 'keldeskode'],
        'pluginOptions'=>[
            'depends'=>['provinsikode', 'kotakabkode', 'keckode'],
            'placeholder'=>'Pilih Kelurahan/Desa ...',
            'url'=>Url::to(['/lokasi/listkeldes'])
        ]
    ]); ?>

    <?php // $form->field($model, 'luas_m2')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'luas_m2')->widget(\yii\widgets\MaskedInput::className(),[
      'clientOptions' => [
        'alias' => 'decimal',
      ]
      ]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->widget(Select2::classname(), [
        'data' => app\models\Lahan::get_status(),
        'language' => 'en',
        'options' => [
          'placeholder' => 'Status ...',
          'id' => 'statusid'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> Tambah' : '<i class="fa fa-edit"></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
