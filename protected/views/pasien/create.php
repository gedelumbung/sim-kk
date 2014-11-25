<?php
/* @var $this PasienController */
/* @var $model Pasien */

$this->breadcrumbs=array(
	'Pasien'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Data Pasien', 'url'=>array('index')),
);
?>

<h3>Create Pasien</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>