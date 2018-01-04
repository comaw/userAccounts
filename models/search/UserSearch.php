<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'accounts'], 'integer'],
            [['name', 'email', 'address', 'added'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $query->joinWith(['account']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['accounts'] = [
            'asc' => ['{{%account}}.account' => SORT_ASC],
            'desc' => ['{{%account}}.account' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['added'] = [
            'asc' => ['{{%account}}.added' => SORT_ASC],
            'desc' => ['{{%account}}.added' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            '{{%account}}.account' => $this->accounts,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', '{{%account}}.added', $this->added]);;

        return $dataProvider;
    }
}
