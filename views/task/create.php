<?php

use app\assets\DatepickerAsset;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\Models\Task $model */

DatepickerAsset::register($this);

$this->title = 'Create Task';
?>

<div class="site-index">
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="body-content">
            <div class="row">
                <div class="col-12 d-flex aligns-items-center justify-content-center">

                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'due_date', [
                    ])->textInput(['class' => 'form-control datepicker']) ?>

                    <br>
                    <div class="form-group">
                        <?= Html::submitButton('Add Task', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
