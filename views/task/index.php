<?php

use yii\bootstrap5\Html;
use yii\grid\CheckboxColumn;
use yii\grid\GridView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\search\TaskSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Task';
?>

<div class="site-index">
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="body-content">
            <div class="row">
                <div class="col-12 d-flex aligns-items-center justify-content-center">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'layout' => '{summary}' . Html::activeDropDownList(
                                $searchModel,
                                'myPageSize', [2 => 2, 4 => 4, 8 => 8],
                                ['id' => 'myPageSize']) . "{items}<br/>{pager}",
                        'filterSelector' => '#myPageSize',
                        'columns' => [
                            [
                                'attribute' => 'name',
                                'label' => 'Task Name',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Html::a(Html::encode($model->name), Url::to(['task/update', 'id' => $model->id]));
                                },
                            ],
                            ['attribute' => 'due_date', 'format' => ['date', 'php:m/d/Y'], 'enableSorting' => false],
                            [
                                'header' => 'Completed',
                                'class' => CheckboxColumn::class,
                                'cssClass' => 'checkComplete',
                                'checkboxOptions' => function ($model) {
                                    return $model->complete ? ['checked' => true] : [];
                                }],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$checkBoxUpdate = <<< JS
    $("document").ready(function(){ 
        $(document).on("change",".checkComplete", function() {
            $.ajax({
            async: true,
            url:'/task/update-complete',
            type:'post',
                data:{_csrf: yii.getCsrfToken(), complete: this.checked, taskID: this.value}
           
                });
            $.pjax.reload({container:'#tasks'});
        });
    });
JS;

$this->registerJs($checkBoxUpdate, \yii\web\View::POS_READY);

?>
