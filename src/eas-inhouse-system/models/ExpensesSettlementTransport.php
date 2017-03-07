<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expenses_settlement_transport".
 *
 * @property integer $id
 * @property integer $data_status
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $expenses_settlement_month_id
 * @property string $expense_date
 * @property integer $amount
 * @property string $transportation
 * @property string $section_from
 * @property string $section_to
 * @property integer $type
 * @property string $remarks
 *
 * @property ExpensesSettlementMonth $expensesSettlementMonth
 */
class ExpensesSettlementTransport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expenses_settlement_transport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_status', 'created_by', 'created_at', 'updated_by', 'updated_at', 'expenses_settlement_month_id', 'amount', 'type'], 'integer'],
            [['expenses_settlement_month_id', 'expense_date', 'amount', 'transportation', 'section_from', 'section_to'], 'required'],
            [['expense_date'], 'safe'],
            [['transportation', 'section_from', 'section_to', 'remarks'], 'string', 'max' => 255],
            [['expenses_settlement_month_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExpensesSettlementMonth::className(), 'targetAttribute' => ['expenses_settlement_month_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data_status' => 'Data Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'expenses_settlement_month_id' => 'Expenses Settlement Month ID',
            'expense_date' => '日付',
            'amount' => '金額',
            'transportation' => '交通',
            'section_from' => '出発',
            'section_to' => '到着',
            'type' => '片/往	',
            'remarks' => '備考',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpensesSettlementMonth()
    {
        return $this->hasOne(ExpensesSettlementMonth::className(), ['id' => 'expenses_settlement_month_id']);
    }
}
