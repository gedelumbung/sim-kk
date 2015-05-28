<?php
/* @var $this PengeluaranController */
/* @var $model Pengeluaran */

$this->breadcrumbs=array(
	'Pengeluaran'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Data Pengeluaran', 'url'=>array('index')),
);
?>

<h3>Create Pengeluaran</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>