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

<div class="form" ng-controller="PerawatanCtrl">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'perawatan-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
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

	<div class="row">
		<label>Obat</label>
		<table class="table table-bordered">
			<thead>
				<th>No.</th>
				<th>Nama Obat</th>
				<th>Harga</th>
				<th>Diskon</th>
				<th>Jumlah</th>
				<th></th>
			</thead>
			<tbody>
				<tr ng-repeat="obat in obatCollection">
					<td>{{$index+1}}</td>
					<td width="40%">
						<?php
							$obat = BarangDalam::model()->findAll();
						?>
						<select ng-change="updateObat($index, obat.id_obat, obat.jumlah)" ng-model="obat.id_obat">
							
							<?php
								for($i = 0; $i<count($obat); $i++){
									echo '<option value="'.$obat[$i]['id_barang_dalam'].'">'.$obat[$i]['nama_barang'].' - Rp. '.number_format($obat[$i]['harga_jual'],2,',','.').'</option>';
								}
							?>
						</select>
					</td>
					<td>
						{{obat.harga}}
					</td>
					<td>
						{{obat.diskon}}
					</td>
					<td width="10%">
						<input type="text" style="width:50%" ng-model="obat.jumlah" ng-change="updateObat($index, obat.id_obat, obat.jumlah)">
					</td>
					<td>
						<span class="btn btn-small btn-warning pull-right" ng-click="deleteRowObat($index)">x</span>
					</td>
				</tr>
				<tr>
					<td colspan="4">{{totalBiayaObat}}</td>
					<td colspan="2"><span class="btn btn-small btn-warning pull-right" ng-click="addRowObat()">Tambah Obat</span></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="Perawatan[obat]" value="{{obatCollection}}">
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-sm btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
	var arr_obat = <?php echo json_encode($arr_obat); ?>;
</script>

</div><!-- form -->

</div>
</div>