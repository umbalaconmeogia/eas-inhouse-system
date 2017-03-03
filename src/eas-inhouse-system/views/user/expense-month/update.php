<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ExpenseMonth */

$this->title = 'Update Expense Month: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Expense Months', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expense-month-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
