<?php

use app\models\AuthItem;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $type */
/* @var $model app\models\AuthItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Auth Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="auth-item-view">

    <p>
        <?= Html::a('Update', ['update', 'name' => $model->name, 'type' => $type], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'name' => $model->name, 'type' => $type], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    [
                        'attribute' => 'type',
                        'label' => 'Type',
                        'value' => function ($model) {
                            return AuthItem::getList($model->type);
                        }
                    ],
                    'description:ntext',
//            'rule_name',
                    'data',
//            'created_at',
//            'updated_at',
                ],
            ]) ?>
        </div>

    </div>

</div>
