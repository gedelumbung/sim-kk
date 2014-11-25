<?php
/* @var $this BarangController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Barang',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-adjust"></i> Create Barang', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list"></i> Manage Barang', 'url'=>array('admin')),
);
?>

<h1>Barang</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
