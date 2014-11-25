<?php
/* @var $this History_pasienController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Master Transaksi',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-adjust"></i> Create MasterTransaksi', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list"></i> Manage MasterTransaksi', 'url'=>array('admin')),
);
?>

<h1>Master Transaksi</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
