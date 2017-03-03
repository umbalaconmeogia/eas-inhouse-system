<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ExpenseMonth;

/**
 * ExpenseMonthSearch represents the model behind the search form about `app\models\ExpenseMonth`.
 */
class ExpenseMonthSearch extends ExpenseMonth
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'data_status', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['created_by', 'updated_by', 'month'], 'safe'],
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
        $query = ExpenseMonth::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'month' => $this->month,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
