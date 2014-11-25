<?php
/* @var $this BarangController */
/* @var $model Barang */

$this->breadcrumbs=array(
	'Barang'=>array('index'),
	$model->id_barang=>array('view','id'=>$model->id_barang),
	'Update',
);

$this->menu=array(
	array('label'=>'Data Barang', 'url'=>array('index')),
	array('label'=>'Tambah Barang', 'url'=>array('create')),
	array('label'=>'Detail Barang', 'url'=>array('view', 'id'=>$model->id_barang)),
);
?>

<h3>Update Barang <?php echo $model->id_barang; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>