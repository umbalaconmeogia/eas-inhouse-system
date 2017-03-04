<?php

namespace app\models;

use Yii;
use batsg\helpers\HDateTime;

/**
 * This is the model class for table "expenses_settlement_month".
 *
 * @property integer $id
 * @property integer $data_status
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property string $month
 * @property integer $user_id
 *
 * @property ExpensesSettlementItem[] $expensesSettlementItems
 * @property LoginUser $user
 *
 * @property string $yearMonth
 */
class ExpensesSettlementMonth extends \batsg\models\BaseBatsgModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expenses_settlement_month';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_status', 'created_by', 'created_at', 'updated_by', 'updated_at', 'user_id'], 'integer'],
            [['month', 'user_id'], 'required'],
            [['month'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => LoginUser::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'month' => '月',
            'user_id' => 'ユーザ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpensesSettlementItems()
    {
        return $this->hasMany(ExpensesSettlementItem::className(), ['expenses_settlement_month_id' => 'id'])->orderBy('expense_date');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(LoginUser::className(), ['id' => 'user_id']);
    }

    /**
     *
     * @return string
     */
    public function getYearMonth()
    {
        return HDateTime::createFromString($this->month)->toString('Y年m月');
    }
}
