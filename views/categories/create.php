<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefCategories */

$this->title = Yii::t('app', 'Mahsulot bo\'limini yaratish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ref Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-categories-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
