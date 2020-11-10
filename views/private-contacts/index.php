<?php

use app\models\Contact;
use app\models\PrivateContact;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PrivateContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Личные контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
                'value' => function (PrivateContact $model) {
                    return $model->contact->getFullName();
                }

            ],
            [
                'attribute' => 'phone',
                'label' => 'Телефон',
                'value' => function (PrivateContact $model) {
                    return $model->contact->phone;
                }

            ],
            [
                'attribute' => 'email',
                'label' => 'Email',
                'value' => function (PrivateContact $model) {
                    return $model->contact->email;
                }

            ],
            [
                'attribute' => 'status',
                'label' => 'Статус',
                'value' => function (PrivateContact $model) {
                    return $model->contact->getStatusLabel();
                },
                'filter' => Contact::getStatuses()

            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}'
            ],
        ],
    ]); ?>


</div>