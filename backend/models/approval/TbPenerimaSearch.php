<?php

namespace backend\models\approval;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\approval\TbPenerima;
use backend\models\master\TbFormulirPendaftaran;

/**
 * TbPenerimaSearch represents the model behind the search form about `backend\models\approval\TbPenerima`.
 */
class TbPenerimaSearch extends TbPenerima
{
    public $nomor;
    public $nama;
    public $no_hp;
    public $jenis_zakat;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'formulir_pendaftaran_id', 'pernyataan_survey_id'], 'integer'],
            [['jumlah_zakat', 'desc','nomor','nama','no_hp','jenis_zakat'], 'safe'],
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
        $query = TbPenerima::find()->joinWith(['formulirPendaftaran']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['nomor'] = [
            'asc'  => ['tb_formulir_pendaftaran.nomor' => SORT_ASC],
            'desc' => ['tb_formulir_pendaftaran.nomor' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['nama'] = [
            'asc'  => ['tb_formulir_pendaftaran.nama' => SORT_ASC],
            'desc' => ['tb_formulir_pendaftaran.nama' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['no_hp'] = [
            'asc'  => ['tb_formulir_pendaftaran.no_hp' => SORT_ASC],
            'desc' => ['tb_formulir_pendaftaran.no_hp' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['jenis_zakat'] = [
            'asc'  => ['tb_formulir_pendaftaran.jenis_zakat_id' => SORT_ASC],
            'desc' => ['tb_formulir_pendaftaran.jenis_zakat_id' => SORT_DESC],
        ];
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            //return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'formulir_pendaftaran_id' => $this->formulir_pendaftaran_id,
            'pernyataan_survey_id' => $this->pernyataan_survey_id,
        ]);

        $query->andFilterWhere(['like', 'jumlah_zakat', $this->jumlah_zakat])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        if($this->nomor != null){
            $qry_to = TbFormulirPendaftaran::find();
            $qry_to->select(['id']);
            $qry_to->andFilterWhere(['like', 'lower(nomor)', strtolower($this->nomor)]);
            $query->andWhere(['in', 'formulir_pendaftaran_id', $qry_to->column()]);
        }
        
        if($this->nama != null){
            $qry_to = TbFormulirPendaftaran::find();
            $qry_to->select(['id']);
            $qry_to->andFilterWhere(['like', 'lower(nama)', strtolower($this->nama)]);
            $query->andWhere(['in', 'formulir_pendaftaran_id', $qry_to->column()]);
        }
        
        if($this->no_hp != null){
            $qry_to = TbFormulirPendaftaran::find();
            $qry_to->select(['id']);
            $qry_to->andFilterWhere(['like', 'lower(no_hp)', strtolower($this->no_hp)]);
            $query->andWhere(['in', 'formulir_pendaftaran_id', $qry_to->column()]);
        }
        
        if($this->jenis_zakat != null){
            $qry_to = TbFormulirPendaftaran::find();
            $qry_to->select(['id']);
            $qry_to->andFilterWhere(['jenis_zakat_id'=>$this->jenis_zakat]);
            $query->andWhere(['in', 'formulir_pendaftaran_id', $qry_to->column()]);
        }
        
        return $dataProvider;
    }
}
