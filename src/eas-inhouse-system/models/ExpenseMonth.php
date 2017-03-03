<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expense_month".
 *
 * @property integer $id
 * @property integer $data_status
 * @property string $created_by
 * @property integer $created_at
 * @property string $updated_by
 * @property integer $updated_at
 * @property string $month
 * @property integer $user_id
 *
 * @property LoginUser $user
 */
class ExpenseMonth extends \batsg\models\BaseBatsgModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expense_month';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_status', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['month', 'user_id'], 'required'],
            [['month'], 'safe'],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
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
    public function getUser()
    {
        return $this->hasOne(LoginUser::className(), ['id' => 'user_id']);
    }
}
