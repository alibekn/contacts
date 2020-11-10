<?php

namespace app\models\search;

use app\models\Contact;
use app\models\PrivateContact;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PrivateContactsSearch represents the model behind the search form of `app\models\PrivateContact`.
 */
class PrivateContactsSearch extends Model
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
        $query = PrivateContact::find()
            ->alias('t1')
            ->joinWith('contact t2')
            ->andWhere(['t1.user_id' => Yii::$app->user->getId()]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['t1.created_at' => SORT_DESC],
                'attributes' => [
                    't1.created_at',
                    'contact_id',
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
            't2.status' => $this->status,
        ]);


        $query->andWhere('t2.first_name LIKE "%' . $this->full_name . '%" ' .
            'OR t2.last_name LIKE "%' . $this->full_name . '%" '.
            'OR CONCAT(t2.first_name, " ", t2.last_name) LIKE "%' . $this->full_name . '%"'
        );

        $query->andFilterWhere(['like', 't2.phone', $this->phone]);
        $query->andFilterWhere(['like', 't2.email', $this->email]);

        return $dataProvider;
    }
}
