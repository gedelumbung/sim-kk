<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'install-grid',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'dataProvider' => $dataProvider,
	'columns' => array(
		'name',
		'size',
		'create_time',
		array(
			'class' => 'CButtonColumn',
			'template' => ' {download} {restore}',
			  'buttons'=>array
			    (
			        'download' => array
			        (
			            'url'=>'Yii::app()->createUrl("backup/default/download", array("file"=>$data["name"]))',
			        ),
			        'restore' => array
			        (
			            'url'=>'Yii::app()->createUrl("backup/default/restore", array("file"=>$data["name"]))',
					),
			        'delete' => array
			        (
			            'url'=>'Yii::app()->createUrl("backup/default/delete", array("file"=>$data["name"]))',
			        ),
			    ),		
		),
		array(
			'class' => 'CButtonColumn',
			'template' => '{delete}',
			  'buttons'=>array
			    (

			        'delete' => array
			        (
			            'url'=>'Yii::app()->createUrl("backup/default/delete", array("file"=>$data["name"]))',
			        ),
			    ),		
		),
	),
)); ?>