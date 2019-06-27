<?php

namespace vendor\dmsylvio\actionlog\model;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "logs".
 *
 * @property int $id
 * @property int $id_sistema
 * @property int $id_user
 * @property string $date
 * @property string $log
 *
 * @property Sistema $sistema
 * @property User $user
 */
class Log extends ActiveRecord{

    /**
     * {@inheritdoc}
     */
    public static function tableName(){

        return '{{logs}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors(){

        return [
            'timestamp' =>[
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'date',
                ],
                'value' => new Expression('NOW()'),
            ]
        ];
    }

     /**
    * Adds a message to Log model
    *
    * @param mixed $message The log message
    * @param int $uID The user id
    */
    public static function add($message = null, $uID = 0){

        $model = Yii::createObject(__CLASS__);
        $model->id_sistema = (int)$model->getSystemID();
        $model->id_user = ((int)$uID !== 0) ? (int)$uID : (int)$model->getUserID();
        $model->log = ($message !== null) ? serialize($message) : serialize($model->getCurrentAction());
        
        return $model->save();
    }

    /**
    * Get the current user ID
    *
    * @return int The user ID
    */
    public static function getUserID(){
        
        $user = Yii::$app->getUser();
        return $user && !$user->getIsGuest() ? $user->getId() : 0;
    }

    /**
     * Get the current System ID
     * 
     * @return int The System ID
     */
    public static function getSystemID(){

        if (!empty(Yii::$app->params['systemId'])) {

            $sistemid = Yii::$app->params['systemId'];
            return $sistemid;
        }

        return NULL;
    }

    public static function getCurrentAction(){

        $action = Yii::$app->requestedAction->id; // Exemplo (update)
        $controller = Yii::$app->requestedAction->controller->id; // Exemplo (BensController) => [bens]
        $objeto = Yii::$app->request->get('id'); // Exemplo 26512 (id que foi manipulado)

        return $action. ' - '.$controller.' - '.$objeto;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '#'),
            'id_sistema' => Yii::t('app', 'Sistema'),
            'id_user' => Yii::t('app', 'Usuário'),
            'date' => Yii::t('app', 'Data'),
            'log' => Yii::t('app', 'Log'),
        ];
    }

        /**
     * @return \yii\db\ActiveQuery
     */
    public function getSistema()
    {
        return $this->hasOne(Sistema::className(), ['id' => 'id_sistema']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}