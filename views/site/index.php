<?php

use kartik\icons\Icon;
use yii\debug\models\timeline\DataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

//Icon::map($this, Icon::EL);
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="first-str">
        <div class="text-start h2 center-block" style="width: 50%;">
            <p style=" font-family:Georgia; font-weight: bold;"> Заказ на создание
                <br> веб-сайта стал еще удобнее
            </p>

            <form action="" method="post" class="form-request">
                <div class="input-group mb-3">
                    <input class="form-control" type="username" placeholder="Введите ФИО">
                    <input class="form-control" type="email" placeholder="Введите Email">
                    <textarea class="form-control" style="height: 150px;" type="textarea" placeholder="Введите сообщение"></textarea>
                    <input class="btn btn-default" type="submit" value="отправить">
                </div>
            </form>
            <br>
            <!-- <div class="icons row text-center" style="height: 40px;">
                VK
                Instagram
                Github
                Telegram
            </div> -->
        </div>
        <div class="text-center center-block" id="btn-my-works">
            мои работы
        </div>

    </div>
    <div class=" second-str">
        <p>Мои работы</p>
        <div class="works">

            <?php
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'label' => 'image',
                        'value' => function ($data) {
                            return ('data:' . $data->image->type . ';base64,' . base64_encode($data->image->image));
                        },
                        'format' => ['image', ['width' => '200px', 'height' => '200px']],
                    ]
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="third-str">
        <p>О себе</p>
    </div>
</div>