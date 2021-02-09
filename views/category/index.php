<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Название',
                'attribute' => 'name',
            ],
            
            [
                'label' => 'Описание',
                'attribute' => 'description',
            ],
            [
                'label' => 'Родитель категории',
                'attribute' => 'parent.name',
            ],
            [
                'label' => 'Состояние',
                'attribute' => 'state',
                'filter' =>  [
                    '0' => 'Неактивынй',
                    '1' => 'Активный',
                ],
            ],

            //'user_id',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>