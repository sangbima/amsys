<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Produksi;

/**
 * ProduksiSearch represents the model behind the search form about `app\models\Produksi`.
 */
class ProduksiSearch extends Produksi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['lahan_id', 'komoditas_kode', 'tgl_tanam', 'tgl_panen', 'created', 'updated', 'status', 'keterangan', 'no_proposal'], 'safe'],
            [['est_bobot_panen', 'harga_panen', 'bobot_panen_kotor', 'latitude', 'longitude'], 'number'],
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
        if(Yii::$app->user->id == 1) {
          $query = Produksi::find();
        } else {
          $query = Produksi::find()->where(['produksi.user_id' => Yii::$app->user->id]);
        }

        // $query = Produksi::find()->where(['produksi.user_id' => $userid]);

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

        $query->joinWith(['komoditasKode', 'lahan.petani']);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'tgl_tanam' => $this->tgl_tanam,
            // 'tgl_panen' => $this->tgl_panen,
            'est_bobot_panen' => $this->est_bobot_panen,
            'harga_panen' => $this->harga_panen,
            'bobot_panen_kotor' => $this->bobot_panen_kotor,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'created' => $this->updated,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'komoditas.nama', $this->komoditas_kode])
              ->andFilterWhere(['like', 'petani.nama', $this->lahan_id])
              ->andFilterWhere(['like', 'tgl_tanam', $this->tgl_tanam])
              ->andFilterWhere(['like', 'tgl_panen', $this->tgl_panen])
              ->andFilterWhere(['like', 'no_proposal', $this->no_proposal]);

        return $dataProvider;
    }
}
