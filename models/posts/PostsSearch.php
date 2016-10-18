<?php

namespace app\models\posts;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\posts\Posts;

/**
 * PostsSearch represents the model behind the search form about `app\models\posts\Posts`.
 */
class PostsSearch extends Posts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id'], 'integer'],
            [['post_title', 'post_description','author_id'], 'safe'],
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
        $query = Posts::find();

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
        $query->joinWith('author');
        // grid filtering conditions
        $query->andFilterWhere([
            'post_id' => $this->post_id,
            //'author_id' => $this->author_id,
        ]);

        $query->andFilterWhere(['like', 'post_title', $this->post_title])
            ->andFilterWhere(['like', 'post_description', $this->post_description])
            ->andFilterWhere(['like', 'user.first_name', $this->author_id]);

        return $dataProvider;
    }
}
