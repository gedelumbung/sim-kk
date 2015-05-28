<script type="text/javascript">
	window.print();
</script>
<style type="text/css">
body{
	font-family: Arial;
	font-size: 12px;
	padding: 0px;
	margin: 20px 70px;
}
h3{
	font-size: 18px;
	text-align: center;
}
table{
	font-size: 12px;
	width: 100%;
	border-collapse: collapse;
}
.detail-view{
	text-align: left;
}
.detail-view tbody tr th{
	padding: 5px;
}
</style>
<h3><?php echo $_SESSION['site_name']; ?></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_master_transaksi',
		'Pasien.nama',
		'hutang',
		'total',
		'total_bayar',
		'status_pembayaran',
	),
)); ?>

<br>
<table border="1" cellpadding="5" cellspacing="0">
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
<table border="1" cellpadding="5" cellspacing="0">
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
			
			<?php
			foreach ($m_obat_perawatan as $key => $op) {
				echo "<tr>";
				echo '<td width="300px">'.$op->BarangDalam->nama_barang.' - Rp. '.number_format($op->BarangDalam->harga_jual-($op->BarangDalam->harga_jual*$op->BarangDalam->diskon/100),2,',','.').'</td>';
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
