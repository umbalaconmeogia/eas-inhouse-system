<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ExpensesSettlementMonth;

/**
 * ExpensesSettlementMonthSearch represents the model behind the search form about `app\models\ExpensesSettlementMonth`.
 */
class ExpensesSettlementMonthSearch extends ExpensesSettlementMonth
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'data_status', 'created_by', 'created_at', 'updated_by', 'updated_at', 'user_id'], 'integer'],
            [['month'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = ExpensesSettlementMonth::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'data_status' => $this->data_status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'month' => $this->month,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
