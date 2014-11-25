<?php
/* @var $this PengaturanController */
/* @var $model Pengaturan */

$this->breadcrumbs=array(
	'Pengaturan'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Data Pengaturan', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pengaturan-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Data Pengaturan</h3>

<div class="portlet">
<div class="portlet-decoration">
<div class="portlet-content">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pengaturan-grid',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'dataProvider'=>$model->search(),
   'template'=>'{items}{pager}<br>{summary}',
	'columns'=>array(
	     array(
	      'header'=>'No',
	      'type'=>'raw',
	      'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
	      ),
		'type',
		'title',
		'content',
		array(
			'class' => 'CButtonColumn',
			'template' => '{Edit}',
			  'buttons'=>array
			    (
			        'Edit' => array
			        (
			            'url'=>'Yii::app()->createUrl("pengaturan/update", array("id"=>$data["id_pengaturan"]))',
			        ),
			    ),		
		),
	),
)); ?>

</div></div>
