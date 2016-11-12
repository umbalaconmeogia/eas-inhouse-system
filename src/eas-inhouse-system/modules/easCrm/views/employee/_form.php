<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\easCrm\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'division_id')->textInput() ?>

    <?= $form->field($model, 'employee_number')->textInput() ?>

    <?= $form->field($model, 'first_name')->textInput() ?>

    <?= $form->field($model, 'middle_name')->textInput() ?>

    <?= $form->field($model, 'last_name')->textInput() ?>

    <?= $form->field($model, 'first_name_kana')->textInput() ?>

    <?= $form->field($model, 'last_name_kana')->textInput() ?>

    <?= $form->field($model, 'middle_name_kana')->textInput() ?>

    <?= $form->field($model, 'gender')->textInput() ?>

    <?= $form->field($model, 'tel')->textInput() ?>

    <?= $form->field($model, 'tel_ext')->textInput() ?>

    <?= $form->field($model, 'fax')->textInput() ?>

    <?= $form->field($model, 'mobile')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'job_title')->textInput() ?>

    <?= $form->field($model, 'zip_code')->textInput() ?>

    <?= $form->field($model, 'address1')->textInput() ?>

    <?= $form->field($model, 'address2')->textInput() ?>

    <?= $form->field($model, 'iso_country_code')->textInput() ?>

    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
