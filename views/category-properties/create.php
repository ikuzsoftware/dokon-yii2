<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefCategoryProperties */

$this->title = Yii::t('app', 'Mahsulot hususiyatlari');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ref Category Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-category-properties-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
