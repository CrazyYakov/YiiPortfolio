<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Portfolio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="portfolio-form">

    <?php $form = ActiveForm::begin(/*['options' => ['enctype' => 'multipart/form-data']]*/); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        [
            '' => 'null',
            $modelCategory,
        ]
    )->label('Имя категории') ?>

    <?php if (isset($encodeFile)) { ?>

        <?= Html::img('data:' . $modelImage['type'] . ';base64,' . $encodeFile, ['width' => '20%', 'height' => '20%']) ?>

    <?php } ?>

    <?= $form->field($modelImage, 'imageFile')->fileInput()->label('Добавить изображение') ?>

    <?= $form->field($model, 'state')->dropDownList([1 => 'активный', 0 => 'неактивный'])->label('Состояние') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Описание') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>