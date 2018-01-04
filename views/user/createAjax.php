<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $ajax bool */

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ajax' => $ajax
    ]) ?>

    </div>
</div>