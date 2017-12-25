<?php

namespace backend\models\master;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\master\TbFormulirPendaftaran;

/**
 * TbFormulirPendaftaranSearch represents the model behind the search form about `backend\models\master\TbFormulirPendaftaran`.
 */
class TbFormulirPendaftaranSearch extends TbFormulirPendaftaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'jenis_zakat_id', 'umur', 'jk', 'tgl_lahir', 'status_formulir'], 'integer'],
            [['nomor', 'nama', 'alamat', 'agama', 'pekerjaan', 'no_hp', 'upload_surat_permohonan', 'upload_ktp', 'upload_kk', 'upload_surat_keterangan_tidak_mampu'], 'safe'],
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
    public $all = false;
    public $status_view = [0,1,2];
    public function search($params)
    {
        $query = TbFormulirPendaftaran::find();

        if(!$this->all){
            $query->where(['status_formulir'=> null]);
            $query->orWhere(['status_formulir'=>$this->status_view]);
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            //return $dataProvider;
        }

        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'jenis_zakat_id' => $this->jenis_zakat_id,
            'umur' => $this->umur,
            'jk' => $this->jk,
            'tgl_lahir' => $this->tgl_lahir,
            'status_formulir' => $this->status_formulir,
        ]);
        
        

        $query->andFilterWhere(['like', 'nomor', $this->nomor])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'agama', $this->agama])
            ->andFilterWhere(['like', 'pekerjaan', $this->pekerjaan])
            ->andFilterWhere(['like', 'no_hp', $this->no_hp])
            ->andFilterWhere(['like', 'upload_surat_permohonan', $this->upload_surat_permohonan])
            ->andFilterWhere(['like', 'upload_ktp', $this->upload_ktp])
            ->andFilterWhere(['like', 'upload_kk', $this->upload_kk])
            ->andFilterWhere(['like', 'upload_surat_keterangan_tidak_mampu', $this->upload_surat_keterangan_tidak_mampu]);

        return $dataProvider;
    }
}
