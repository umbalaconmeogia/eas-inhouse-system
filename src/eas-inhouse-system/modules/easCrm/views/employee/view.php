<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\easCrm\models\Employee */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id:ntext',
            'company_id:ntext',
            'division_id:ntext',
            'employee_number:ntext',
            'name:ntext',
            'name_kana:ntext',
            'gender',
            'tel:ntext',
            'tel_ext:ntext',
            'fax:ntext',
            'mobile:ntext',
            'email:ntext',
            'title:ntext',
            'remarks:ntext',
        ],
    ]) ?>

</div>
