<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ExpenseMonth */

$this->title = 'Create Expense Month';
$this->params['breadcrumbs'][] = ['label' => 'Expense Months', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expense-month-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
