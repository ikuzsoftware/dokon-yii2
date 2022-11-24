<?php

use app\models\HrEmployees;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HrEmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Hr Employees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-employees-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Hr Employees'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if ($dataProvider->count > 0) { ?>
    <div class="box box-primary">
        <?php } else { ?>
        <div class="box">
            <?php } ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'first_name',
            'last_name',
            'father_name',
            //'address',
            //'status',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, HrEmployees $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
        </div>
    </div>


</div>
