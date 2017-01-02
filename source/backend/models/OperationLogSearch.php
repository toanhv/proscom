<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\OperationLog;

/**
 * OperationLogSearch represents the model behind the search form about `backend\models\OperationLog`.
 */
class OperationLogSearch extends OperationLog {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'module_id'], 'integer'],
            [['created_time', 'message'], 'safe'],
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
        $query = OperationLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'module_id' => $this->module_id,
        ]);

        $query->andFilterWhere(['between', 'created_time', $this->fromDate, $this->toDate]);

        $query->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }

}
