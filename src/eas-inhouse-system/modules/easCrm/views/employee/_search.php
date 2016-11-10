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

    <?= $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'company_id') ?>

    <?php echo $form->field($model, 'division_id') ?>

    <?php echo $form->field($model, 'employee_number') ?>

    <?php echo $form->field($model, 'name') ?>

    <?php echo $form->field($model, 'name_kana') ?>

    <?php echo $form->field($model, 'gender') ?>

    <?php echo $form->field($model, 'tel') ?>

    <?php echo $form->field($model, 'tel_ext') ?>

    <?php echo $form->field($model, 'fax') ?>

    <?php echo $form->field($model, 'mobile') ?>

    <?php echo $form->field($model, 'email') ?>

    <?php echo $form->field($model, 'title') ?>

    <?php echo $form->field($model, 'remarks') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
