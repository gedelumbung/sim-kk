<?php
/* @var $this PengeluaranController */
/* @var $model Pengeluaran */

$this->breadcrumbs=array(
	'Pengeluaran'=>array('index'),
	$model->id_pengeluaran,
);

$this->menu=array(
	array('label'=>'Data Pengeluaran', 'url'=>array('index')),
	array('label'=>'Tambah Pengeluaran', 'url'=>array('create')),
	array('label'=>'Edit Pengeluaran', 'url'=>array('update', 'id'=>$model->id_pengeluaran)),
	array('label'=>'Hapus Pengeluaran', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_pengeluaran),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h3>View Pengeluaran #<?php echo $model->id_pengeluaran; ?></h3>

<div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">
</div>
</div>
<div class="portlet-content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_pengeluaran',
		'pengeluaran',
		'jumlah',
		'total',
		'created_at',
	),
)); ?>

</div>
</div>
