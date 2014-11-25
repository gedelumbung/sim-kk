<?php
/* @var $this DokterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dokter',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-adjust"></i> Create Dokter', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list"></i> Manage Dokter', 'url'=>array('admin')),
);
?>

<h1>Dokter</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
