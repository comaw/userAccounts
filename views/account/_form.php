<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form yii\widgets\ActiveForm */
/* @var $ajax bool */
?>
<?php $form = ActiveForm::begin([
    'id' => 'create-account-form',
]); ?>
<?php if ($ajax) { ?>
<div class="modal-body">
    <?php } ?>

    <?= $form->field($model, 'user_id')->dropDownList(User::dropList(), ['prompt' => Yii::t('app', '-- select user --')]) ?>

    <?= $form->field($model, 'account')->textInput() ?>

    <?php if (!$ajax) { ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    <?php } ?>

    <?php if ($ajax) { ?>
</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?=Yii::t('app', 'Close')?></button>
        <button type="button" class="btn btn-success" id="createAccountButton"><?=Yii::t('app', 'Save')?></button>
    </div>
<?php } ?>
<?php ActiveForm::end(); ?>
