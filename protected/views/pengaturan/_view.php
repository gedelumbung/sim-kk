<?php
/* @var $this PengaturanController */
/* @var $data Pengaturan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pengaturan')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_pengaturan), array('view', 'id'=>$data->id_pengaturan)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />


</div>