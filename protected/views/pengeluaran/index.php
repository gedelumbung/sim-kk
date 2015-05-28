<?php
/* @var $this PengeluaranController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pengeluaran',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-adjust"></i> Create Pengeluaran', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list"></i> Manage Pengeluaran', 'url'=>array('admin')),
);
?>

<h1>Pengeluaran</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
