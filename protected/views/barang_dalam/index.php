<?php
/* @var $this Barang_dalamController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Barang Dalam',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-adjust"></i> Create BarangDalam', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list"></i> Manage BarangDalam', 'url'=>array('admin')),
);
?>

<h1>Barang Dalam</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
