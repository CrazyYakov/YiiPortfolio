<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Portfolio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="portfolio-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        [
            '' => 'null',
            ArrayHelper::map(app\models\Category::find()->all(), 'id', 'name'),
        ]
    )->label('Имя категории') ?>

    <?= $form->field($model, 'image_id')->fileInput(
        [
            'multiple' => true,
            'accept' => 'image/*'
        ],
    )->label('Добавить изображение') ?>

    <?= $form->field($model, 'state')->dropDownList([0 => 'активный', 1 => 'неактивный'])->label('Состояние') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>