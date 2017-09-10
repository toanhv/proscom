<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Imsi;

/**
 * ImsiSearch represents the model behind the search form about `backend\models\Imsi`.
 */
class ImsiSearch extends Imsi {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'module_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['imsi', 'module_id_assignment', 'created_at', 'updated_at'], 'safe'],
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
        $query = Imsi::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'status' => [0, 1, 2, 4]
        ]);

        $query->andFilterWhere(['like', 'imsi', $this->imsi]);

        return $dataProvider;
    }

}
