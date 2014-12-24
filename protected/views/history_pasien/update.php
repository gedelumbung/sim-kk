<?php
/* @var $this History_pasienController */
/* @var $model MasterTransaksi */

$this->breadcrumbs=array(
	'Master Transaksi'=>array('index'),
	$model->id_master_transaksi=>array('view','id'=>$model->id_master_transaksi),
	'Update',
);

$this->menu=array(
	array('label'=>'Data Transaksi', 'url'=>array('index')),
	array('label'=>'Tambah Transaksi', 'url'=>array('create')),
	array('label'=>'Detail Transaksi', 'url'=>array('view', 'id'=>$model->id_master_transaksi)),
);
?>

<h3>Update Transaksi <?php echo $model->id_master_transaksi; ?></h3>

<?php $this->renderPartial('_form_update', array(
		'model'=>$model, 
		'arr_dokter'=>$arr_dokter,
		'arr_perawat'=>$arr_perawat,
		'arr_perawatan'=>$arr_perawatan,
		'arr_obat'=>$arr_obat,
		'm_array'=>$m_array,
	)
); ?>