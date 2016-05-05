<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LapakLog;

/**
 * LapakLogSearch represents the model behind the search form about `app\models\LapakLog`.
 */
class LapakLogSearch extends LapakLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['no_proposal', 'no_antar_lapak', 'no_antar_gudang', 'status', 'waktu_masuk', 'waktu_keluar', 'created', 'updated'], 'safe'],
            [['timbang_kotor_kg', 'timbang_bersih_kg', 'jml_karung_masuk', 'jml_karung_keluar'], 'number'],
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
        $query = LapakLog::find();

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
            'timbang_kotor_kg' => $this->timbang_kotor_kg,
            'timbang_bersih_kg' => $this->timbang_bersih_kg,
            'waktu_masuk' => $this->waktu_masuk,
            'waktu_keluar' => $this->waktu_keluar,
            'jml_karung_masuk' => $this->jml_karung_masuk,
            'jml_karung_keluar' => $this->jml_karung_keluar,
            'user_id' => $this->user_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'no_proposal', $this->no_proposal])
            ->andFilterWhere(['like', 'no_antar_lapak', $this->no_antar_lapak])
            ->andFilterWhere(['like', 'no_antar_gudang', $this->no_antar_gudang])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
