<?php

use app\models\AuthItem;
use kartik\select2\Select2;
use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-form">
    <div class="box box-info">
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
        <div class="box-body">
            <?php if ($model->type == AuthItem::AUTH_ITEM_RULE): ?>
                <div class="row">
                    <div class="col-md-8">
                        <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-8">
                        <?php echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($model->type == AuthItem::AUTH_ITEM_PERMISSION): ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $form->field($model, 'category')->widget(Select2::classname(), [
                            'data' => AuthItem::getListRule(),
                            'options' => ['placeholder' => 'Select a state ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $form->field($model, 'new_permissions')->widget(MultipleInput::className(), [
                            'max' => 30,
                            'min' => 0,
                            'cloneButton' => true,
                            'options' => [
//                    'class' => 'form-inline',
//                    'id' => 'permissions',
                                'label' => 'Permissions',
                            ],
                            'iconSource' => MultipleInput::ICONS_SOURCE_FONTAWESOME,
                            'columns' => [
                                [
                                    'name' => 'name',
                                    'title' => 'Action name',
                                    'defaultValue' => "",
                                ],
                                [
                                    'name' => 'description',
                                    'title' => 'Description',
                                ]
                            ]
                        ])->label(false); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="box-footer">
            <?php if ($model->type == AuthItem::AUTH_ITEM_RULE): ?>
                <?= Html::a('Cancel', ['/auth-item/rule'], ['class'=>'btn btn-default'])  ?>
            <?php endif; ?>

            <?php if ($model->type == AuthItem::AUTH_ITEM_PERMISSION): ?>
                <?= Html::a('Cancel', ['/auth-item/permission'], ['class'=>'btn btn-default'])  ?>
            <?php endif; ?>

            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-info pull-right']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
