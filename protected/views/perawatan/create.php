<?php
/* @var $this PerawatanController */
/* @var $model Perawatan */

$this->breadcrumbs=array(
	'Perawatan'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Data Perawatan', 'url'=>array('index')),
);
?>

<h3>Create Perawatan</h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'arr_obat' => $arr_obat)); ?>