<?php
/* @var $this DokterController */
/* @var $model Dokter */

$this->breadcrumbs=array(
	'Dokter'=>array('index'),
	$model->id_dokter,
);

$this->menu=array(
	array('label'=>'Data Dokter', 'url'=>array('index')),
	array('label'=>'Tambah Dokter', 'url'=>array('create')),
	array('label'=>'Edit Dokter', 'url'=>array('update', 'id'=>$model->id_dokter)),
	array('label'=>'Hapus Dokter', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_dokter),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h3>View Dokter #<?php echo $model->id_dokter; ?></h3>

<div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">
<?php 
</div>
</div>
<div class="portlet-content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_dokter',
		'nama',
		'tempat_tanggal_lahir',
		'alamat',
		'no_telepon',
		'spesialis',
		'created_at',
	),
)); ?>

</div>
</div>
