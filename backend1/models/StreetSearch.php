<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Street;

/**
 * StreetSearch represents the model behind the search form of `backend\models\Street`.
 */
class StreetSearch extends Street
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'region', 'district', 'municipal'], 'integer'],
            [['name', 'created_at', 'created_by'], 'safe'],
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
        $query = Street::find();

        // add conditions that should always apply here
     //   $query->where(['region'=>\Yii::$app->user->identity->region])
     //       ->andWhere(['district'=>\Yii::$app->user->identity->district])
      //      ->andWhere(['municipal'=>\Yii::$app->user->identity->municipal]);

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
            'region' => $this->region,
            'district' => $this->district,
            'municipal' => $this->municipal,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
