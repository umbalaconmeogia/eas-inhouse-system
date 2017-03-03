<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;

NavBar::begin([
    'brandLabel' => 'EAS',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
$items = [];

// Login/Logout
if (Yii::$app->user->isGuest) {
    $items[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
    $items[] = ['label' => '経費申請', 'url' => ['/user/expense-month/index']];
    $items[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
}

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $items,
]);

NavBar::end();
?>
