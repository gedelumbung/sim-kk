<?php
/* @var $this PengaturanController */
/* @var $model Pengaturan */

$this->breadcrumbs=array(
	'Pengaturan'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Data Pengaturan', 'url'=>array('index')),
	array('label'=>'Edit Pengaturan', 'url'=>array('update', 'id'=>$model->id_pengaturan)),
);
?>

<h3>View Pengaturan #<?php echo $model->id_pengaturan; ?></h3>

<div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">
</div>
</div>
<div class="portlet-content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_pengaturan',
		'type',
		'title',
		'content',
	),
)); ?>

</div>
</div>
