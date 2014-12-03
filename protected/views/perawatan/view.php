<?php
/* @var $this PerawatanController */
/* @var $model Perawatan */

$this->breadcrumbs=array(
	'Perawatan'=>array('index'),
	$model->id_perawatan,
);

$this->menu=array(
	array('label'=>'Data Perawatan', 'url'=>array('index')),
	array('label'=>'Tambah Perawatan', 'url'=>array('create')),
	array('label'=>'Edit Perawatan', 'url'=>array('update', 'id'=>$model->id_perawatan)),
	array('label'=>'Hapus Perawatan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_perawatan),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h3>View Perawatan #<?php echo $model->id_perawatan; ?></h3>

<div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">
</div>
</div>
<div class="portlet-content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_perawatan',
		'nama_perawatan',
		'harga',
		'diskon_member',
		'diskon_umum',
		'komisi_dokter',
		'komisi_perawat',
		'created_at',
		'updated_at',
	),
)); ?>

</div>
</div>
