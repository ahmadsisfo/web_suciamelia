<?php

namespace backend\models\approval;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\approval\TbPernyataanSurvey;
use backend\models\master\TbFormulirPendaftaran;

/**
 * TbPernyataanSurveySearch represents the model behind the search form about `backend\models\approval\TbPernyataanSurvey`.
 */
class TbPernyataanSurveySearch extends TbPernyataanSurvey
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'setuju'], 'integer'],
            [['nomor', 'desc','nama','formulir_pendaftaran_id',], 'safe'],
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
    public function search($params)
    {
        $query = TbPernyataanSurvey::find();

        if(!$this->all){
            $query->where(['!=','setuju',  TbPernyataanSurvey::SURVEY_PENERIMA]);
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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'formulir_pendaftaran_id' => $this->formulir_pendaftaran_id,
            'setuju' => $this->setuju,
        ]);

        $query->andFilterWhere(['like', 'nomor', $this->nomor])
              ->andFilterWhere(['like', 'desc', $this->desc]);
        
        if($this->formulir_pendaftaran_id != null){
            $qry_to = TbFormulirPendaftaran::find();
            $qry_to->select(['id']);
            $qry_to->andFilterWhere(['like', 'lower(nama)', strtolower($this->formulir_pendaftaran_id)]);
            $query->andFilterWhere(['in', 'formulir_pendaftaran_id', $qry_to->column()]);
        }

        return $dataProvider;
    }
}
