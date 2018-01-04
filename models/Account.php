<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%account}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $account
 * @property string $added
 *
 * @property User $user
 */
class Account extends \yii\db\ActiveRecord
{

    /**
     * @param User $user
     */
    public static function toggle(User $user)
    {
        $model = static::find()->where(['=', 'user_id', $user->id])->one();
        if (!$model) {
            $model = new static();
            $model->user_id = $user->id;
        }
        $model->account = (int)$user->accounts;
        $model->save();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%account}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'account'], 'required'],
            [['user_id', 'account'], 'integer'],
            [['added'], 'safe'],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'account' => Yii::t('app', 'Account'),
            'added' => Yii::t('app', 'Added'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
