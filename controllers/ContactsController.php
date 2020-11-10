<?php

namespace app\controllers;

use app\models\Contact;
use app\models\PrivateContact;
use app\models\search\ContactsSearch;
use Exception;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ContactsController implements the CRUD actions for Contact model.
 */
class ContactsController extends Controller
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
        $searchModel = new ContactsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Pharmacy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contact();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                $model->save();
                return $this->redirect(['index']);
            } catch (Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pharmacy model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                $model->save();
                Yii::$app->session->setFlash('success', 'Контакт успешно обновлён.');
            } catch (Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Courier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionAdd($id)
    {
        try {
            $model = new PrivateContact();
            $model->contact_id = $id;
            $model->user_id = Yii::$app->user->getId();
            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Контакт успешно добавлен в личный список.');
            }
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['contacts/index']);
    }

    /**
     * Finds the PrivateContact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Этот контакт не существует.');
    }
}
