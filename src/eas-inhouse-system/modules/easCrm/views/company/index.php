<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\easCrm\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name:ntext',
            'name_kana:ntext',
            'name_short:ntext',
            'tel:ntext',
            // 'fax:ntext',
            // 'email:ntext',
            // 'zip_code:ntext',
            'address1:ntext',
            'address2:ntext',
            'homepage:ntext',
            // 'industry:ntext',
            // 'remarks:ntext',
            // 'is_eas',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
