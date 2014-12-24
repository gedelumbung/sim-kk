<?php
/* @var $this BarangController */
/* @var $model Barang */

$this->breadcrumbs=array(
	'Barang Jual'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Data Barang Jual', 'url'=>array('index')),
);
?>

<h3>Create Barang Jual</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>