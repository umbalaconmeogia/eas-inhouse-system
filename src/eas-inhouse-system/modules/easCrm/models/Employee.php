<?php

namespace app\modules\easCrm\models;

use Yii;

/**
 * This is the model class for table "eas_crm_employee".
 *
 * @property string $id
 * @property integer $data_status
 * @property string $created_by
 * @property integer $created_at
 * @property string $updated_by
 * @property integer $updated_at
 * @property string $company_id
 * @property string $division_id
 * @property string $employee_number
 * @property string $name
 * @property string $name_kana
 * @property integer $gender
 * @property string $tel
 * @property string $tel_ext
 * @property string $fax
 * @property string $mobile
 * @property string $email
 * @property string $title
 * @property string $remarks
 *
 * @property Company $company
 * @property Division $division
 */
class Employee extends \batsg\models\BaseBatsgModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eas_crm_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'name'], 'required'],
            [['id', 'created_by', 'updated_by', 'company_id', 'division_id', 'employee_number', 'name', 'name_kana', 'tel', 'tel_ext', 'fax', 'mobile', 'email', 'title', 'remarks'], 'string'],
            [['data_status', 'created_at', 'updated_at', 'gender'], 'integer'],
            [['employee_number'], 'unique'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['division_id'], 'exist', 'skipOnError' => true, 'targetClass' => Division::className(), 'targetAttribute' => ['division_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'data_status' => Yii::t('app', 'Data Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'company_id' => Yii::t('app', 'Company ID'),
            'division_id' => Yii::t('app', 'Division ID'),
            'employee_number' => Yii::t('app', 'Employee Number'),
            'name' => Yii::t('app', 'Name'),
            'name_kana' => Yii::t('app', 'Name Kana'),
            'gender' => Yii::t('app', 'Gender'),
            'tel' => Yii::t('app', 'Tel'),
            'tel_ext' => Yii::t('app', 'Tel Ext'),
            'fax' => Yii::t('app', 'Fax'),
            'mobile' => Yii::t('app', 'Mobile'),
            'email' => Yii::t('app', 'Email'),
            'title' => Yii::t('app', 'Title'),
            'remarks' => Yii::t('app', 'Remarks'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDivision()
    {
        return $this->hasOne(Division::className(), ['id' => 'division_id']);
    }
}
