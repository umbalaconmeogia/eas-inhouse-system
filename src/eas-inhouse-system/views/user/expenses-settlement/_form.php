<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExpensesSettlementMonth */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expenses-settlement-month-form">

    <?php $form = ActiveForm::begin(['enableClientValidation'=> FALSE]); ?>

    <?= $form->field($model, 'month')->textInput(['type' => 'month', 'value' => $model->valueForInputTypeMonth]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
