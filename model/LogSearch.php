<?php

namespace vendor\dmsylvio\actionlog\model;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use vendor\dmsylvio\actionlog\model\Log;


/**
 * LogSearch represents the model behind the search form of `app\models\Log`.
 */
class LogSearch extends Log
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_sistema', 'id_user'], 'integer'],
            [['date', 'log'], 'safe'],
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Log::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_DESC
                ]
            ],
        ]);

        $this->load($params);

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_sistema' => $this->id_sistema,
            'id_user' => $this->id_user,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['ilike', 'log', $this->log]);

        return $dataProvider;
    }
}
