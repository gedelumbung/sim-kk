<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Pengguna'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Edit Pengguna',
);

$this->menu=array(
	array('label'=>'Data Pengguna', 'url'=>array('index')),
	array('label'=>'Tambah Pengguna', 'url'=>array('create')),
	array('label'=>'Detail Pengguna', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h3>Edit Pengguna <?php echo $model->id; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>