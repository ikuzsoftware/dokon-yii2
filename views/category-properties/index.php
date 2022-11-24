<?php

use app\models\BaseModel;
use app\models\RefCategories;
use app\models\RefCategoryProperties;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefCategoryPropertiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Yii::t('app', 'Ref Category Properties');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-category-properties-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Ref Category Properties'), ['create'], ['class' => 'btn btn-success']) ?>
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
                            'attribute' => 'category_id',
                            'label' => Yii::t('app', 'Category name'),
                            'value' => function ($model) {
                                return RefCategories::getListCategory($model->category_id);
                            },
                        ],
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
                            'urlCreator' => function ($action, RefCategoryProperties $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>


    </div>
