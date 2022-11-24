<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WmsDocuments;

/**
 * WmsDocumentsSearch represents the model behind the search form of `app\models\WmsDocuments`.
 */
class WmsDocumentsSearch extends WmsDocuments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'doc_type', 'hr_department_id', 'from_hr_department_id', 'to_hr_department_id', 'ref_client_id', 'from_ref_client_id', 'to_ref_client_id', 'doc_date', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'parent_wms_doc_id'], 'integer'],
            [['doc_number', 'description'], 'safe'],
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
    public function search($params, $type = null)
    {
        $query = WmsDocuments::find()->filterWhere(['doc_type' => $type])->orderBy('doc_date DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'attributes' => [
                    'doc_date' => [
                        'asc' => ['doc_date' => SORT_ASC],
                        'desc' => ['doc_date' => SORT_DESC],
                        'default' => SORT_DESC,
                    ],
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
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
            'doc_type' => $this->doc_type,
            'hr_department_id' => $this->hr_department_id,
            'from_hr_department_id' => $this->from_hr_department_id,
            'to_hr_department_id' => $this->to_hr_department_id,
            'ref_client_id' => $this->ref_client_id,
            'from_ref_client_id' => $this->from_ref_client_id,
            'to_ref_client_id' => $this->to_ref_client_id,
            'doc_date' => $this->doc_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'parent_wms_doc_id' => $this->parent_wms_doc_id,
        ]);

        $query->andFilterWhere(['ilike', 'doc_number', $this->doc_number])
            ->andFilterWhere(['ilike', 'description', $this->description]);

        return $dataProvider;
    }
}
