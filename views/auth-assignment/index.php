<?php

use app\models\AuthAssignment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthAssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Auth Assignments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-index">

    <p>
        <?= Html::a('Create Auth Assignment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
                    'item_name',
                    'user_id',
                    'created_at',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, AuthAssignment $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>


</div>
