<?php
/* @var $this History_pasienController */
/* @var $model MasterTransaksi */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'nama_pasien'); ?>
		<?php echo $form->textField($model,'nama_pasien', array('class'=>'input-block-level')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_at'); ?>
        <?php
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
		    'name'=>'MasterTransaksi[created_at]',
		    'options'=>array(
		        'showAnim'=>'slideDown',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
    			'dateFormat'=>'yy-mm-dd',//Date format 'mm/dd/yy','yy-mm-dd','d M, y','d
		    ),
		));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_pembayaran'); ?>
        <?php echo $form->dropDownList($model,'status_pembayaran',array("Lunas"=>"Lunas","Belum Lunas"=>"Belum Lunas")); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search', array('class'=>'btn btn-sm btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->