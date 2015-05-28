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
	array('label'=>'Cetak', 'url'=>array('cetak', 'id'=>$model->id_master_transaksi)),
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
			echo "<td>".($o->Barang->harga_jual-($o->Barang->harga_jual*$o->Barang->diskon/100))."</td>";
			echo "<td>".($o->Barang->harga_jual-($o->Barang->harga_jual*$o->Barang->diskon/100))*$o->jumlah."</td>";
			echo "</tr>";
			$no++;
		}
		
	?>
</table>
<br>
<table class="table table-bordered">
	<tr>
		<td style="width:10%">No.</td>
		<td>Nama Perawatan</td>
		<td>Biaya</td>
		<td>Diskon</td>
		<td>Obat Dalam</td>
	</tr>
	<?php
		$no = 1;
		foreach($perawatan as $o)
		{
			$m_perawatan=Perawatan::model()->findByPk($o->id_perawatan);

			$member = $model->Pasien->member;

			if($member === 'Ya'){
				$data['diskon'] = $m_perawatan->diskon_umum;
			}
			else{
				if($m_perawatan->diskon_umum > $m_perawatan->diskon_member){
					$data['diskon'] = $m_perawatan->diskon_umum;
				}
				else{
					$data['diskon'] = $m_perawatan->diskon_member;
				}
			}

			echo "<tr>";
			echo "<td>".$no."</td>";
			echo "<td>".$o->Perawatan->nama_perawatan."</td>";
			echo "<td>".($m_perawatan->harga - ($m_perawatan->harga/100*$data['diskon']))."</td>";
			echo "<td>".$data['diskon']."</td>";
			echo "<td>";

			$criteria = new CDbCriteria();
			$criteria->condition = "id_perawatan = '".$o->id_perawatan."'";
			$m_obat_perawatan=ObatPerawatan::model()->findAll($criteria);
			?>
			<table>
				<tr ng-repeat="obatPerawatan in perawatan.obat">
					<td>
						<?php
							$obat = BarangDalam::model()->findAll();
						?>
						<select ng-change="updateObatPerawatan(indexPerawatan,$index, obatPerawatan.id_obat, obatPerawatan.jumlah)" ng-model="obatPerawatan.id_obat">
							
							<?php
								for($i = 0; $i<count($obat); $i++){
									echo '<option value="'.$obat[$i]['id_barang_dalam'].'">'.$obat[$i]['nama_barang'].' - Rp. '.number_format($obat[$i]['harga_jual']-($obat[$i]['harga_jual']*$obat[$i]['diskon']/100),2,',','.').'</option>';
								}
							?>
						</select>
					</td>
					<td>
						<input type="text" style="width:50%" ng-model="obatPerawatan.jumlah" ng-change="updateObatPerawatan(indexPerawatan,$index, obatPerawatan.id_obat, obatPerawatan.jumlah)">
					</td>
					<td>
						<span class="btn btn-small btn-warning pull-right" ng-click="deleteRowObatPerawatan(indexPerawatan,$index)">x</span>
					</td>
				</tr>
			
			<?php
			foreach ($m_obat_perawatan as $key => $op) {
				echo "<tr>";
				echo '<td>'.$op->BarangDalam->nama_barang.' - Rp. '.number_format($op->BarangDalam->harga_jual-($op->BarangDalam->harga_jual*$op->BarangDalam->diskon/100),2,',','.').'</td>';
				echo '<td>'.$op->jumlah.'</td>';
				echo '<td>Rp. '.number_format($op->jumlah * ($op->BarangDalam->harga_jual-($op->BarangDalam->harga_jual*$op->BarangDalam->diskon/100)),2,',','.').'</td>';
				echo "</tr>";
			}
			?>

			</table>

			<?php

			echo"</td>";
			echo "</tr>";
			$no++;
		}
		
	?>
</table>
<br>

</div>
</div>
