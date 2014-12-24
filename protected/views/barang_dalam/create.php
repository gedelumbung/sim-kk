<?php
/* @var $this Barang_dalamController */
/* @var $model BarangDalam */

$this->breadcrumbs=array(
	'Barang Dalam'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Data Barang Dalam', 'url'=>array('index')),
);
?>

<h3>Create Barang Dalam</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>