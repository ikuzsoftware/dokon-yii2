<?php

use app\models\RefCategories;
use kartik\select2\Select2;
use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RefCategoryProperties */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-category-properties-form">

    <div class="box box-info">
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->field($model, 'category_id')->widget(Select2::classname(), [
                        'data' => RefCategories::getListCategory(),
                        'options' => ['placeholder' => 'Kategoriyani tanlang...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                        'theme' => Select2::THEME_DEFAULT,
                    ]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->field($model, 'name')->widget(MultipleInput::className(), [
                        'max' => 30,
                        'min' => 0,
                        'cloneButton' => true,
                        'options' => [
//                    'class' => 'form-inline',
//                    'id' => 'permissions',
                            'label' => 'Properties',
                        ],
                        'iconSource' => MultipleInput::ICONS_SOURCE_FONTAWESOME,
                        'columns' => [
                            [
                                'name' => 'name',
                                'title' => 'Properties',
                                'defaultValue' => "",
                            ],
                        ]
                    ])->label(false); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::a('Cancel', ['/category-properties/index'], ['class'=>'btn btn-default'])  ?>
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
