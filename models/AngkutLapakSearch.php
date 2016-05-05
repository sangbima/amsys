<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AngkutLapak;

/**
 * AngkutLapakSearch represents the model behind the search form about `app\models\AngkutLapak`.
 */
class AngkutLapakSearch extends AngkutLapak
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'armada_id', 'sopir_id', 'produksi_id', 'lapak_id', 'diterima_oleh', 'user_id'], 'integer'],
            [['no_surat', 'no_proposal', 'waktu_rencana', 'waktu_realisasi', 'status', 'diterima_pada', 'created', 'updated'], 'safe'],
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
        $query = AngkutLapak::find();

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
            'produksi_id' => $this->produksi_id,
            'lapak_id' => $this->lapak_id,
            'waktu_rencana' => $this->waktu_rencana,
            'waktu_realisasi' => $this->waktu_realisasi,
            'diterima_oleh' => $this->diterima_oleh,
            'diterima_pada' => $this->diterima_pada,
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
