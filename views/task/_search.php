<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\search\TaskSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="task-search">

    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => true],
        'action' => ['index'],
        'method' => 'get',
        'id' => 'tasks',
        'enablePushState' => false
    ]); ?>

    <?= $form->field($model, 'name') ?>

    <?php ActiveForm::end(); ?>

</div>