<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $ajax bool */
?>
<?php $form = ActiveForm::begin([
    'id' => 'create-user-form',
]); ?>
<?php if ($ajax) { ?>
<div class="modal-body">
<?php } ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accounts')->textInput() ?>

    <?php if (!$ajax) { ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php } ?>

<?php if ($ajax) { ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><?=Yii::t('app', 'Close')?></button>
    <button type="button" class="btn btn-success" id="createUserButton"><?=Yii::t('app', 'Save')?></button>
</div>
<?php } ?>
<?php ActiveForm::end(); ?>
