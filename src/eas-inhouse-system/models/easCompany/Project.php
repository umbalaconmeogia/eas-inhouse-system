<?php

namespace app\models\easCompany;

use Yii;

/**
 * This is the model class for table "eas_company_project".
 *
 * @property string $id
 * @property string $name
 * @property string $company_id
 * @property integer $data_status
 * @property string $created_by
 * @property integer $created_at
 * @property string $updated_by
 * @property integer $updated_at
 *
 * @property EasCompany $company
 * @property EasWorkhourProjectTask[] $easWorkhourProjectTasks
 */
class Project extends \app\models\BaseBatsgModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eas_company_project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'company_id'], 'required'],
            [['id', 'name', 'company_id', 'created_by', 'updated_by'], 'string'],
            [['data_status', 'created_at', 'updated_at'], 'integer'],
            [['id'], 'unique'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => EasCompany::className(), 'targetAttribute' => ['company_id' => 'id']],
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
            'company_id' => Yii::t('app', 'Company ID'),
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
    public function getEasWorkhourProjectTasks()
    {
        return $this->hasMany(EasWorkhourProjectTask::className(), ['project_id' => 'id']);
    }
}
