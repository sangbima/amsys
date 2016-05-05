<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lapak;

/**
 * LapakSearch represents the model behind the search form about `app\models\Lapak`.
 */
class LapakSearch extends Lapak
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['kode', 'penanggung_jawab', 'alamat', 'lokasi_kode', 'keterangan', 'created', 'updated'], 'safe'],
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
        $query = Lapak::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('lokasiKode');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created' => $this->created,
            'updated' => $this->updated,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'kode', $this->kode])
            ->andFilterWhere(['like', 'penanggung_jawab', $this->penanggung_jawab])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'lokasi.nama', $this->lokasi_kode])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
