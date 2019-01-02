<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AlatKelengkapanSearch represents the model behind the search form of `app\models\AlatKelengkapan`.
 */
class AlatKelengkapanSearch extends AlatKelengkapan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_alat_kelengkapan', 'tahun'], 'integer'],
            [['alat_kelengkapan'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AlatKelengkapan::find();

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

        if ($this->tahun == '') {
            $this->tahun = date('Y');
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id_alat_kelengkapan' => $this->id_alat_kelengkapan,
            'tahun' => $this->tahun,
        ]);

        $query->andFilterWhere(['like', 'alat_kelengkapan', $this->alat_kelengkapan]);

        return $dataProvider;
    }
}
