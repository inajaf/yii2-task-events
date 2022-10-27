<?php

use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Task';
?>

<div class="site-index">
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="body-content">
            <div class="row">
                <div class="col-12 d-flex aligns-items-center justify-content-center">
                    <p><a href="<?= Url::toRoute(['task/create']) ?>">Add New Task</a></p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex aligns-items-center justify-content-center">
                    <p><a href="<?= Url::toRoute(['task/index']) ?>">View Tasks</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
