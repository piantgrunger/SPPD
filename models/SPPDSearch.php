<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SuratPerintahTugasSearch represents the model behind the search form of `app\models\SuratPerintahTugas`.
 */
class SPPDSearch extends SuratPerintahTugas
{
    public $tgl_aw;
    public $tgl_ak;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_spt', 'id_alat_kelengkapan'], 'integer'],
            [['no_spt', 'tgl_surat', 'untuk', 'tujuan', 'zona', 'tgl_awal', 'tgl_akhir', 'penanda_tangan', 'tgl_aw', 'tgl_ak'], 'safe'],
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
    public function search($params, $SPPD = 0)
    {
        $query = SuratPerintahTugas::find();

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
            'id_spt' => $this->id_spt,
            'tgl_surat' => $this->tgl_surat,
            'id_alat_kelengkapan' => $this->id_alat_kelengkapan,
            'tgl_awal' => $this->tgl_awal,
            'tgl_akhir' => $this->tgl_akhir,
        ]);

        $query->andFilterWhere(['like', 'no_spt', $this->no_spt])
            ->andFilterWhere(['like', 'untuk', $this->untuk])
            ->andFilterWhere(['like', 'tujuan', $this->tujuan])
            ->andFilterWhere(['like', 'zona', $this->zona])
            ->andFilterWhere(['like', 'penanda_tangan', $this->penanda_tangan]);
        if ($SPPD === 0) {
            $query->andWhere('id_kegiatan is null');
        } else {
            $query->andWhere('id_kegiatan is not null');
        }

        $query->andFilterWhere(['between', 'tgl_surat', $this->tgl_aw, $this->tgl_ak]);

        return $dataProvider;
    }
}
