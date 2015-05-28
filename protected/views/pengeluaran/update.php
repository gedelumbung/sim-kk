<?php
/* @var $this PengeluaranController */
/* @var $model Pengeluaran */

$this->breadcrumbs=array(
	'Pengeluaran'=>array('index'),
	$model->id_pengeluaran=>array('view','id'=>$model->id_pengeluaran),
	'Update',
);

$this->menu=array(
	array('label'=>'Data Pengeluaran', 'url'=>array('index')),
	array('label'=>'Tambah Pengeluaran', 'url'=>array('create')),
	array('label'=>'Detail Pengeluaran', 'url'=>array('view', 'id'=>$model->id_pengeluaran)),
);
?>

<h3>Update Pengeluaran <?php echo $model->id_pengeluaran; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>