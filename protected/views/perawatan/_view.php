<?php
/* @var $this PerawatanController */
/* @var $data Perawatan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_perawatan')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_perawatan), array('view', 'id'=>$data->id_perawatan)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_perawatan')); ?>:</b>
	<?php echo CHtml::encode($data->nama_perawatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('harga')); ?>:</b>
	<?php echo CHtml::encode($data->harga); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diskon_member')); ?>:</b>
	<?php echo CHtml::encode($data->diskon_member); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diskon_umum')); ?>:</b>
	<?php echo CHtml::encode($data->diskon_umum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('komisi_dokter')); ?>:</b>
	<?php echo CHtml::encode($data->komisi_dokter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('komisi_perawat')); ?>:</b>
	<?php echo CHtml::encode($data->komisi_perawat); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	*/ ?>

</div>