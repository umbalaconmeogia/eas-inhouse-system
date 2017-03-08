<?php
use yii\widgets\ActiveForm;
use batsg\helpers\HHtml;
use yii\helpers\Html;

/* @var $expensesSettlementItem app\models\ExpensesSettlementItem */

?>
<?php
    yii\bootstrap\Modal::begin([
        'header' => '<h2>経費登録</h2>',
        'toggleButton' => ['label' => '経費登録', 'class' => 'btn btn-success'],
    ]);
?>
    <?php $form = ActiveForm::begin([
        'action' => ['create-item'],
    ]); ?>

    <?= HHtml::hiddenInput($expensesSettlementItem, 'expenses_settlement_month_id') ?>
    <?= $form->field($expensesSettlementItem, 'expense_date')->textInput(['type' => 'date']) ?>
    <?= $form->field($expensesSettlementItem, 'amount')->textInput() ?>
    <?= $form->field($expensesSettlementItem, 'payee')->textInput() ?>
    <?= $form->field($expensesSettlementItem, 'payment_content')->textInput() ?>
    <?= $form->field($expensesSettlementItem, 'remarks')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php yii\bootstrap\Modal::end(); ?>

