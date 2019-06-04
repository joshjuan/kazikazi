<?php

namespace backend\models;

use backend\models\TicketTransaction;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * TicketTransactionSearch represents the model behind the search form of `backend\models\TicketTransaction`.
 */
class TicketReprintedSearch extends TicketTransaction
{
    public $date_from;
    public $date_to;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'region', 'district', 'municipal', 'street', 'work_area', 'receipt_no', 'user','report_no'], 'integer'],
            [['ref_no', 'date_from', 'date_to', 'begin_time', 'end_time', 'car_no', 'status', 'create_at', 'created_by'], 'safe'],
            [['amount'], 'number'],
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
        $query = TicketReprinted::find();
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 250
            ],
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
            'begin_time' => $this->begin_time,
            'end_time' => $this->end_time,
            'region' => $this->region,
            'district' => $this->district,
            'municipal' => $this->municipal,
            'street' => $this->street,
            'work_area' => $this->work_area,
            'receipt_no' => $this->receipt_no,
            'amount' => $this->amount,
            'user' => $this->user,
            'report_no' => $this->report_no,
            'create_at' => $this->create_at,
        ]);

        $query->andFilterWhere(['like', 'ref_no', $this->ref_no])
            ->andFilterWhere(['like', 'car_no', $this->car_no])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['between', 'DATE_FORMAT(create_at, "%Y-%m-%d")', $this->date_from, $this->date_to])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }

    public function searchDateRange($params)
    {
        $query = TicketReprinted::find();
        $query->select(['region,district,municipal,street,work_area,sum(amount) amount'])
            //  ->groupBy(['user'])
            ->groupBy(['region'])
            ->groupBy(['district'])
            ->groupBy(['municipal'])
            ->groupBy(['street'])
            ->groupBy(['work_area']);


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
            'begin_time' => $this->begin_time,
            'end_time' => $this->end_time,
            'region' => $this->region,
            'district' => $this->district,
            'municipal' => $this->municipal,
            'street' => $this->street,
            'work_area' => $this->work_area,
            'receipt_no' => $this->receipt_no,
            'amount' => $this->amount,
            'user' => $this->user,
            'create_at' => $this->create_at,
        ]);

        $query->andFilterWhere(['like', 'ref_no', $this->ref_no])
            ->andFilterWhere(['like', 'car_no', $this->car_no])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['between', 'DATE_FORMAT(create_at, "%Y-%m-%d")', $this->date_from, $this->date_to])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }

    public function searchClerk($params)
    {
        $query = TicketReprinted::find();
        $query->select(['user,sum(amount) amount'])
            ->groupBy(['user']);


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
            'begin_time' => $this->begin_time,
            'end_time' => $this->end_time,
            'region' => $this->region,
            'district' => $this->district,
            'municipal' => $this->municipal,
            'street' => $this->street,
            'work_area' => $this->work_area,
            'receipt_no' => $this->receipt_no,
            'amount' => $this->amount,
            'user' => $this->user,
            'create_at' => $this->create_at,
        ]);

        $query->andFilterWhere(['like', 'ref_no', $this->ref_no])
            ->andFilterWhere(['like', 'car_no', $this->car_no])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['between', 'DATE_FORMAT(create_at, "%Y-%m-%d")', $this->date_from, $this->date_to])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }


    public function Chart()
    {
        $query = TicketReprinted::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $pagination = false;
        $current_day = date("Y-m-d");
        $query->select(['municipal, sum(amount) as  amount'])->where(['date(create_at)' => $current_day])->groupBy(['municipal'])->all();

        return $dataProvider;

    }
}
