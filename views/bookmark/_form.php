<?php

use yii\helpers\Html;
use theme\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;

/**
 * @var yii\web\View $this
 * @var core\models\Bookmark $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="bookmark-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'reminder')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Enter reminder time ...'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'M dd, yyyy HH:ii p'
        ]
    ]);?>

    <?= $form->field($model, 'description')->textarea(['class' => 'editor']) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <div class="form-actions text-right">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
