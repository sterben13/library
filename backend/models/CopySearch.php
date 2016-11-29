<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Copy;

/**
 * CopySearch represents the model behind the search form about `backend\models\Copy`.
 */
class CopySearch extends Copy {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['copy_id', 'book_id', 'copy_edition', 'copy_language', 'copy_state', 'copy_available'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Copy::find();

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
        $query->joinWith('book');
        // grid filtering conditions
        $query->andFilterWhere([
            
        ]);

        $query->andFilterWhere(['like', 'copy_edition', $this->copy_edition])
                ->andFilterWhere(['like', 'copy_language', $this->copy_language])
                ->andFilterWhere(['like', 'copy_state', $this->copy_state])
                ->andFilterWhere(['like', 'book_title', $this->book_id,])
                ->andFilterWhere(['like', 'copy_id', $this->copy_id,])
                ->andFilterWhere(['like', 'copy_available', $this->copy_available]);


        return $dataProvider;
    }

}
