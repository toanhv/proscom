<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sensor;

/**
 * SensorSearch represents the model behind the search form about `backend\models\Sensor`.
 */
class SensorSearch extends Sensor {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'module_id'], 'integer'],
            [['cam_bien_dan_thu', 'cam_bien_bon_solar', 'cam_bien_muc_nuoc_bon_solar', 'cam_bien_nhiet_do_bon_gia_nhiet', 'cam_bien_ap_suat_bon_gia_nhiet', 'cam_bien_buc_xa_dan_thu', 'cam_bien_nhiet_dinh_bon_solar', 'cam_bien_tran', 'cam_bien_nhiet_do_duong_ong_2', 'du_phong', 'created_at', 'cam_bien_ap_suat_duong_ong', 'cam_bien_nhiet_do_duong_ong_1', 'luong_nuoc_da_lam_nong', 'luong_dien_tieu_thu', 'so_tien_tiet_kiem', 'luong_khi_thai_co2_giam'], 'safe'],
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
        $query = Sensor::find()->select('id', 'module_id, `luong_nuoc_da_lam_nong`,`luong_dien_tieu_thu`,`so_tien_tiet_kiem`,`luong_khi_thai_co2_giam`')->distinct('module_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['module_id' => SORT_DESC]]
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
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'cam_bien_dan_thu', $this->cam_bien_dan_thu])
                ->andFilterWhere(['like', 'cam_bien_bon_solar', $this->cam_bien_bon_solar])
                ->andFilterWhere(['like', 'cam_bien_muc_nuoc_bon_solar', $this->cam_bien_muc_nuoc_bon_solar])
                ->andFilterWhere(['like', 'cam_bien_nhiet_do_bon_gia_nhiet', $this->cam_bien_nhiet_do_bon_gia_nhiet])
                ->andFilterWhere(['like', 'cam_bien_ap_suat_bon_gia_nhiet', $this->cam_bien_ap_suat_bon_gia_nhiet])
                ->andFilterWhere(['like', 'cam_bien_buc_xa_dan_thu', $this->cam_bien_buc_xa_dan_thu])
                ->andFilterWhere(['like', 'cam_bien_nhiet_dinh_bon_solar', $this->cam_bien_nhiet_dinh_bon_solar])
                ->andFilterWhere(['like', 'cam_bien_tran', $this->cam_bien_tran])
                ->andFilterWhere(['like', 'cam_bien_nhiet_do_duong_ong_2', $this->cam_bien_nhiet_do_duong_ong_2])
                ->andFilterWhere(['like', 'du_phong', $this->du_phong])
                ->andFilterWhere(['like', 'cam_bien_ap_suat_duong_ong', $this->cam_bien_ap_suat_duong_ong])
                ->andFilterWhere(['like', 'cam_bien_nhiet_do_duong_ong_1', $this->cam_bien_nhiet_do_duong_ong_1])
                ->andFilterWhere(['like', 'luong_nuoc_da_lam_nong', $this->luong_nuoc_da_lam_nong])
                ->andFilterWhere(['like', 'luong_dien_tieu_thu', $this->luong_dien_tieu_thu])
                ->andFilterWhere(['like', 'so_tien_tiet_kiem', $this->so_tien_tiet_kiem])
                ->andFilterWhere(['like', 'luong_khi_thai_co2_giam', $this->luong_khi_thai_co2_giam]);

        return $dataProvider;
    }

}
