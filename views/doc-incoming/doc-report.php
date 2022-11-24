<?php
?>

<div class="ref-categories-form">
    <div class="box box-info">
        <?php use yii\bootstrap4\ActiveForm;

        $form = ActiveForm::begin(); ?>
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::a('Cancel', ['/categories/index'], ['class'=>'btn btn-default'])  ?>
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>