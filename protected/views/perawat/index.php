<?php
/* @var $this PerawatController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Perawat',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-adjust"></i> Create Perawat', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list"></i> Manage Perawat', 'url'=>array('admin')),
);
?>

<h1>Perawat</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
