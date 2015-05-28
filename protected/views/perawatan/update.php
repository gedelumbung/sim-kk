<?php
/* @var $this PerawatanController */
/* @var $model Perawatan */

$this->breadcrumbs=array(
	'Perawatan'=>array('index'),
	$model->id_perawatan=>array('view','id'=>$model->id_perawatan),
	'Update',
);

$this->menu=array(
	array('label'=>'Data Perawatan', 'url'=>array('index')),
	array('label'=>'Tambah Perawatan', 'url'=>array('create')),
	array('label'=>'Detail Perawatan', 'url'=>array('view', 'id'=>$model->id_perawatan)),
);
?>

<h3>Update Perawatan <?php echo $model->id_perawatan; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'arr_obat' => $arr_obat)); ?>