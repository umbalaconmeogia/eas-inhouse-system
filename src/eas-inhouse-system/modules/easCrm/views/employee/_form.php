<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\easCrm\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'company_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'division_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'employee_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name_kana')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'gender')->textInput() ?>

    <?= $form->field($model, 'tel')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tel_ext')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fax')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'mobile')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
