<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AngkutGudang;

/**
 * AngkutGudangSearch represents the model behind the search form about `app\models\AngkutGudang`.
 */
class AngkutGudangSearch extends AngkutGudang
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'armada_id', 'sopir_id', 'lapak_log_id', 'gudang_id', 'petugas_lapak', 'petugas_gudang', 'user_id'], 'integer'],
            [['no_surat', 'no_proposal', 'waktu_rencana', 'waktu_realisasi', 'status', 'created', 'updated'], 'safe'],
            [['bobot_angkut_kg', 'jml_karung_angkut', 'bobot_serah_kg', 'jml_karung_serah'], 'number'],
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
        $query = AngkutGudang::find();

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
            'armada_id' => $this->armada_id,
            'sopir_id' => $this->sopir_id,
            'lapak_log_id' => $this->lapak_log_id,
            'gudang_id' => $this->gudang_id,
            'waktu_rencana' => $this->waktu_rencana,
            'waktu_realisasi' => $this->waktu_realisasi,
            'petugas_lapak' => $this->petugas_lapak,
            'bobot_angkut_kg' => $this->bobot_angkut_kg,
            'jml_karung_angkut' => $this->jml_karung_angkut,
            'petugas_gudang' => $this->petugas_gudang,
            'bobot_serah_kg' => $this->bobot_serah_kg,
            'jml_karung_serah' => $this->jml_karung_serah,
            'user_id' => $this->user_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'no_surat', $this->no_surat])
            ->andFilterWhere(['like', 'no_proposal', $this->no_proposal])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
