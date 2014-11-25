<?php
/* @var $this PasienController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pasien',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-adjust"></i> Create Pasien', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list"></i> Manage Pasien', 'url'=>array('admin')),
);
?>

<h1>Pasien</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
