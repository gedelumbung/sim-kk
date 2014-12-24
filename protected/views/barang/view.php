<?php
/* @var $this BarangController */
/* @var $model Barang */

$this->breadcrumbs=array(
	'Barang Jual'=>array('index'),
	$model->id_barang,
);

$this->menu=array(
	array('label'=>'Data Barang Jual', 'url'=>array('index')),
	array('label'=>'Tambah Barang Jual', 'url'=>array('create')),
	array('label'=>'Edit Barang Jual', 'url'=>array('update', 'id'=>$model->id_barang)),
	array('label'=>'Hapus Barang Jual', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_barang),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h3>View Barang Jual #<?php echo $model->id_barang; ?></h3>

<div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">
</div>
</div>
<div class="portlet-content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_barang',
		'nama_barang',
		'stok',
		'harga_pokok',
		'harga_jual',
		'diskon',
		'created_at',
		'updated_at',
	),
)); ?>

</div>
</div>
