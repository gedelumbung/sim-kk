<?php
/* @var $this DokterController */
/* @var $model Dokter */

$this->breadcrumbs=array(
	'Dokter'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Data Dokter', 'url'=>array('index')),
);
?>

<h3>Create Dokter</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>