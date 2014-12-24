<?php
/* @var $this Barang_dalamController */
/* @var $model BarangDalam */

$this->breadcrumbs=array(
	'Barang Dalam'=>array('index'),
	$model->id_barang_dalam=>array('view','id'=>$model->id_barang_dalam),
	'Update',
);

$this->menu=array(
	array('label'=>'Data Barang Dalam', 'url'=>array('index')),
	array('label'=>'Tambah Barang Dalam', 'url'=>array('create')),
	array('label'=>'Detail Barang Dalam', 'url'=>array('view', 'id'=>$model->id_barang_dalam)),
);
?>

<h3>Update Barang Dalam <?php echo $model->id_barang_dalam; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>