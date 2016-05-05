<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GudangBangunan;

/**
 * GudangBangunanSearch represents the model behind the search form about `app\models\GudangBangunan`.
 */
class GudangBangunanSearch extends GudangBangunan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gudang_id', 'user_id'], 'integer'],
            [['kode', 'created', 'updated'], 'safe'],
            [['kapasitas_m3', 'latitude', 'longitude'], 'number'],
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
        $query = GudangBangunan::find();

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
            'id' => $this->id,
            'gudang_id' => $this->gudang_id,
            'kapasitas_m3' => $this->kapasitas_m3,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'user_id' => $this->user_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'kode', $this->kode]);

        return $dataProvider;
    }
}
