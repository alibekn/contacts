<?php

namespace app\controllers;

use app\models\PrivateContact;
use app\models\search\PrivateContactsSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PrivateContactsController implements the CRUD actions for Contact model.
 */
class PrivateContactsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ],
        ];
    }

    /**
     * Lists all Pharmacy models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrivateContactsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['private-contacts/index']);
    }

    /**
     * Finds the PrivateContact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PrivateContact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PrivateContact::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Этот контакт не существует.');
    }
}
