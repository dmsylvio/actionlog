<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var vendor\dmsylvio\actionlog\model\ActionLogSearch $searchModel
 */

$this->title = Yii::t('actionlog', 'Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index box box-primary" style="padding: 15px;">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary' => '',
        'showHeader' => true,
        'showOnEmpty' => true,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'label' => '#'
            ],
            [
                'attribute' => 'id_sistema', 
                'label' => 'Sistema', 
                'value' => 'sistema.nome'
            ],
            [
                'attribute' => 'id_user',
                'label' => 'Usuário',
                'value' => 'user.username'
            ],
            [
                'attribute' => 'date',
                'label' => 'data', 
                'format' => ['date', 'php:d-m-Y H:i:s']
            ],
            [
                'attribute' => 'log',
                'label' => 'Logs',
                'value' => function($model){
                    return Html::decode(@unserialize($model->log), 10, true);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'header' => 'Opções',
                'headerOptions' => [
                    'style' => 'color: #3c8dbc'
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
