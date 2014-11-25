<?php
/* @var $this PerawatController */
/* @var $model Perawat */

$this->breadcrumbs=array(
	'Perawat'=>array('index'),
	$model->id_perawat=>array('view','id'=>$model->id_perawat),
	'Update',
);

$this->menu=array(
	array('label'=>'Data Perawat', 'url'=>array('index')),
	array('label'=>'Tambah Perawat', 'url'=>array('create')),
	array('label'=>'Detail Perawat', 'url'=>array('view', 'id'=>$model->id_perawat)),
);
?>

<h3>Update Perawat <?php echo $model->id_perawat; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>