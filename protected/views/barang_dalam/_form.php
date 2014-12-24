<?php
/* @var $this Barang_dalamController */
/* @var $model BarangDalam */
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
	'id'=>'barang-dalam-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_barang'); ?>
		<?php echo $form->textField($model,'nama_barang',array('size'=>60,'maxlength'=>150, 'class'=>'input-block-level')); ?>
		<?php echo $form->error($model,'nama_barang'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stok'); ?>
		<?php echo $form->textField($model,'stok', array('class'=>'input-block-level')); ?>
		<?php echo $form->error($model,'stok'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'harga_pokok'); ?>
		<?php echo $form->textField($model,'harga_pokok', array('class'=>'input-block-level')); ?>
		<?php echo $form->error($model,'harga_pokok'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'harga_jual'); ?>
		<?php echo $form->textField($model,'harga_jual', array('class'=>'input-block-level')); ?>
		<?php echo $form->error($model,'harga_jual'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diskon'); ?>
		<?php echo $form->textField($model,'diskon',array('size'=>10,'maxlength'=>10, 'class'=>'input-block-level')); ?>
		<?php echo $form->error($model,'diskon'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-sm btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>
</div>