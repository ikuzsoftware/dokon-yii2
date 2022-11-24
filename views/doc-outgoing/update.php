<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WmsDocuments */

$this->title = Yii::t('app', 'Chiqim hujjatini o\'zgartirish: {name}', [
    'name' => $model->doc_number,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wms Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="wms-documents-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
