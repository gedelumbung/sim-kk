<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Pengguna'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Data Pengguna', 'url'=>array('index')),
	array('label'=>'Tambah Pengguna', 'url'=>array('create')),
	array('label'=>'Edit Pengguna', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Hapus Pengguna', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h3>Detail Pengguna #<?php echo $model->id; ?></h3>

<div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">
</div>
</div>
<div class="portlet-content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'nama',
		'email',
		'status',
		'telepon',
	),
)); ?>

</div>
</div>
