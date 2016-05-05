<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GudangDataKarung;

/**
 * GudangDataKarungSearch represents the model behind the search form about `app\models\GudangDataKarung`.
 */
class GudangDataKarungSearch extends GudangDataKarung
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gudang_masuk_id', 'gudang_lot_id'], 'integer'],
            [['bobot_kg'], 'number'],
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
        $query = GudangDataKarung::find();

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
            'gudang_masuk_id' => $this->gudang_masuk_id,
            'gudang_lot_id' => $this->gudang_lot_id,
            'bobot_kg' => $this->bobot_kg,
        ]);

        return $dataProvider;
    }
}
