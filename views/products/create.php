<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefProducts */
/* @var $model_property app\models\RefCategoryRelProperty */

$this->title = Yii::t('app', 'Mahsulot yaratish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ref Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-products-create">

    <?= $this->render('_form', [
        'model' => $model,
        'model_property' => $model_property,
    ]) ?>

</div>
