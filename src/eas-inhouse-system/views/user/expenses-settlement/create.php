<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ExpensesSettlementMonth */

$this->title = 'Create Expenses Settlement Month';
$this->params['breadcrumbs'][] = ['label' => 'Expenses Settlement Months', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenses-settlement-month-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
