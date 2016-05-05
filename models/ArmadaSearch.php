<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Armada;

/**
 * ArmadaSearch represents the model behind the search form about `app\models\Armada`.
 */
class ArmadaSearch extends Armada
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['kode', 'no_polisi', 'created', 'updated'], 'safe'],
            [['kapasitas_mesin', 'kapasitas_angkut'], 'number'],
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
        $query = Armada::find();

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
            'kapasitas_mesin' => $this->kapasitas_mesin,
            'kapasitas_angkut' => $this->kapasitas_angkut,
            'created' => $this->created,
            'updated' => $this->updated,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'kode', $this->kode])
            ->andFilterWhere(['like', 'no_polisi', $this->no_polisi]);

        return $dataProvider;
    }
}
