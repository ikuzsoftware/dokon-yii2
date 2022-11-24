<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WmsItemBalance;
use yii\data\SqlDataProvider;

/**
 * WmsItemBalanceSearch represents the model behind the search form of `app\models\WmsItemBalance`.
 */
class WmsItemBalanceSearch extends WmsItemBalance
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'hr_department_id', 'ref_product_id', 'quantity', 'inventory_balance', 'inventory_date', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = WmsItemBalance::find()
            ->alias('ib')
            ->select([
                'hd.name as department_name',
                'rp.name as product_name',
                'ib.inventory_balance',
//                'u.name as unit_name',
            ])
            ->leftJoin('hr_departments hd', 'hd.id = ib.hr_department_id')
            ->leftJoin('ref_products rp', 'rp.id = ib.ref_product_id')
//            ->leftJoin('ref_unit_type u', 'u.id = ib.ref_unit_type_id')
            ->where(['in', 'ib.id', WmsItemBalance::find()
                ->alias('b')
                ->select('MAX(b.id)')
                ->groupBy('b.hr_department_id, b.ref_product_id')
            ]);

        // add conditions that should always apply here

        $dataProvider = new SqlDataProvider([
            'sql' => $query->createCommand()->getRawSql(),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'hr_department_id' => $this->hr_department_id,
            'ref_product_id' => $this->ref_product_id,
            'quantity' => $this->quantity,
            'inventory_balance' => $this->inventory_balance,
            'inventory_date' => $this->inventory_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
