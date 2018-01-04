<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $address
 *
 * @property int $accounts
 * @property string $added
 *
 * @property Account $account
 */
class User extends \yii\db\ActiveRecord
{
    public $accounts;
    public $added;

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        if (is_numeric($this->accounts)) {
            Account::toggle($this);
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     *
     */
    public function afterFind()
    {
        $this->accounts = $this->account->account ?? 0;

        parent::afterFind();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'address'], 'filter', 'filter' => 'strip_tags'],
            [['name', 'email', 'address'], 'filter', 'filter' => 'trim'],
            [['name', 'email', 'address'], 'required'],
            [['name', 'email', 'address'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['accounts'], 'integer'],
            [['added'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'address' => Yii::t('app', 'Address'),
            'accounts' => Yii::t('app', 'Accounts'),
            'added' => Yii::t('app', 'Added'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['user_id' => 'id']);
    }

    /**
     * @return array
     */
    public static function dropList(): array
    {
        $model = static::find()->orderBy('id desc')->all();

        return ArrayHelper::map($model, 'id', 'name');
    }
}
