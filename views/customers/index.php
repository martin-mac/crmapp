<?php
/**
 * @var \yii\data\BaseDataProvider $records
 */
echo \yii\widgets\ListView::widget(
    [
        'options' => [
            'class' => 'list-view',
            'id' => 'search_results'
        ],
        'itemView' => '_customer',
        'dataProvider' => $records,
		/*'pager' => [
			'firstPageLabel' => 'first',
			'lastPageLabel' => 'last',
			'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
			'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
			'maxButtonCount' => 3,
		],*/
    ]
);