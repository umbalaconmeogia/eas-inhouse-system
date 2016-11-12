<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\easCrm\models\EmployeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'company_id') ?>

    <?php echo $form->field($model, 'division_id') ?>

    <?php echo $form->field($model, 'employee_number') ?>

    <?php echo $form->field($model, 'first_name') ?>

    <?php echo $form->field($model, 'middle_name') ?>

    <?php echo $form->field($model, 'last_name') ?>

    <?php echo $form->field($model, 'first_name_kana') ?>

    <?php echo $form->field($model, 'last_name_kana') ?>

    <?php echo $form->field($model, 'middle_name_kana') ?>

    <?php echo $form->field($model, 'gender') ?>

    <?php echo $form->field($model, 'tel') ?>

    <?php echo $form->field($model, 'tel_ext') ?>

    <?php echo $form->field($model, 'fax') ?>

    <?php echo $form->field($model, 'mobile') ?>

    <?php echo $form->field($model, 'email') ?>

    <?php echo $form->field($model, 'job_title') ?>

    <?php echo $form->field($model, 'zip_code') ?>

    <?php echo $form->field($model, 'address1') ?>

    <?php echo $form->field($model, 'address2') ?>

    <?php echo $form->field($model, 'iso_country_code') ?>

    <?php echo $form->field($model, 'remarks') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
