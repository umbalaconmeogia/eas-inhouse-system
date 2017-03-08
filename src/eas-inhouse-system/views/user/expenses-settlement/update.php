<?php

use yii\helpers\Html;
use batsg\helpers\HHtml;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $expensesSettlementMonth app\models\ExpensesSettlementMonth */
/* @var $expensesSettlementItem app\models\ExpensesSettlementItem */
/* @var $expensesSettlementTransport app\models\ExpensesSettlementTransport */

$this->title = 'Update Expenses Settlement Month: ' . $expensesSettlementMonth->yearMonth;
$this->params['breadcrumbs'][] = ['label' => 'Expenses Settlement Months', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $expensesSettlementMonth->id, 'url' => ['view', 'id' => $expensesSettlementMonth->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expenses-settlement-month-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <h2>経費</h2>
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

    <p>
    <?= $this->render('_createItemForm', ['expensesSettlementItem' => $expensesSettlementItem]); ?>
    </p>

<!--     create transport -->

    <h2>交通費</h2>
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

    <p>
    <?= $this->render('_createTransportForm', ['expensesSettlementTransport' => $expensesSettlementTransport]); ?>
    </p>
</div>
