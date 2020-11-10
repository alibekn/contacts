<?php
namespace app\models;

use Exception;
use Yii;
use yii\base\Model;

/**
 * PrivateContactAddForm
 */
class PrivateContactAddForm extends Model
{
    public $id;


    /**
     *
     * @return bool whether the adding private contact was successful
     */
    public function add()
    {
        $model = new PrivateContact();
        $model->contact_id = $this->id;
        $model->user_id = Yii::$app->user->getId();
        if (!$model->save(false)) {
            throw new Exception('Category not saved');
        }
        return true;
    }

    public function getErrorMessage()
    {
        return $this->getErrorSummary(true)[0];
    }
}
