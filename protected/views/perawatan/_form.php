<?php
/* @var $this PerawatanController */
/* @var $model Perawatan */
/* @var $form CActiveForm */
?>

<div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">
</div>
</div>
<div class="portlet-content">

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'perawatan-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_perawatan'); ?>
		<?php echo $form->textField($model,'nama_perawatan',array('size'=>60,'maxlength'=>150, 'class'=>'input-block-level')); ?>
		<?php echo $form->error($model,'nama_perawatan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'harga'); ?>
		<?php echo $form->textField($model,'harga', array('class'=>'input-block-level')); ?>
		<?php echo $form->error($model,'harga'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diskon_member'); ?>
		<?php echo $form->textField($model,'diskon_member',array('size'=>5,'maxlength'=>5, 'class'=>'input-block-level')); ?>
		<?php echo $form->error($model,'diskon_member'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diskon_umum'); ?>
		<?php echo $form->textField($model,'diskon_umum',array('size'=>5,'maxlength'=>5, 'class'=>'input-block-level')); ?>
		<?php echo $form->error($model,'diskon_umum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'komisi_dokter'); ?>
		<?php echo $form->textField($model,'komisi_dokter', array('class'=>'input-block-level')); ?>
		<?php echo $form->error($model,'komisi_dokter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'komisi_perawat'); ?>
		<?php echo $form->textField($model,'komisi_perawat', array('class'=>'input-block-level')); ?>
		<?php echo $form->error($model,'komisi_perawat'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-sm btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>
</div>