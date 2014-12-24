<?php
/* @var $this Barang_dalamController */
/* @var $model BarangDalam */

$this->breadcrumbs=array(
	'Barang Dalam'=>array('index'),
	$model->id_barang_dalam,
);

$this->menu=array(
	array('label'=>'Data Barang Dalam', 'url'=>array('index')),
	array('label'=>'Tambah Barang Dalam', 'url'=>array('create')),
	array('label'=>'Edit Barang Dalam', 'url'=>array('update', 'id'=>$model->id_barang_dalam)),
	array('label'=>'Hapus Barang Dalam', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_barang_dalam),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h3>View Barang Dalam #<?php echo $model->id_barang_dalam; ?></h3>

<div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">
</div>
</div>
<div class="portlet-content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_barang_dalam',
		'nama_barang',
		'stok',
		'harga_pokok',
		'harga_jual',
		'diskon',
		'keuntungan',
		'created_at',
		'updated_at',
	),
)); ?>

</div>
</div>
