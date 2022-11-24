<?php

use app\models\BaseModel;
use app\models\RefCategories;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefCategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mahsulot bo\'limi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-categories-index">

    <p>
        <?= Html::a(Yii::t('app', 'Mahsulot bo\'limini yaratish'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if ($dataProvider->count > 0) { ?>
    <div class="box box-primary">
        <?php } else { ?>
        <div class="box">
            <?php } ?>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'name',
                        [
                            'attribute' => 'status',
                            'label' => Yii::t('app', 'Status'),
                            'contentOptions' => ['class' => 'text-info'],
                            'value' => function ($model) {
                                return BaseModel::getStatusName($model->status);
                            },
                        ],
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, RefCategories $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>


    </div>
