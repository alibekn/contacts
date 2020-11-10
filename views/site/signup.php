<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */

use app\models\User;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Форма регистрации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <h1><?= Html::encode($this->title) ?></h1>

            <p><?= 'Пожалуйста, заполните поля, представленные ниже' ?></p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-offset-3 col-md-6">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'dob')->widget(
                DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                'language' => 'ru',
                // modify template for custom rendering
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'startView' => 3,
                ]
            ]);?>

            <?= $form->field($model, 'gender')->dropDownList(User::getGenders(), ['prompt' => 'Не выбран']) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group text-center">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
