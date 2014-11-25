<?php
/* @var $this PasienController */
/* @var $model Pasien */

$this->breadcrumbs=array(
	'Pasien'=>array('index'),
	$model->id_pasien,
);

$this->menu=array(
	array('label'=>'Data Pasien', 'url'=>array('index')),
	array('label'=>'Tambah Pasien', 'url'=>array('create')),
	array('label'=>'Edit Pasien', 'url'=>array('update', 'id'=>$model->id_pasien)),
	array('label'=>'Hapus Pasien', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_pasien),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h3>View Pasien #<?php echo $model->id_pasien; ?></h3>

<div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">
</div>
</div>
<div class="portlet-content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_pasien',
		'nama',
		'alamat',
		'tempat_tanggal_lahir',
		'no_telepon',
		'created_at',
	),
)); ?>

</div>
</div>
