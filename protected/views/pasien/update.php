<?php
/* @var $this PasienController */
/* @var $model Pasien */

$this->breadcrumbs=array(
	'Pasien'=>array('index'),
	$model->id_pasien=>array('view','id'=>$model->id_pasien),
	'Update',
);

$this->menu=array(
	array('label'=>'Data Pasien', 'url'=>array('index')),
	array('label'=>'Tambah Pasien', 'url'=>array('create')),
	array('label'=>'Detail Pasien', 'url'=>array('view', 'id'=>$model->id_pasien)),
);
?>

<h3>Update Pasien <?php echo $model->id_pasien; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>