<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expense_item".
 *
 * @property integer $id
 * @property integer $data_status
 * @property string $created_by
 * @property integer $created_at
 * @property string $updated_by
 * @property integer $updated_at
 * @property integer $expense_month_id
 * @property string $date
 * @property integer $amount
 * @property string $store
 * @property string $content
 * @property string $remarks
 *
 * @property ExpenseMonth $expenseMonth
 */
class ExpenseItem extends \batsg\models\BaseBatsgModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expense_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_status', 'created_at', 'updated_at', 'expense_month_id', 'amount'], 'integer'],
            [['expense_month_id', 'date', 'amount', 'store', 'content', 'remarks'], 'required'],
            [['date'], 'safe'],
            [['created_by', 'updated_by', 'store', 'content', 'remarks'], 'string', 'max' => 255],
            [['expense_month_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExpenseMonth::className(), 'targetAttribute' => ['expense_month_id' => 'id']],
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
            'expense_month_id' => '経費申請月',
            'date' => '日付',
            'amount' => '金額',
            'store' => '店舗',
            'content' => '内容',
            'remarks' => '備考',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenseMonth()
    {
        return $this->hasOne(ExpenseMonth::className(), ['id' => 'expense_month_id']);
    }
}
