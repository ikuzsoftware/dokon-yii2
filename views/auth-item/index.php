<?php

use app\models\AuthItem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Auth Items';
$this->params['breadcrumbs'][] = $this->title;
$type = !is_null($searchModel->is_type) ? ($searchModel->is_type === 1) ? 'Rule' : 'Permission' : '';
?>
<div class="auth-item-index shadow-sm p-3 mb-5 bg-white rounded">

    <p>
        <?= Html::a('Create '.$type, ['create', 'type' => $searchModel->is_type], ['class' => 'btn btn-success']) ?>
    </p>

<?php \yii\widgets\Pjax::begin()?>
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
            ['class' => 'yii\grid\SerialColumn'],
            'name',
//            'type',
            'description:ntext',
//            'rule_name',
//            'data',
            //'created_at',
            //'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {view} {delete}',
                'contentOptions' => ['class' => 'no-print', 'style' => 'width:130px;'],
//              'visibleButtons' => [
//                ],
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="fa fa-edit"></span>', ['update', 'name' => $model->name, 'type' => $model->type], [
                            'title' => 'Update',
                            'class' => 'btn btn-xs btn-info',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eye"></span>', ['view', 'name' => $model->name, 'type' => $model->type], [
                            'title' => 'View',
                            'class' => 'btn btn-xs btn-default',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="fa fa-trash"></span>', ['delete', 'name' => $model->name, 'type' => $model->type], [
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
<?php
\yii\widgets\Pjax::end()
?>

</div>
