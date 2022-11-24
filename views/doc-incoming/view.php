<?php

use app\models\BaseModel;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WmsDocuments */

$this->title ='Kirim hujjati';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wms Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="box box-info box-solid">

    <div class="box-header">
        <p class="text-right">
            <?php if (!($model->status == BaseModel::STATUS_SAVED)):?>
            <?= Html::a(Yii::t('app', 'Tugatish va saqlash'), ['save-finish', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
            <?php endif;?>
        </p>
    </div>
    <div class="box-body">
        <table class="table table-striped table-bordered">
            <tr>
                <td>Sana: <b><?= date('d.m.Y',$model->doc_date)?></b></td>
                <td>Hujjat nomeri: <b><?= $model->doc_number?></b></td>
            </tr>
            <tr>
                <td>Mijozdan: <b><?= $model->refClient->name ?></b></td>
                <td>Bo'limga: <b><?= $model->hrDepartment->name ?></b></td>
            </tr>
            <tr>
                <td>Masul shaxs: <b>
                        <?php
                        $user = \app\models\Users::find()->where(['id' => $model->created_by])->one();
                        $employee = $user->hrEmployee->first_name . ' ' . $user->hrEmployee->last_name;
                        echo $employee;
                        ?>
                    </b></td>
                <td>______________________</td>
            </tr>
            <tr>
                <td>izoh: <b></b></td>
            </tr>
        </table>

    </div>
</div>
<div class="box box-info box-solid">
    <div class="box-header">
    </div>
    <div class="box-body">
        <table class="table table-striped table-bordered">
                <tr>
                    <th style="width: 12px;">№</th>
                    <th>Mahsulot nomi</th>
                    <th>Miqdori</th>
                    <th>Narxi</th>
                    <th>Jami</th>
                </tr>
                <?php
                $i = 1;
                foreach ($model->wmsDocumentItems as $item) {
                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . $item->refProduct->name . '</td>';
                    echo '<td>' . $item->quantity . ' ' . $item->unitType->name. '</td>';
                    echo '<td>' . $item->price . ' ' . $item->currencyType->name . '</td>';
                    echo '<td>' . $item->price * $item->quantity . ' ' . $item->currencyType->name .'</td>';
                    echo '</tr>';
                    $i++;
                }
                ?>

        </table>
    </div>
</div>
