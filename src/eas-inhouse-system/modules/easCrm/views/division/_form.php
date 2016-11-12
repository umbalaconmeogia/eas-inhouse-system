<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\easCrm\models\Division */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="division-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'name_kana')->textInput() ?>

    <?= $form->field($model, 'name_short')->textInput() ?>

    <?= $form->field($model, 'tel')->textInput() ?>

    <?= $form->field($model, 'fax')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'zip_code')->textInput() ?>

    <?= $form->field($model, 'address1')->textInput() ?>

    <?= $form->field($model, 'address2')->textInput() ?>

    <?= $form->field($model, 'iso_country_code')->textInput() ?>

    <?= $form->field($model, 'homepage')->textInput() ?>

    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
