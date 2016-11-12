<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\easCrm\models\Employee */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
