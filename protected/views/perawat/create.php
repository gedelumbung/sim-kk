<?php
/* @var $this PerawatController */
/* @var $model Perawat */

$this->breadcrumbs=array(
	'Perawat'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Data Perawat', 'url'=>array('index')),
);
?>

<h3>Create Perawat</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>