<?php 

namespace vendor\dmsylvio\actionlog\controllers;

use Yii;
use vendor\dmsylvio\actionlog\model\Log;
use vendor\dmsylvio\actionlog\model\LogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

/**
 * LogController implements the CRUD actions for Log model.
 */

class LogController extends Controller{

    public function behaviors(){

        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Log models.
     * @return mixed
     */
    public function actionIndex(){

        $searchModel = new LogSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        if (!is_null($this->getSystemID())){
            $dataProvider->query->andWhere("id_sistema = '".$this->getSystemID()."'");
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Log model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id){

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Log model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Log the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){

        if (($model = Log::findOne($id)) != null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * Função responsável pela query do sistema
     * @return $systemid |null
     */
    public function getSystemID(){

        // salva na variável $systemid o id do sistema
        // o id do sistema deve ser definido em config/params.php
        $systemid = Yii::$app->params['systemId'];

        if(!empty($systemid)){

            return $systemid;
        }
        return null;
    }
}
