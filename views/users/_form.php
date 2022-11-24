<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <div class="box box-info">
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'hr_employee_id')->textInput() ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'status')->textInput() ?>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <?= Html::a('Cancel', ['/users'], ['class'=>'btn btn-default'])  ?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-info pull-right']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>



</div>
