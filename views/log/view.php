<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\VarDumper;

use vendor\dmsylvio\actionlog\model\Sistema;
use vendor\dmsylvio\actionlog\model\User;

/**
 * @var yii\web\View $this
 * @varapp\vendor\dmsylvio\actionlog\model\ActionLog $model
 */

$this->title = Yii::t('actionlog', 'Log {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('actionlog', 'Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="log-view box box-primary" style="padding: 15px;">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'id_sistema',
                'label' => 'Sistema',
                'value' => function($model){
                    if(isset($model->id_sistema)){
                        $sistema = Sistema::find()->where(['id' => $model->id_sistema])->one();
                        return html::encode($sistema['nome']);
                    }else{
                        return Html::encode('Not Found');
                    }
                }
            ],
            [
                'attribute' => 'id_user',
                'label' => 'Usuário',
                'value' => function($model){
                    $user = User::find()->where(['id' => $model->id_user])->one();
                    return Html::encode($user['username']);
                }
            ],
            [
                'attribute' => 'date',
                'label' => 'data', 
                'format' => ['date', 'php:d-m-Y H:i:s']
            ],
            //'log:ntext',
            [
                'attribute' => 'log',
                'visible' => ($model->log === null) ? true : false,
            ],
        ],
    ]) ?>

    <?php if ($model->log !== null) : ?>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Yii::t('actionlog', 'Log') ?></h3>
            </div>
            <div class="panel-body">
                <?php VarDumper::dump(@unserialize($model->log), 10, true); ?>
            </div>
            <ul class="list-group">
                <li class="list-group-item text-muted"><?= Html::encode($model->log); ?></li>
            </ul>
        </div>
    <?php endif; ?>
</div>