<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\user\UserSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Records';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-record-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Record', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            #'id',
			'first_name',
			'last_name',
            'username',
			[
				'attribute' => 'type',
				'value' => 'authoritation.item_name'
			],

			#'password',

            ['class' => 'yii\grid\ActionColumn'],
        ],
		'pager' => [
			'firstPageLabel' => 'first',
			'lastPageLabel' => 'last',
			'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
			'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
			'maxButtonCount' => 3,
		],
    ]); ?>
</div>
