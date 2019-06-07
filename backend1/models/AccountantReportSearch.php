<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AccountantReport;

/**
 * AccountantReportSearch represents the model behind the search form of `backend\models\AccountantReport`.
 */
class AccountantReportSearch extends AccountantReport
{

    public $date_from;
    public $date_to;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'report_status'], 'integer'],
            [['collected_amount', 'submitted_amount', 'difference'], 'number'],
            [['collected_date', 'created_at', 'created_by', 'updated_at', 'updated_by', 'receipt_no', 'uploaded_receipt','date_from','date_to'], 'safe'],
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
        $query = AccountantReport::find();

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
            'collected_amount' => $this->collected_amount,
            'submitted_amount' => $this->submitted_amount,
            'difference' => $this->difference,
            'collected_date' => $this->collected_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'report_status' => $this->report_status,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'receipt_no', $this->receipt_no])
            ->andFilterWhere(['between', 'DATE_FORMAT(collected_date, "%Y-%m-%d")', $this->date_from, $this->date_to])
            ->andFilterWhere(['between', 'DATE_FORMAT(updated_at, "%Y-%m-%d")', $this->date_from, $this->date_to])
            ->andFilterWhere(['like', 'uploaded_receipt', $this->uploaded_receipt]);

        return $dataProvider;
    }


    public function searchGvt($params)
    {
        $query = AccountantReport::find();

        // add conditions that should always apply here
        $query->where(['report_status'=>SupervisorDeni::CLOSED]);

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
            'collected_amount' => $this->collected_amount,
            'submitted_amount' => $this->submitted_amount,
            'difference' => $this->difference,
            'collected_date' => $this->collected_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'report_status' => $this->report_status,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'receipt_no', $this->receipt_no])
            ->andFilterWhere(['between', 'DATE_FORMAT(updated_at, "%Y-%m-%d")', $this->date_from, $this->date_to])
            ->andFilterWhere(['like', 'uploaded_receipt', $this->uploaded_receipt]);

        return $dataProvider;
    }

}
