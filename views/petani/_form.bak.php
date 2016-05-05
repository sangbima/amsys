<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Lokasi;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Petani */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="petani-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'no_ktp')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'provinsi')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Lokasi::find()->where(['level'=>'Provinsi'])->all(), 'kode', 'nama'),
        'language' => 'en',
        'options' => [
          'placeholder' => 'Pilih Provinsi ...',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
        'pluginEvents' => [
          'change' => 'function(){
            $.post("index.php?r=lokasi/listkotakab&kodeprov='.'"+$(this).val(), function(data){
              $("select#petani-kotakab").html(data);
            });
          }'
        ]
    ]);?>
    <?= $form->field($model, 'kotakab')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Lokasi::find()->where(['level'=>'KabKota'])->all(), 'kode', 'nama'),
        'language' => 'en',
        'options' => [
          'placeholder' => 'Pilih Kabupaten/Kota ...',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
        'pluginEvents' => [
          'change' => 'function(){
            $.post("index.php?r=lokasi/listkec&kodekotakab='.'"+$(this).val(), function(data){
              $("select#petani-kec").html(data);
            });
          }'
        ]
    ]);?>
    <?= $form->field($model, 'kec')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Lokasi::find()->where(['level'=>'Kecamatan'])->all(), 'kode', 'nama'),
        'language' => 'en',
        'options' => [
          'placeholder' => 'Pilih Kecamatan ...',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
        'pluginEvents' => [
          'change' => 'function(){
            $.post("index.php?r=lokasi/listkeldes&kodekec='.'"+$(this).val(), function(data){
              $("select#petani-keldes").html(data);
            });
          }'
        ]
    ]);?>
    <?= $form->field($model, 'keldes')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Lokasi::find()->where(['level'=>'DesaKelurahan'])->all(), 'kode', 'nama'),
        'language' => 'en',
        'options' => [
          'placeholder' => 'Pilih Desa/Kelurahan ...',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
