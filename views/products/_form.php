<?php

use app\models\RefCategories;
use app\models\RefCategoryProperties;
use kartik\select2\Select2;
use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\RefProducts */
/* @var $model_property app\models\RefCategoryRelProperty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-products-form">
    <div class="box box-info">
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->field($model, 'ref_category_id')->widget(Select2::classname(), [
                        'data' => RefCategories::getListCategory(),
                        'options' => ['placeholder' => 'Kategoriyani tanlang...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'barcode')->textInput() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?php echo $form->field($model, 'property')->widget(MultipleInput::className(), [
                        'max' => 30,
                        'min' => 0,
                        'cloneButton' => true,
                        'options' => [
//                    'class' => 'form-inline',
//                    'id' => 'permissions',
                            'label' => 'Property',
                        ],
                        'iconSource' => MultipleInput::ICONS_SOURCE_FONTAWESOME,
                        'columns' => [
                            [
                                'name'  => 'id',
                                'type'  => 'dropDownList',
                                'title' => 'Product property',
                                'defaultValue' => " ",
                                'items' => RefCategoryProperties::getPropertyList(3),
                            ],
                            [
                                'name' => 'value',
                                'title' => 'Value',
                                'options' => [
                                    'placeholder' => 'Value',
                                ],
                            ]
                        ]
                    ])->label(false); ?>
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
<script>
    $(document).ready(function () {
    });
</script>

