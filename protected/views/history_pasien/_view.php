<?php
/* @var $this History_pasienController */
/* @var $data MasterTransaksi */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_master_transaksi')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_master_transaksi), array('view', 'id'=>$data->id_master_transaksi)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pasien')); ?>:</b>
	<?php echo CHtml::encode($data->id_pasien); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hutang')); ?>:</b>
	<?php echo CHtml::encode($data->hutang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('total_bayar')); ?>:</b>
	<?php echo CHtml::encode($data->total_bayar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_pembayaran')); ?>:</b>
	<?php echo CHtml::encode($data->status_pembayaran); ?>
	<br />

	*/ ?>

</div>