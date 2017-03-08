<?php
use yii\widgets\ActiveForm;
use batsg\helpers\HHtml;
use yii\helpers\Html;

/* @var $expensesSettlementTransport app\models\ExpensesSettlementTransport */

?>

<?php
    yii\bootstrap\Modal::begin([
        'header' => '<h2>交通費登録</h2>',
        'toggleButton' => ['label' => '交通費登録', 'class' => 'btn btn-success'],
    ]);
?>

    <?php $form = ActiveForm::begin([
        'action' => ['create-transport'],
    ]); ?>

    <?= HHtml::hiddenInput($expensesSettlementTransport, 'expenses_settlement_month_id') ?>
    <?= $form->field($expensesSettlementTransport, 'expense_date')->textInput(['type' => 'date']) ?>
    <?= $form->field($expensesSettlementTransport, 'amount')->textInput() ?>
    <?= $form->field($expensesSettlementTransport, 'transportation')->textInput() ?>
    <?= $form->field($expensesSettlementTransport, 'section_from')->textInput() ?>
    <?= $form->field($expensesSettlementTransport, 'section_to')->textInput() ?>
    <?= $form->field($expensesSettlementTransport, 'type')->textInput() ?>
    <?= $form->field($expensesSettlementTransport, 'remarks')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

<?php yii\bootstrap\Modal::end(); ?>
