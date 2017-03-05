<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExpensesSettlementMonthSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Expenses Settlement Months';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenses-settlement-month-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Expenses Settlement Month', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'month' => [
                'attribute' => 'month',
                'value' => 'yearMonth',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
        ],
    ]); ?>
</div>
