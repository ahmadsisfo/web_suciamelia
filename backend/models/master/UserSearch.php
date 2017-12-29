<?php

namespace backend\models\master;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\master\User;

/**
 * UserSearch represents the model behind the search form about `backend\models\master\user`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'no_hp','nama','auth_key', 'password_hash', 'password_reset_token', 'email'], 'safe'],
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
        $query = User::find()->with('tbAdmin');

        if (!$this->all) $query->where(['!=','status', Yii::STATUS_DELETED])->andWhere(['id'=>  TbAdmin::find()->select('user_id')->column()]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            // return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'lower(username)', strtolower($this->username)])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);
        
        if($this->no_hp != null){
            $qry_to = UserProfile::find();
            $qry_to->select(['user_id']);
            $qry_to->andFilterWhere(['like', 'lower(phone)', strtolower($this->no_hp)]);    
            $query->andFilterWhere(['in', 'id', $qry_to->column()]);
        }
        
        if($this->nama != null){
            $qry_to = UserProfile::find();
            $qry_to->select(['user_id']);
            $qry_to->andFilterWhere(['like', 'lower(nama)', strtolower($this->nama)]);    
            $query->andFilterWhere(['in', 'id', $qry_to->column()]);
        }

        return $dataProvider;
    }
}
