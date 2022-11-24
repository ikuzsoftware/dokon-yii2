<?php

use app\models\AuthItem;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">
    <div class="box box-info">
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'item_name')->widget(Select2::classname(), [
                        'data' => AuthItem::getListRule(),
                        'options' => ['placeholder' => 'Roleni tanlang ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
                        'data' => \app\models\Users::getUsers(),
                        'options' => ['placeholder' => 'Foydalanuvchini tanlang ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
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
