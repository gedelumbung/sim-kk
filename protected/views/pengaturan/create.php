<?php
/* @var $this PengaturanController */
/* @var $model Pengaturan */

$this->breadcrumbs=array(
	'Pengaturan'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Data Pengaturan', 'url'=>array('index')),
);
?>

<h3>Create Pengaturan</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>