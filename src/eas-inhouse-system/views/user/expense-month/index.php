<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExpenseMonthSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Expense Months';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expense-month-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php $form = ActiveForm::begin(['action' => ['create']]); ?>

    <p>経費申請月
        <?= Html::activeTextInput($orderRequest, 'order_request_date', ['type' => 'date']) ?>
        <?= Html::activeHiddenInput($orderRequest, 'ticketing_type') ?>
        <?= Html::submitButton($searchModel->ticketingTypeStr . '作成', ['class' => 'btn btn-success']) ?>
    </p>

    <?php ActiveForm::end(); ?>

    <p>
        <?= Html::a('Create Expense Month', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'month',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
        ],
    ]); ?>
</div>
