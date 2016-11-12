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
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $first_name_kana
 * @property string $last_name_kana
 * @property string $middle_name_kana
 * @property integer $gender
 * @property string $tel
 * @property string $tel_ext
 * @property string $fax
 * @property string $mobile
 * @property string $email
 * @property string $job_title
 * @property string $zip_code
 * @property string $address1
 * @property string $address2
 * @property string $iso_country_code
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
            [['company_id', 'first_name', 'middle_name', 'last_name'], 'required'],
            [['id', 'created_by', 'updated_by', 'company_id', 'division_id', 'employee_number', 'first_name', 'middle_name', 'last_name', 'first_name_kana', 'last_name_kana', 'middle_name_kana', 'tel', 'tel_ext', 'fax', 'mobile', 'email', 'job_title', 'zip_code', 'address1', 'address2', 'iso_country_code', 'remarks'], 'string'],
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
            'first_name' => Yii::t('app', 'First Name'),
            'middle_name' => Yii::t('app', 'Middle Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'first_name_kana' => Yii::t('app', 'First Name Kana'),
            'last_name_kana' => Yii::t('app', 'Last Name Kana'),
            'middle_name_kana' => Yii::t('app', 'Middle Name Kana'),
            'gender' => Yii::t('app', 'Gender'),
            'tel' => Yii::t('app', 'Tel'),
            'tel_ext' => Yii::t('app', 'Tel Ext'),
            'fax' => Yii::t('app', 'Fax'),
            'mobile' => Yii::t('app', 'Mobile'),
            'email' => Yii::t('app', 'Email'),
            'job_title' => Yii::t('app', 'Job Title'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'address1' => Yii::t('app', 'Address1'),
            'address2' => Yii::t('app', 'Address2'),
            'iso_country_code' => Yii::t('app', 'Iso Country Code'),
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
