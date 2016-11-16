<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Lending;

/**
 * LendingSearch represents the model behind the search form about `backend\models\Lending`.
 */
class LendingSearch extends Lending
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'copy_id'], 'integer'],
            [['lend_auth_at', 'lend_return_at', 'lend_return_real'], 'safe'],
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
        $query = Lending::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'copy_id' => $this->copy_id,
            'lend_auth_at' => $this->lend_auth_at,
            'lend_return_at' => $this->lend_return_at,
            'lend_return_real' => $this->lend_return_real,
        ]);

        return $dataProvider;
    }
}
