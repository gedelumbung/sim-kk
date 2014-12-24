<?php
/* @var $this BarangController */
/* @var $model Barang */

$this->breadcrumbs=array(
	'Barang Jual'=>array('index'),
	$model->id_barang=>array('view','id'=>$model->id_barang),
	'Update',
);

$this->menu=array(
	array('label'=>'Data Barang Jual', 'url'=>array('index')),
	array('label'=>'Tambah Barang Jual', 'url'=>array('create')),
	array('label'=>'Detail Barang Jual', 'url'=>array('view', 'id'=>$model->id_barang)),
);
?>

<h3>Update Barang Jual <?php echo $model->id_barang; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>