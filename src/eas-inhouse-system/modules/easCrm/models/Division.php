<?php

namespace app\modules\easCrm\models;

use Yii;

/**
 * This is the model class for table "eas_crm_division".
 *
 * @property string $id
 * @property integer $data_status
 * @property string $created_by
 * @property integer $created_at
 * @property string $updated_by
 * @property integer $updated_at
 * @property string $company_id
 * @property string $name
 * @property string $name_kana
 * @property string $name_short
 * @property string $tel
 * @property string $fax
 * @property string $email
 * @property string $zip_code
 * @property string $address1
 * @property string $address2
 * @property string $homepage
 * @property string $remarks
 *
 * @property Company $company
 * @property Employee[] $employees
 */
class Division extends \batsg\models\BaseBatsgModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eas_crm_division';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'name'], 'required'],
            [['id', 'created_by', 'updated_by', 'company_id', 'name', 'name_kana', 'name_short', 'tel', 'fax', 'email', 'zip_code', 'address1', 'address2', 'homepage', 'remarks'], 'string'],
            [['data_status', 'created_at', 'updated_at'], 'integer'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
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
            'name' => Yii::t('app', 'Name'),
            'name_kana' => Yii::t('app', 'Name Kana'),
            'name_short' => Yii::t('app', 'Name Short'),
            'tel' => Yii::t('app', 'Tel'),
            'fax' => Yii::t('app', 'Fax'),
            'email' => Yii::t('app', 'Email'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'address1' => Yii::t('app', 'Address1'),
            'address2' => Yii::t('app', 'Address2'),
            'homepage' => Yii::t('app', 'Homepage'),
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
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['division_id' => 'id']);
    }
}
