<?php

use yii\helpers\Html;
use batsg\helpers\HHtml;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $expensesSettlementMonth app\models\ExpensesSettlementMonth */
/* @var $expensesSettlementItem app\models\ExpensesSettlementItem */

$this->title = 'Update Expenses Settlement Month: ' . $expensesSettlementMonth->yearMonth;
$this->params['breadcrumbs'][] = ['label' => 'Expenses Settlement Months', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $expensesSettlementMonth->id, 'url' => ['view', 'id' => $expensesSettlementMonth->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expenses-settlement-month-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table bordered-table">
        <tr>
            <th>番号</th>
            <th>日付</th>
            <th>金額</th>
            <th>支払先</th>
            <th>内容</th>
            <th>備考</th>
        </tr>
        <?php foreach ($expensesSettlementMonth->expensesSettlementItems as $i => $item) { ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $item->expense_date ?></td>
                <td><?= $item->amount ?></td>
                <td><?= $item->payee ?></td>
                <td><?= $item->payment_content ?></td>
                <td><?= $item->remarks ?></td>
            </tr>
        <?php } ?>
    </table>

    <?php $form = ActiveForm::begin(['action' => ['create-item']]); ?>

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
    
<!--     create transport -->
	
	<table class="table bordered-table">
        <tr>
            <th>番号</th>
            <th>日付</th>
            <th>金額</th>
            <th>交通</th>
            <th>出発</th>
            <th>到着</th>
            <th>片/往</th>
            <th>備考</th>
        </tr>
        <?php foreach ($expensesSettlementMonth->expensesSettlementTransports as $t => $transport) { ?>
            <tr>
                <td><?= $t + 1 ?></td>
                <td><?= $transport->expense_date ?></td>
                <td><?= $transport->amount ?></td>
                <td><?= $transport->transportation ?></td>
                <td><?= $transport->section_from ?></td>
                <td><?= $transport->section_to ?></td>
                <td><?= $transport->type ?></td>
                <td><?= $transport->remarks ?></td>
            </tr>
        <?php } ?>
    </table>
	<?php $form = ActiveForm::begin(['action' => ['create-transport']]); ?>

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
</div>