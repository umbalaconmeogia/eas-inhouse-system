<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expenses_settlement_item".
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
 * @property string $payee
 * @property string $payment_content
 * @property string $remarks
 *
 * @property ExpensesSettlementMonth $expensesSettlementMonth
 */
class ExpensesSettlementItem extends \batsg\models\BaseBatsgModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expenses_settlement_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_status', 'created_by', 'created_at', 'updated_by', 'updated_at', 'expenses_settlement_month_id', 'amount'], 'integer'],
            [['expenses_settlement_month_id', 'expense_date', 'amount', 'payee', 'payment_content', 'remarks'], 'required'],
            [['expense_date'], 'safe'],
            [['payee', 'payment_content', 'remarks'], 'string', 'max' => 255],
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
            'expenses_settlement_month_id' => '経費申請月',
            'expense_date' => '日付',
            'amount' => '金額',
            'payee' => '支払先',
            'payment_content' => '支払内容',
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
