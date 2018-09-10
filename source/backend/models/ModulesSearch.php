<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Modules;

/**
 * ModulesSearch represents the model behind the search form about `backend\models\Modules`.
 */
class ModulesSearch extends Modules {

    public $keywork;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'country_id', 'privincial_id', 'distric_id', 'created_by', 'updated_by', 'status'], 'integer'],
            [['msisdn', 'customer_code', 'address', 'created_at', 'updated_at'], 'safe'],
            [['keywork', 'name'], 'string'],
            [['keywork', 'name'], 'trim'],
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
        $query = Modules::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $this->customer_code = substr($this->name, 9);

        if ($_GET['alarm']) {
            switch (intval($_GET['alarm'])) {
//                case 1:
//                    $query->joinWith(['sensors' => function ($q) {
//                            $q->from(Sensor::tableName() . ' sensor')->andFilterCompare('sensor.cam_bien_muc_nuoc_bon_solar', 3, '>=');
//                        }]);
//                    break;
                case 2:
                    $this->status = 4;
                    break;
            }
        }

        $query->andFilterWhere([
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->orFilterWhere(['like', 'customer_code', $this->name]);

        if ($this->customer_code) {
            $query->orFilterWhere(['customer_code' => $this->customer_code]);
        }

        $role = \Yii::$app->authManager->getAssignment('module', Yii::$app->user->getId());
        if ($role && $role->roleName != 'admin') {
            $query->andFilterWhere([
                'created_by' => Yii::$app->user->getId(),
            ]);
        }

        return $dataProvider;
    }

}
