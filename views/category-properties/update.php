<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefCategoryProperties */

$this->title = Yii::t('app', 'Update Ref Category Properties: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ref Category Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ref-category-properties-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
