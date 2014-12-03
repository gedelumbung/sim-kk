<?php
/* @var $this PerawatanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Perawatan',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-adjust"></i> Create Perawatan', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list"></i> Manage Perawatan', 'url'=>array('admin')),
);
?>

<h1>Perawatan</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
