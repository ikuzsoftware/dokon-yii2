<?php

use app\models\BaseModel;
use app\models\Users;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="users-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'hr_employee_id',
                    'username',
                    'password_hash',
                    [
                        'attribute' => 'status',
                        'label' => Yii::t('app', 'Status'),
                        'contentOptions' => ['class' => 'text-info'],
                        'value' => function ($model) {
                            return BaseModel::getStatusName($model->status);
                        },
                    ],
                    [
                        'attribute' => 'created_at',
                        'label' => 'created_at',
                        'format' => ['date', 'php:d.m.Y'],
                        'value' => function ($model) {
                            $result = Users::find()->select('created_at')->where(['id' => $model->id])->asArray()->one();
                            return !empty($result) ? $result['created_at'] : null;
                        }
                    ],
                    [
                        'attribute' => 'created_by',
                        'label' => 'created_by',
                        'value' => function ($model) {
                            $result = Users::find()->select('username')->where(['id' => $model->created_by])->asArray()->one();
                            return !empty($result) ? $result['username'] : null;
                        }
                    ],
                    [
                        'attribute' => 'updated_at',
                        'label' => 'updated_at',
                        'format' => ['date', 'php:d.m.Y'],
                        'value' => function ($model) {
                            $result = Users::find()->select('updated_at')->where(['id' => $model->id])->asArray()->one();
                            return !empty($result) ? $result['updated_at'] : null;
                        }
                    ],
                    [
                        'attribute' => 'updated_by',
                        'label' => 'updated_by',
                        'value' => function ($model) {
                            $result = Users::find()->select('username')->where(['id' => $model->updated_by])->asArray()->one();
                            return !empty($result) ? $result['username'] : null;
                        }
                    ],
                ],
            ]) ?>

        </div>
    </div>

</div>
