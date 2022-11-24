<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RefClients */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-clients-form">

    <div class="box box-info">
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <?= Html::a('Cancel', ['/products'], ['class'=>'btn btn-default'])  ?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-info ']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
