<?php

namespace app\models\easCompany;

use Yii;

/**
 * This is the model class for table "eas_company_employee".
 *
 * @property string $id
 * @property string $company_id
 * @property string $division_id
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
 * @property integer $data_status
 * @property string $created_by
 * @property integer $created_at
 * @property string $updated_by
 * @property integer $updated_at
 *
 * @property EasCompany $company
 * @property EasCompanyDivision $division
 * @property EasWorkhourTimeRecord[] $easWorkhourTimeRecords
 */
class Employee extends \app\models\BaseBatsgModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eas_company_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'name'], 'required'],
            [['id', 'company_id', 'division_id', 'name', 'name_kana', 'tel', 'tel_ext', 'fax', 'mobile', 'email', 'title', 'remarks', 'created_by', 'updated_by'], 'string'],
            [['gender', 'data_status', 'created_at', 'updated_at'], 'integer'],
            [['id'], 'unique'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => EasCompany::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['division_id'], 'exist', 'skipOnError' => true, 'targetClass' => EasCompanyDivision::className(), 'targetAttribute' => ['division_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company_id' => Yii::t('app', 'Company ID'),
            'division_id' => Yii::t('app', 'Division ID'),
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
            'data_status' => Yii::t('app', 'Data Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(EasCompany::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDivision()
    {
        return $this->hasOne(EasCompanyDivision::className(), ['id' => 'division_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEasWorkhourTimeRecords()
    {
        return $this->hasMany(EasWorkhourTimeRecord::className(), ['employee_id' => 'id']);
    }
}
