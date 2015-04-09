<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Nodes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="node-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Node'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type_content',
            'node_parent_id',
            'title',
            'alias',
            // 'description:ntext',
            // 'body:ntext',
            // 'enable',
            // 'create',
            // 'update',
            // 'lang',
            // 'file',
            // 'priority',
            // 'link',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
