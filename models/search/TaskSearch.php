<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Task;

class TaskSearch extends Task
{
    public $myPageSize;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'myPageSize'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
    {
        return Model::scenarios();
    }

    /**
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $userID = Yii::$app->user->getId();
        $query = Task::find()->where(['user_id' => $userID]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $this->myPageSize,
            ],
            'sort' => [
                'defaultOrder' => [
                    'due_date' => SORT_ASC,
                    'name' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        $dataProvider->pagination->pageSize = ($this->myPageSize !== NULL) ? $this->myPageSize : 5;

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}