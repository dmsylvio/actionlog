<?php

namespace vendor\dmsylvio\actionlog\behaviors;

use Yii;
use yii\db\ActiveRecord;
use yii\base\Behavior;
use vendor\dmsylvio\actionlog\model\Log;


/**
 * To use ActionLogBehavior, simply insert the following code to your ActiveRecord class:
 *
 * use vendor\dmsylvio\actionlog\behaviors\ActionLogBehavior;
 *
 * ```php
 * public function behaviors()
 * {
 *     return [
 *          'actionlog' => [
 *              'class' => ActionLogBehavior::class,
 *          ],
 *     ];
 * }
 * ```
 */

class ActionLogBehavior extends Behavior{

    /**
    * @var string The message of current action
    */
    public $message = null;

     /**
     * @inheritdoc
     */
    public function events(){

        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
            ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
            //ActiveRecord::EVENT_AFTER_FIND => 'afterFind',
        ];
    }

    public function beforeInsert($event){
        Log::add();
    }

    public function beforeUpdate($event){
        Log::add();
    }

    public function beforeDelete($event){
        Log::add();
    }

    public function afterFind($event){
        Log::add();
    }
}
