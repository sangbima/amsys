<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lahan;

/**
 * LahanSearch represents the model behind the search form about `app\models\Lahan`.
 */
class LahanSearch extends Lahan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['lokasi_kode', 'petani_id', 'keterangan', 'user_id', 'created', 'updated', 'status'], 'safe'],
            [['luas_m2', 'latitude', 'longitude'], 'number'],
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
        // $query = Lahan::find();
        if(Yii::$app->user->id == 1) {
          $query = Lahan::find();
        } else {
          $query = Lahan::find()->where(['lahan.user_id' => Yii::$app->user->id]);
        }

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

        $query->joinWith('petani');
        $query->joinWith('lokasiKode');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'luas_m2' => $this->luas_m2,
            'lahan.status' => $this->status,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'petani.nama', $this->petani_id])
            ->andFilterWhere(['like', 'lokasi.nama', $this->lokasi_kode]);

        return $dataProvider;
    }
}
