<?php

namespace app\modules\easCrm\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\easCrm\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form about `app\modules\easCrm\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'company_id', 'division_id', 'employee_number', 'first_name', 'middle_name', 'last_name', 'first_name_kana', 'last_name_kana', 'middle_name_kana', 'tel', 'tel_ext', 'fax', 'mobile', 'email', 'job_title', 'zip_code', 'address1', 'address2', 'iso_country_code', 'remarks'], 'safe'],
            [['data_status', 'created_at', 'updated_at', 'gender'], 'integer'],
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
        $query = Employee::find();

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
            'data_status' => $this->data_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'gender' => $this->gender,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'company_id', $this->company_id])
            ->andFilterWhere(['like', 'division_id', $this->division_id])
            ->andFilterWhere(['like', 'employee_number', $this->employee_number])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'first_name_kana', $this->first_name_kana])
            ->andFilterWhere(['like', 'last_name_kana', $this->last_name_kana])
            ->andFilterWhere(['like', 'middle_name_kana', $this->middle_name_kana])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'tel_ext', $this->tel_ext])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'job_title', $this->job_title])
            ->andFilterWhere(['like', 'zip_code', $this->zip_code])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'iso_country_code', $this->iso_country_code])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
