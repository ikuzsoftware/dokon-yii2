<?php

use app\models\BaseModel;
use app\models\Users;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index shadow-sm p-3 mb-5 bg-white rounded" style="zoom: 0.9;">
    <p>
        <?= Html::a(Yii::t('app', 'Create Users'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?php if ($dataProvider->count > 0) { ?>
    <div class="box box-primary">
        <?php } else { ?>
        <div class="box">
            <?php }?>
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn'
                    ],

                    [
                        'attribute' => 'hr_employee_id',
                        'label' => Yii::t('app', 'Hodim'),
                        'value' => function ($model) {
                            return $model->hrEmployee->first_name . ' ' . $model->hrEmployee->last_name;
                        },
                    ],
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
        ////            [
        ////                'attribute' => 'created_at',
        ////                'label' => 'created_at',
        ////                'value' => function($model) {
        ////                    return Users::find()->select('username')->where(['id' => $model->created_at])->one();
        ////                }
        ////            ],
        //            [
        //                'attribute' => 'created_by',
        //                'label' => 'created_by',
        //                'value' => function($model) {
        //                    $result = Users::find()->select('username')->where(['id' => $model->created_by])->asArray()->one();
        //                    return !empty($result) ? $result['username'] : null;
        //                }
        //            ],
        //            'updated_at',
        //            [
        //                'attribute' => 'updated_by',
        //                'label' => 'updated_by',
        //                'value' => function($model) {
        //                    $result = Users::find()->select('username')->where(['id' => $model->updated_by])->asArray()->one();
        //                    return !empty($result) ? $result['username'] : null;
        //                }
        //            ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update} {view} {delete}',
                        'contentOptions' => ['class' => 'no-print', 'style' => 'width:130px;'],
        //              'visibleButtons' => [
        //                ],
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return Html::a('<span class="fa fa-edit"></span>', ['update', 'id' => $model->id], [
                                    'title' => 'Update',
                                    'class' => 'btn btn-xs btn-info',
                                ]);
                            },
                            'view' => function ($url, $model) {
                                return Html::a('<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                    'title' => 'View',
                                    'class' => 'btn btn-xs btn-default',
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                    'title' => 'Delete',
                                    'class' => 'btn btn-xs btn-danger',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                        'method' => 'post',
                                    ],
                                ]);
                            },

                        ]
                    ]
                ],
            ]); ?>
        </div>
    </div>

    <?php Pjax::end(); ?>

</div>
