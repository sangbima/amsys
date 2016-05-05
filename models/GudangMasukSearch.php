<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GudangMasuk;

/**
 * GudangMasukSearch represents the model behind the search form about `app\models\GudangMasuk`.
 */
class GudangMasukSearch extends GudangMasuk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gudang_id', 'petugas_gudang', 'user_id'], 'integer'],
            [['no_proposal', 'no_antar_gudang', 'waktu_masuk', 'created', 'updated'], 'safe'],
            [['timbang_masuk_kg'], 'number'],
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
        $query = GudangMasuk::find();

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
            'timbang_masuk_kg' => $this->timbang_masuk_kg,
            'waktu_masuk' => $this->waktu_masuk,
            'petugas_gudang' => $this->petugas_gudang,
            'user_id' => $this->user_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'no_proposal', $this->no_proposal])
            ->andFilterWhere(['like', 'no_antar_gudang', $this->no_antar_gudang]);

        return $dataProvider;
    }
}
