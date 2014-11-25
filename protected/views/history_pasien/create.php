<?php
/* @var $this History_pasienController */
/* @var $model MasterTransaksi */

$this->breadcrumbs=array(
	'Master Transaksi'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Data Transaksi', 'url'=>array('index')),
);
?>

<h3>Create Transaksi</h3>

<?php $this->renderPartial('_form_create', array('model'=>$model)); ?>