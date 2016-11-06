<?php
namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * Model that has field $id, $data_status, $created_at, $created_by, $update_time, $updated_by.
 *
 * @property mixed $id
 * @property integer $data_status Record status. 1: new, 2: update, 9: delete.
 * @property mixed $created_by User id of creator.
 * @property integer $created_at Created timestamp.
 * @property mixed $updated_by User id of updator.
 * @property integer $updated_at Updated timestamp.
 *
 * @property string $createdAt Created date time.
 * @property string $updatedAt Created date time.
 */
class BaseBatsgModel extends BaseModel
{
    const DATA_STATUS_NEW = 1;
    const DATA_STATUS_UPDATE = 2;
    const DATA_STATUS_DELETE = 9;

    /**
     * {@inheritDoc}
     * @see \yii\base\Component::behaviors()
     */
    public function behaviors()
    {
        return [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
        ];
    }

    /**
     * Perform massiveAssignment to a model.
     * @param CActiveRecord $model
     * @param array $parameters key=>value to assign to $model->attributes.
     * @param array $exclusiveFields Fields that are not assigned.
     */
//     public static function massiveAssign($model, $parameters,
//             $exclusiveFields = array('id', 'created_at', 'created_by', 'update_time', 'updated_by'))
//     {
//         parent::massiveAssign($model, $parameters, $exclusiveFields);
//     }

    /**
     * Get only valid models (data_status <> deleted) from model list.
     * @param BaseBatsgModel[] $modelList
     */
//     public static function getValidModels($modelList)
//     {
//         $result = array();
//         foreach ($modelList as $model) {
//             if ($model->data_status <> self::DATA_STATUS_DELETE) {
//                 $result[] = $model;
//             }
//         }
//         return $result;
//     }

    /**
     * Create ActiveQuery of finding records that are not deleted logically (data_status <> 9).
     * @return ActiveQuery
     */
    public static function findNotDeleted($condition = NULL, $params = []) {
        $result = static::find()->where(['OR', 'data_status IS NULL', ['!=', 'data_status', self::DATA_STATUS_DELETE]]);
        if ($condition) {
            $result = $result->where($condition, $params);
        }
        return $result;
    }

    /**
     * Find all records that are not deleted logically (data_status <> 9).
     * @return Model[] Array of caller class objects.
     */
    public static function findAllNotDeleted()
    {
        return self::findNotDeleted()->all();
    }

    /**
     * Reset fields below to NULL.
     *     id
     *     data_status
     *     created_at
     *     created_by
     *     update_time
     *     updated_by
     */
    public function resetCommonFields()
    {
        $this->setFieldToNull(array('id', 'data_status', 'created_at', 'created_by', 'update_time', 'updated_by'));
    }

    public function deleteLogically()
    {
        $this->data_status = self::DATA_STATUS_DELETE;
        if (!$this->save()) {
            $this->logError();
            throw new Exception("Error while deleting " . $this);
        }
    }

    /**
     * Generate a random string that is unique when put on an attribute of a DB table.
     * @param string $attribute The attribute to be checked.
     * @param string $prefix The prefix of the generated string.
     * @param number $length The length of the string.
     * @return string
     */
    public function generateUniqueRandomString(string $attribute, string $prefix, $length = 32)
    {
        $randomString = $prefix . Yii::$app->getSecurity()->generateRandomString($length);

        if($this->findOne([$attribute => $randomString])) {
            $randomString = $this->generateUniqueRandomString($attribute, $prefix, $length);
        }

        return $randomString;
    }

    /**
     * Generate unique string to be used as primary key.
     * @param string $prefix
     * @return string
     */
    public function generateId(string $prefix = NULL)
    {
        return $this->generateUniqueRandomString('id', $prefix);
    }

    /**
     * created_at in date time format.
     * @return string
     */
    public function getCreatedAt()
    {
        return \Yii::$app->formatter->asDatetime($this->created_at);
    }

    /**
     * updated_at in date time format.
     * @return string
     */
    public function getUpdatedAt()
    {
        return \Yii::$app->formatter->asDatetime($this->updated_at);
    }

    /**
     * Generate id for new record.
     * {@inheritDoc}
     * @see \yii\db\BaseActiveRecord::beforeSave()
     */
    public function beforeSave($insert)
    {
        $result = parent::beforeSave($insert);
        if ($result && $this->isNewRecord) {
            // Set id.
            // TODO: change this to class name.
            $this->id = $this->generateId($this->tableName() . '-');
        }
        return $result;
    }
}
?>