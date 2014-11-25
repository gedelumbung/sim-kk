<?php
/* @var $this DokterController */
/* @var $model Dokter */

$this->breadcrumbs=array(
	'Dokter'=>array('index'),
	$model->id_dokter=>array('view','id'=>$model->id_dokter),
	'Update',
);

$this->menu=array(
	array('label'=>'Data Dokter', 'url'=>array('index')),
	array('label'=>'Tambah Dokter', 'url'=>array('create')),
	array('label'=>'Detail Dokter', 'url'=>array('view', 'id'=>$model->id_dokter)),
);
?>

<h3>Update Dokter <?php echo $model->id_dokter; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>