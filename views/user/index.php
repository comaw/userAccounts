<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $ajax bool */

$this->title = Yii::t('app', 'Users');
?>
<?php if (!$ajax) { ?>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalCreate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalAccounts">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCreate"><?=Yii::t('app', 'Create User')?></button>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalAccounts"><?=Yii::t('app', 'Create Account')?></button>

    </p>
 <div id="users-list-div">
<?php } ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            'address',
            [
                'attribute' => 'accounts',
                'format' => 'raw',
                'value' => function(User $data){
                    if (!isset($data->account->account)) {
                        return null;
                    }
                    return $data->account->account;
                },
            ],
            [
                'attribute' => 'added',
                'format' => 'raw',
                'value' => function(User $data){
                    if (!isset($data->account->added) || !$data->account->added) {
                        return null;
                    }
                    return Yii::$app->formatter->asDate($data->account->added);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php if (!$ajax) { ?>
    </div>
</div>
<?php

$urlCreate = Url::toRoute(['user/create']);
$urlCreateAccount = Url::toRoute(['account/create']);
$urlList = Url::toRoute(['user/index']);

$script = <<< JS
    function usersList() {
      jQuery.get('$urlList', function(data) {
        jQuery('#users-list-div').html(data);
      });
    }
    var idModalCreate = '#modalCreate';
    var idModalAccounts = '#modalAccounts';
    
    jQuery(idModalAccounts).on('show.bs.modal', function (event) {
        jQuery.get('$urlCreateAccount', function(html) {
            jQuery(idModalAccounts + ' .modal-content').html(html);
        });
    }); 
    jQuery(idModalAccounts).on('click', '#createAccountButton', function() {
        var data = jQuery('#create-account-form').serialize();
        jQuery.post('$urlCreateAccount', data, function(request) {
            if (request.saved) {
                usersList();
                jQuery(idModalAccounts).modal('hide');
            } else {
                var errors = '';
                jQuery.each( request.errors, function( key, value ) {
                  errors += value[0] + ' &#13 ';
                });
                alert(errors);
            }
        });
    });

    jQuery(idModalCreate).on('show.bs.modal', function (event) {
        jQuery.get('$urlCreate', function(html) {
            jQuery(idModalCreate + ' .modal-content').html(html);
        });
    }); 
    jQuery(idModalCreate).on('click', '#createUserButton', function() {
        var data = jQuery('#create-user-form').serialize();
        jQuery.post('$urlCreate', data, function(request) {
            if (request.saved) {
                usersList();
                jQuery(idModalCreate).modal('hide');
            } else {
                var errors = '';
                jQuery.each( request.errors, function( key, value ) {
                  errors += value[0] + ' &#13 ';
                });
                alert(errors);
            }
        });
    });
JS;

$this->registerJs($script, yii\web\View::POS_READY);
?>
<?php } ?>