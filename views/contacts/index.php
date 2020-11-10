<?php

use app\models\Contact;
use app\models\PrivateContact;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контакты';
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать контакт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class'=>'table table-striped table-bordered'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'full_name',
                'label' => 'Полное имя',
                'format' => 'raw',
                'value' => function (Contact $model) {
                    return $model->getFullName();
                }

            ],
            [
                'attribute' => 'phone',
                'label' => 'Телефон',
                'value' => function (Contact $model) {
                    return $model->phone;
                }

            ],
            [
                'attribute' => 'email',
                'label' => 'Email',
                'value' => function (Contact $model) {
                    return $model->email;
                }

            ],
            [
                'attribute' => 'status',
                'label' => 'Статус',
                'value' => function (Contact $model) {
                    return $model->getStatusLabel();
                },
                'filter' => Contact::getStatuses()

            ],

            [
                'attribute' => 'Add',
                'label' => 'Личные',
                'format' => 'raw',
                'value' => function (Contact $model) {
                    $private_contact = PrivateContact::find()->andWhere(['contact_id' => $model->id, 'user_id' => Yii::$app->user->identity->getId()])->one();
                    if ($private_contact) {
                        return Html::tag('span', '', ['class' => "glyphicon glyphicon-ok"]);
                    } else {
                        return Html::a(Html::tag('span', '', ['class' => "glyphicon glyphicon-plus"]), ['add', 'id' => $model->id]);
                    }

                },
                'filter' => Contact::getStatuses()

            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}'
            ],
        ],
    ]); ?>


</div>