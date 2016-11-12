<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\easCrm\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Employees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Employee'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'company_id:ntext',
            'division_id:ntext',
            'employee_number:ntext',
            'first_name:ntext',
            'middle_name:ntext',
            'last_name:ntext',
            'first_name_kana:ntext',
            'last_name_kana:ntext',
            'middle_name_kana:ntext',
            'gender',
            'tel:ntext',
            'tel_ext:ntext',
            'fax:ntext',
            'mobile:ntext',
            'email:ntext',
            'job_title:ntext',
            'zip_code:ntext',
            'address1:ntext',
            'address2:ntext',
            'iso_country_code:ntext',
            'remarks:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
