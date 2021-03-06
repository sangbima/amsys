<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GudangLot;

/**
 * GudangLotSearch represents the model behind the search form about `app\models\GudangLot`.
 */
class GudangLotSearch extends GudangLot
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['kode', 'gudang_bangunan_id', 'created', 'updated'], 'safe'],
            [['kapasitas_m3'], 'number'],
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
        $query = GudangLot::find();

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

        $query->joinWith('gudangBangunan');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'gudang_lot.kapasitas_m3' => $this->kapasitas_m3,
            'user_id' => $this->user_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'gudang_lot.kode', $this->kode])
              ->andFilterWhere(['like', 'gudang_bangunan.kode', $this->gudang_bangunan_id]);

        return $dataProvider;
    }
}
