<?php
/* @var $this BarangController */
/* @var $model Barang */

$this->breadcrumbs=array(
	'Barang'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Data Barang', 'url'=>array('index')),
);
?>

<h3>Create Barang</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>