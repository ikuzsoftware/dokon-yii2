<?php

use app\models\BaseModel;
use app\models\WmsDocuments;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WmsDocumentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Chiqim hujjati');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wms-documents-index">

    <p>
        <?= Html::a(Yii::t('app', 'Yaratish'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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

                    [
                        'attribute' => 'doc_date',
                        'label' => Yii::t('app', 'Sana'),
                        'contentOptions' => ['class' => 'text-info'],
                        'value' => function ($model) {
                            return BaseModel::getDateTime($model->doc_date);
                        },
                    ],
                    [
                        'attribute' => 'doc_number',
                        'label' => Yii::t('app', 'Hujjat raqami'),
                    ],
                    [
                        'attribute' => 'ref_client_id',
                        'label' => Yii::t('app', 'Bo\'limdan'),
                        'contentOptions' => ['class' => 'text-info'],
                        'value' => function ($model) {
                            return $model->hrDepartment->name;
                        },

                    ],
                    [
                        'attribute' => 'hr_department_id',
                        'label' => Yii::t('app', 'Buyurtmachiga'),
                        'contentOptions' => ['class' => 'text-info'],
                        'value' => function ($model) {
                            return $model->refClient->name;
                        },

                    ],
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, WmsDocuments $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        },
                        'visibleButtons' => [
                            'update' => function ($model) {
                                return $model->status < $model::STATUS_SAVED;
                            },
                            'delete' => function ($model) {
                                return $model->status < $model::STATUS_SAVED;
                            }
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>


</div>
