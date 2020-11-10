<?php

namespace app\models\search;

use app\models\Contact;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ContactsSearch represents the model behind the search form of `app\models\Contact`.
 */
class ContactsSearch extends Model
{
    public $full_name;
    public $phone;
    public $email;
    public $status;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['email', 'phone', 'full_name'], 'safe'],
        ];
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
        $query = Contact::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC],
                'attributes' => [
                    'created_at',
                    'phone',
                    'email',
                    'status',
                    'full_name' => [
                        'asc' => ['first_name' => SORT_ASC, 'last_name' => SORT_ASC],
                        'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
                        'label' => 'Full Name',
                        'default' => SORT_ASC
                    ],
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
            'status' => $this->status,
        ]);


        $query->andWhere('first_name LIKE "%' . $this->full_name . '%" ' .
            'OR last_name LIKE "%' . $this->full_name . '%" '.
            'OR CONCAT(first_name, " ", last_name) LIKE "%' . $this->full_name . '%"'
        );

        $query->andFilterWhere(['like', 'phone', $this->phone]);
        $query->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
