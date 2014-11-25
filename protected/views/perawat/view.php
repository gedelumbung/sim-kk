<?php
/* @var $this PerawatController */
/* @var $model Perawat */

$this->breadcrumbs=array(
	'Perawat'=>array('index'),
	$model->id_perawat,
);

$this->menu=array(
	array('label'=>'Data Perawat', 'url'=>array('index')),
	array('label'=>'Tambah Perawat', 'url'=>array('create')),
	array('label'=>'Edit Perawat', 'url'=>array('update', 'id'=>$model->id_perawat)),
	array('label'=>'Hapus Perawat', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_perawat),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h3>View Perawat #<?php echo $model->id_perawat; ?></h3>

<div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">
</div>
</div>
<div class="portlet-content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_perawat',
		'nama',
		'tempat_tanggal_lahir',
		'alamat',
		'no_telepon',
		'created_at',
	),
)); ?>

</div>
</div>
