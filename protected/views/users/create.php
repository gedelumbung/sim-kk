<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Pengguna'=>array('index'),
	'Tambah Pengguna',
);

$this->menu=array(
	array('label'=>'Data Pengguna', 'url'=>array('index')),
);
?>

<h3>Tambah Pengguna</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>