<?php
/* @var $this History_pasienController */
/* @var $model MasterTransaksi */

$this->breadcrumbs=array(
	'Master Transaksi'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Data Transaksi', 'url'=>array('index')),
	array('label'=>'Tambah Transaksi', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#master-transaksi-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Data Master Transaksi</h3>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search_pasien',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">
<?php 
	echo CHtml::link('<i class=\'icon icon-white icon-search\'></i> Advanced Search','#',array('class'=>'search-button btn btn-sm btn-primary'));
?></div>
</div>
<div class="portlet-content">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'master-transaksi-grid',
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'dataProvider'=>$model->search_pasien($id),
   'template'=>'{items}{pager}<br>{summary}',
	'columns'=>array(
	     array(
	      'header'=>'No',
	      'type'=>'raw',
	      'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
	      ),
		'Pasien.nama',
		'created_at',
		'total_bayar',
		'status_pembayaran',
		array(
			'class' => 'CButtonColumn',
			'template' => ' {cetak}',
			  'buttons'=>array
			    (
			        'cetak' => array
			        (
			            'url'=>'Yii::app()->createUrl("history_pasien/cetak", array("id"=>$data["id_master_transaksi"]))',
			        ),
			    ),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

</div></div>
