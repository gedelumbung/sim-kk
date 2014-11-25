<?php
/* @var $this PengaturanController */
/* @var $model Pengaturan */

$this->breadcrumbs=array(
	'Pengaturan'=>array('index'),
	$model->title=>array('view','id'=>$model->id_pengaturan),
	'Update',
);

$this->menu=array(
	array('label'=>'Data Pengaturan', 'url'=>array('index')),
	array('label'=>'Detail Pengaturan', 'url'=>array('view', 'id'=>$model->id_pengaturan)),
);
?>

<h3>Update Pengaturan <?php echo $model->id_pengaturan; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>