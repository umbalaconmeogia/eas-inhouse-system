<?php

namespace app\models\easCrm;

use Yii;

/**
 * This is the model class for table "eas_crm_company".
 *
 * @property string $id
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
 * @property string $industry
 * @property string $remarks
 * @property integer $is_eas
 * @property integer $data_status
 * @property string $created_by
 * @property integer $created_at
 * @property string $updated_by
 * @property integer $updated_at
 */
class Company extends \app\models\BaseBatsgModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eas_crm_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id', 'name', 'name_kana', 'name_short', 'tel', 'fax', 'email', 'zip_code', 'address1', 'address2', 'homepage', 'industry', 'remarks', 'created_by', 'updated_by'], 'string'],
            [['is_eas', 'data_status', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
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
            'industry' => Yii::t('app', 'Industry'),
            'remarks' => Yii::t('app', 'Remarks'),
            'is_eas' => Yii::t('app', 'Is Eas'),
            'data_status' => Yii::t('app', 'Data Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
