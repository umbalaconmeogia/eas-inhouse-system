<?php

namespace app\models;

use Yii;

class BaseModel extends \yii\db\ActiveRecord
{
    /**
     * Get all errors on this model.
     * @param string $attribute attribute name. Use null to retrieve errors for all attributes.
     * @return array errors for all attributes or the specified attribute. Empty array is returned if no error.
     */
    public function getErrorMessages($attribute = NULL)
    {
        if ($attribute === NULL) {
            $attribute = $this->attributes();
        }
        if (!is_array($attribute)) {
            $attribute = array($attribute);
        }
        $errors = array();
        foreach ($attribute as $attr) {
            if ($this->hasErrors($attr)) {
                $errors = array_merge($errors, array_values($this->getErrors($attr)));
            }
        }
        return $errors;
    }

    /**
     * Log error of this model.
     * @param string $message The message to be exported first.
     */
    public function logError($message = NULL, $category = 'application')
    {
        if ($message) {
            Yii::error($message, $category);
        }
        Yii::error($this->tableName() . " " . print_r($this->attributes, TRUE), $category);
        Yii::error(print_r($this->getErrorMessages(), TRUE), $category);
    }

    /**
     * Save this model, write error to log if error occurs.
     * @return boolean
     */
    public function saveLogError()
    {
        $result = $this->save();
        if (!$result) {
            $this->logError();
        }
        return $result;
    }

    /**
     * Save this model, write error to log and throw exception if error occurs.
     * @throws Exception
     */
    public function saveThrowError()
    {
        if (!$this->saveLogError()) {
            throw new \Exception("Error while saving " . $this->toString());
        }
    }

    /**
     * Create a hash of model list by a field value.
     * @param CActiveRecord $models
     * @param string $keyField Default by id.
     * @param string $valueField If specified, then this field's value is used as array's value.
     *                           Else set the model instance as value.
     * @return array field $keyValue => ($value or model).
     */
    public static function hashModels($models, $keyField = 'id', $valueField = NULL) {
        $hash = [];
        foreach ($models as $model) {
            $hash[$model->$keyField] = $valueField ? $model->$valueField : $model;
        }
        return $hash;
    }

    /**
     * Create an array of model's field value.
     * @param CActiveRecord $models
     * @param string $keyField
     * @return array
     */
    public static function getArrayOfFieldValue($models, $keyField = 'id') {
        $values = [];
        foreach ($models as $model) {
            $values[] = $model->$keyField;
        }
        return $values;
    }

    public function __toString()
	{
	    return $this->toString($this->toStringFields());
	}

    /**
     * Create a string that describe all fields of this object.
     * @param mixed $fields String or string array. If NULL, all attributes are used.
     * @return string.
     */
    public function toString($fields = NULL)
    {
        // Get attributes.
        if ($fields === NULL) {
            $fields = array_keys($this->attributes);
        }
        if (!is_array($fields)) {
            $fields = array($fields);
        }
        foreach ($fields as $field) {
            $info[] = "$field: {$this->$field}";
        }

        // Get class name.
        $className = get_class($this);
        $className = ($pos = strrpos($className, '\\')) === FALSE ? $className : substr($className, $pos + 1);

        return "$className(" . join(', ', $info) . ')';
    }

    /**
     * Define mandator fields to be displayed in __toString().
     *
     * Display only primary key fields by default. Sub class should override this.
     *
     * @return string[]
     */
    protected function toStringFields()
    {
        return $this->tableSchema->primaryKey;
    }
}
