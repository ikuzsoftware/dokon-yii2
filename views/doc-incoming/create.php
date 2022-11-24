<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WmsDocuments */

$this->title = Yii::t('app', 'Qabul hujjatini yaratish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wms Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wms-documents-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
