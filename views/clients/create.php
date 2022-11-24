<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefClients */

$this->title = Yii::t('app', 'Mijozni yaratish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ref Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-clients-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
