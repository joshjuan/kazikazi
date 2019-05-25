<?php

namespace backend\models;

use backend\models\SupervisorDeni;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * SupervisorDeniSearch represents the model behind the search form of `backend\models\SupervisorDeni`.
 */

class SupervisorDeniSearch extends SupervisorDeni
{
    public $date_from;
    public $date_to;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'integer'],
            [['collected_amount', 'submitted_amount', 'deni'], 'number'],
            [['amount_date', 'created_at', 'created_by','date_from','date_to','status'], 'safe'],
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
        $query = SupervisorDeni::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 250],
            'sort' => ['defaultOrder' => [
                'id' => SORT_DESC,
            ]
            ]
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
            'name' => $this->name,
            'collected_amount' => $this->collected_amount,
            'submitted_amount' => $this->submitted_amount,
            'deni' => $this->deni,
            'amount_date' => $this->amount_date,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['between', 'DATE_FORMAT(amount_date, "%Y-%m-%d")', $this->date_from, $this->date_to]);

        return $dataProvider;
    }
}
