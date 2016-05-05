<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Selamat Datang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="wrapperku">

	<!--SLIDE-IN ICONS-->
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
    <!--END SLIDE-IN ICONS-->

<!--LOGIN FORM-->
<?php $form = ActiveForm::begin(['id' => 'login-form', 'options'=>['class'=>'login-formasik']]); ?>

	<!--HEADER-->
    <div class="header">
    <!--TITLE--><h1>AM<span class="utama">SYS</span><span style="font-size: 15px; margin-left: 10px;">Login</span></h1><!--END TITLE-->
    <!--DESCRIPTION--><span>Silakan login dengan username dan password Anda</span><!--END DESCRIPTION-->
    </div>
    <!--END HEADER-->
	
	<!--CONTENT-->
    <div class="content">
    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username']) ?>
    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>
	
    </div>
    <!--END CONTENT-->
    
    <!--FOOTER-->
    <div class="footer">
    <?= Html::submitButton('Login', ['class' => 'button', 'name' => 'login-button']) ?>
    
    <?= $form->field($model, 'rememberMe', ['options' => [
            'tag' => 'div',
            'class' => 'checkbox'
          ],
          'template' => '<label>{input} {label} {error}</label>'
        ])->checkbox() ?>
    </div>
    <!--END FOOTER-->

<?php ActiveForm::end(); ?>
<!--END LOGIN FORM-->
		<p class="foot">copyright @2016 teambawangmerah</p>
</div>