<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AddParams;

/**
 * AddParamsSearch represents the model behind the search form about `backend\models\AddParams`.
 */
class AddParamsSearch extends AddParams
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'module_id'], 'integer'],
            [['luong_nuoc_da_lam_nong', 'luong_dien_tieu_thu', 'so_tien_tiet_kiem', 'luong_khi_thai_co2_giam'], 'safe'],
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
        $query = AddParams::find();

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

        $query->andFilterWhere(['like', 'luong_nuoc_da_lam_nong', $this->luong_nuoc_da_lam_nong])
            ->andFilterWhere(['like', 'luong_dien_tieu_thu', $this->luong_dien_tieu_thu])
            ->andFilterWhere(['like', 'so_tien_tiet_kiem', $this->so_tien_tiet_kiem])
            ->andFilterWhere(['like', 'luong_khi_thai_co2_giam', $this->luong_khi_thai_co2_giam]);

        return $dataProvider;
    }
}
