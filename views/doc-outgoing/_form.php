<?php

use app\models\HrDepartments;
use app\models\RefCategoryProperties;
use app\models\RefClients;
use app\models\RefCurrencyType;
use app\models\RefProducts;
use app\models\RefUnitType;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WmsDocuments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wms-documents-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-success">
        <div class="box-header with-border bg-success">
        </div>
        <div class="box-body">
           <div class="row">
               <div class="col-md-4">
                   <?= $form->field($model, 'doc_date')->widget(DatePicker::classname(), [
                       'options' => ['placeholder' => 'Hujjat sanasi ...'],
//                       'value' => date('Y-m-d'),
                       'pluginOptions' => [
                           'autoclose' => true,
                           'format' => 'dd.mm.yyyy'
                       ]
                   ])->label("Hujjat sanasi");?>
               </div>
               <div class="col-md-4">
                   <?= $form->field($model, 'from_hr_department_id')->widget(Select2::classname(), [
                       'data' => HrDepartments::getDepartment(),
                       'options' => ['placeholder' => 'Bo\'limni tanlang...'],
                       'pluginOptions' => [
                           'allowClear' => true
                       ],
                   ])->label("Qaysi bo'limdan"); ?>
               </div>
               <div class="col-md-4">
                   <?= $form->field($model, 'to_ref_client_id')->widget(Select2::classname(), [
                       'data' => RefClients::getClient(),
                       'options' => ['placeholder' => 'Buyurtmachini tanlang...'],
                       'pluginOptions' => [
                           'allowClear' => true
                       ],
                   ])->label("Qaysi buyurtmachiga"); ?>
               </div>
           </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-info">
        <div class="box-header with-border bg-info">
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">

                    <?php echo $form->field($model, 'docItems')->widget(MultipleInput::className(), [
                        'max' => 30,
                        'min' => 1,
                        'cloneButton' => true,
                        'options' => [
                            'label' => 'Products',
                        ],
                        'iconSource' => MultipleInput::ICONS_SOURCE_FONTAWESOME,
                        'columns' => [
                            [
                                'name' => 'id',
                                'type' => 'hiddenInput'
                            ],
                            [
                                'name'  => 'ref_product_id',
                                'type'  => Select2::class,
                                'title' => 'Mahsulot',

                                'options' => [
                                    'data' => RefProducts::getProduct(),
                                    'options' => [
                                        'placeholder' => Yii::t('app', 'Mahsulotni tanlang...'),
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ]
                                ]
                            ],
                            [
                                'name' => 'quantity',
                                'title' => 'Miqdori',
                                'defaultValue' => "",
                                'options' => [
                                    'required' => true,
                                    'placeholder' => Yii::t('app', 'Miqdorini kiriting...'),
                                ],
                            ],
                            [
                                'name' => 'unit_type_id',
                                'type'  => Select2::class,
                                'title' => 'O\'lchov birligi',
                                'defaultValue' => "",
                                'options' => [
                                    'data' => RefUnitType::getUnitTypeList(),
                                    'options' => [
                                        'placeholder' => Yii::t('app', 'O\'lchov birligini tanlang...'),
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ]
                                ]
                            ],
                            [
                                'name' => 'price',
                                'title' => 'Narxi',
                                'defaultValue' => "",
                                'options' => [
                                    'required' => true,
                                    'placeholder' => Yii::t('app', 'Narxini kiriting...'),
                                ],
                            ],
                            [
                                'name' => 'currency_type_id',
                                'type'  => Select2::class,
                                'title' => 'Pul birligi',
                                'defaultValue' => "",
                                'options' => [
                                    'data' => RefCurrencyType::getCurrencyTypeList(),
                                    'options' => [
//                                        'placeholder' => Yii::t('app', 'Pul birligini tanlang...'),
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ]
                                ]
                            ],
                        ]
                    ])->label(false); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?= Html::a('Bekor qilish', ['/products'], ['class'=>'btn btn-default'])  ?>
        <?= Html::submitButton(Yii::t('app', 'Saqlash'), ['class' => 'btn btn-info ']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
