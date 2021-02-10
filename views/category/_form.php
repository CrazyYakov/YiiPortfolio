<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'name')->textInput(['maxlength' => true,])->label('Имя категории') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'state')->dropDownList([0 => 'активный', 1 => 'неактивный'])->label('Состояние') ?>

    <?= $form->field($model, 'parent_id')->dropDownList(
        [
            ArrayHelper::map($model::find()->all(), 'id', 'name'),
            '' => 'null',
        ],
        [
            'promt' => 'Выберете категорию'
        ]
    )->label('имя подкатегории') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>