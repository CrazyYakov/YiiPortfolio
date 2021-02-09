<?php


/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap\Nav;

echo Nav::widget([

    'items'   => [
        [
            'label' => 'Пользователи',
            'url' => ['user/index'],
            'options' => ['class' => 'nav-item']
        ],
        [
            'label' => 'Категории',
            'url' => ['category/index'],
            'options' => ['class' => 'nav-item']
        ],
        [
            'label' => 'Портфолио',
            'url' => ['portfolio/index'],
            'options' => ['class' => 'nav-item']
        ],
    ],
    'options' => [
        'class' => ['sidebar', 'bg-light', 'd-md-block', 'col-lg-2', 'col-md-3', 'position-sticky pt-3'],
    ],
]);
