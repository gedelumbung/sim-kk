<?php
/* @var $this PengeluaranController */
/* @var $data Pengeluaran */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pengeluaran')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_pengeluaran), array('view', 'id'=>$data->id_pengeluaran)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pengeluaran')); ?>:</b>
	<?php echo CHtml::encode($data->pengeluaran); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jumlah')); ?>:</b>
	<?php echo CHtml::encode($data->jumlah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />


</div>