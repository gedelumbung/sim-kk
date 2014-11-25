<?php
/* @var $this PengaturanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pengaturan',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-adjust"></i> Create Pengaturan', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list"></i> Manage Pengaturan', 'url'=>array('admin')),
);
?>

<h1>Pengaturan</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
