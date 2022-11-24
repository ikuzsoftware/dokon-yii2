<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefProducts */

$this->title = Yii::t('app', 'Update Ref Products: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ref Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ref-products-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
