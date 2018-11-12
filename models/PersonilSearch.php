<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PersonilSearch represents the model behind the search form of `app\models\Personil`.
 */
class PersonilSearch extends Personil
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_personil', 'id_pangkat', 'setuju', 'mengetahui', 'lunas', 'tanda_tangan_surat'], 'integer'],
            [['nip', 'nama_personil', 'status_personil', 'golongan', 'status'], 'safe'],
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
        $query = Personil::find();

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
            'id_personil' => $this->id_personil,
            'id_pangkat' => $this->id_pangkat,
            'setuju' => $this->setuju,
            'mengetahui' => $this->mengetahui,
            'lunas' => $this->lunas,
            'tanda_tangan_surat' => $this->tanda_tangan_surat,
        ]);

        $query->andFilterWhere(['like', 'nip', $this->nip])
            ->andFilterWhere(['like', 'nama_personil', $this->nama_personil])
            ->andFilterWhere(['like', 'status_personil', $this->status_personil])
            ->andFilterWhere(['like', 'golongan', $this->golongan])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
