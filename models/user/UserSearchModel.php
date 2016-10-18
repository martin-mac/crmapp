<?php

namespace app\models\user;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\user\UserRecord;

/**
 * UserSearchModel represents the model behind the search form about `app\models\user\UserRecord`.
 */
class UserSearchModel extends UserRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['username','first_name','last_name','type'], 'safe'],
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
        $query = UserRecord::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('authoritation');
        
		$dataProvider->sort->attributes['type'] = [
            'asc' => ['auth_assignment.item_name' => SORT_ASC],
            'desc' => ['auth_assignment.item_name' => SORT_DESC],
        ];
		
		if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
		
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username]);
        $query->andFilterWhere(['like', 'first_name', $this->first_name]);
        $query->andFilterWhere(['like', 'last_name', $this->last_name]);
        $query->andFilterWhere(['like', 'auth_assignment.item_name', $this->type]);

        return $dataProvider;
    }
}
