<?php

/**
 * @var $this yii\web\View
 * @var $dataProvider app\models\WmsItemBalance
 * @var $searchModel yii\widgets\ActiveForm
 */

?>

<div class="box box-success">
    <div class="box-body">
        <?php
        echo \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'value' => function ($data) {
                        return $data['department_name'];
                    },
                    'label' => 'Bo\'lim',
                ],
                [
                    'label' => 'Mahsulot',
                    'value' => function ($data) {
                        return $data['product_name'];
                    },
                ],
                'inventory_balance',
//                [
//                    'value' => function ($data) {
//                        return $data['unit_name'];
//                    },
//                    'label' => 'O\'lchov birligi',
//                ]
            ]
        ])

        ?>
    </div>
</div>
