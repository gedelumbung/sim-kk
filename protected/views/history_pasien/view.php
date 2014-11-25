<?php
/* @var $this History_pasienController */
/* @var $model Transaksi */

$this->breadcrumbs=array(
	'Master Transaksi'=>array('index'),
	$model->id_master_transaksi,
);

$this->menu=array(
	array('label'=>'Data Transaksi', 'url'=>array('index')),
	array('label'=>'Tambah Transaksi', 'url'=>array('create')),
	array('label'=>'Edit Transaksi', 'url'=>array('update', 'id'=>$model->id_master_transaksi)),
	array('label'=>'Hapus Transaksi', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_master_transaksi),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h3>View Transaksi #<?php echo $model->id_master_transaksi; ?></h3>

<div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">
</div>
</div>
<div class="portlet-content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_master_transaksi',
		'Pasien.nama',
		'created_at',
		'updated_at',
		'keterangan',
		'hutang',
		'total',
		'total_bayar',
		'status_pembayaran',
	),
)); ?>

<br>
<table class="table table-bordered">
	<tr>
		<td style="width:10%">No.</td>
		<td>Nama Dokter</td>
	</tr>
	<?php
		$no = 1;
		foreach($dokter as $d)
		{
			echo "<tr>";
			echo "<td>".$no."</td>";
			echo "<td>".$d->Dokter->nama."</td>";
			echo "</tr>";
			$no++;
		}
		
	?>
</table>
<br>
<table class="table table-bordered">
	<tr>
		<td style="width:10%">No.</td>
		<td>Nama Perawat</td>
	</tr>
	<?php
		$no = 1;
		foreach($perawat as $p)
		{
			echo "<tr>";
			echo "<td>".$no."</td>";
			echo "<td>".$p->Perawat->nama."</td>";
			echo "</tr>";
			$no++;
		}
		
	?>
</table>
<br>
<table class="table table-bordered">
	<tr>
		<td style="width:10%">No.</td>
		<td>Nama Obat</td>
		<td>Jumlah</td>
		<td>Harga</td>
		<td>Sub Total</td>
	</tr>
	<?php
		$no = 1;
		foreach($obat as $o)
		{
			echo "<tr>";
			echo "<td>".$no."</td>";
			echo "<td>".$o->Barang->nama_barang."</td>";
			echo "<td>".$o->jumlah."</td>";
			echo "<td>".$o->Barang->harga_jual."</td>";
			echo "<td>".$o->Barang->harga_jual*$o->jumlah."</td>";
			echo "</tr>";
			$no++;
		}
		
	?>
</table>
<br>

</div>
</div>
