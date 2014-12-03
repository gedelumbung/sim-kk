
<style type="text/css">
	select{
		width: 100%;
	}
</style>

<div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">
</div>
</div>
<div class="portlet-content">

<div class="form" ng-controller="TransasksiEditCtrl">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'master-transaksi-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_pasien'); ?>
		<?php
			$this->widget('ext.chosen.Chosen',array(
			   'name' => 'MasterTransaksi[id_pasien]', // input name
			   'value' => $model->id_pasien, // selection
			   'data' => array(''=>'Semua') + CHtml::listData(Pasien::model()->findAll(),'id_pasien','nama'),
			));
		?>
		<?php echo $form->error($model,'id_pasien'); ?>
	</div>
	<br>

	<div class="row">
		<?php echo $form->labelEx($model,'keterangan'); ?>
		<?php echo $form->textArea($model,'keterangan',array('rows'=>6, 'cols'=>50, 'class'=>'input-block-level')); ?>
		<?php echo $form->error($model,'keterangan'); ?>
	</div>

	<div class="row">
		<label>Dokter</label>
		<table class="table table-bordered">
			<thead>
				<th>No.</th>
				<th colspan="2">Nama Dokter</th>
			</thead>
			<tbody>
				<tr ng-repeat="dokter in dokterCollection">
					<td>{{$index+1}}</td>
					<td width="80%">
						<?php
							$dokter = Dokter::model()->findAll();
						?>
						<select ng-change="updateDokter($index, dokter.id_dokter)" ng-model="dokter.id_dokter">
							<option value="">--- Pilih ---</option>
							<?php
								for($i = 0; $i<count($dokter); $i++){
									echo '<option value="'.$dokter[$i]['id_dokter'].'">'.$dokter[$i]['nama'].'</option>';
								}
							?>
						</select>
					</td>
					<td>
						<span class="btn btn-small btn-warning pull-right" ng-click="deleteRowDokter($index)">x</span>
					</td>
				</tr>
				<tr>
					<td colspan="3"><span class="btn btn-small btn-warning pull-right" ng-click="addRowDokter()">Tambah Dokter</span></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="MasterTransaksi[dokter]" value="{{dokterCollection}}">
	</div>

	<div class="row">
		<label>Perawat</label>
		<table class="table table-bordered">
			<thead>
				<th>No.</th>
				<th>Nama Perawat</th>
			</thead>
			<tbody>
				<tr ng-repeat="perawat in perawatCollection">
					<td>{{$index+1}}</td>
					<td width="80%">
						<?php
							$perawat = Perawat::model()->findAll();
						?>
						<select ng-change="updatePerawat($index, perawat.id_perawat)" ng-model="perawat.id_perawat">
							<option value="">--- Pilih ---</option>
							<?php
								for($i = 0; $i<count($perawat); $i++){
									echo '<option value="'.$perawat[$i]['id_perawat'].'">'.$perawat[$i]['nama'].'</option>';
								}
							?>
						</select>
					</td>
					<td>
						<span class="btn btn-small btn-warning pull-right" ng-click="deleteRowPerawat($index)">x</span>
					</td>
				</tr>
				<tr>
					<td colspan="3"><span class="btn btn-small btn-warning pull-right" ng-click="addRowPerawat()">Tambah Perawat</span></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="MasterTransaksi[perawat]" value="{{perawatCollection}}">
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
					<td width="60%">
						<?php
							$obat = Barang::model()->findAll();
						?>
						<select ng-change="updateObat($index, obat.id_obat, obat.jumlah)" ng-model="obat.id_obat">
							<option value="">--- Pilih ---</option>
							<?php
								for($i = 0; $i<count($obat); $i++){
									echo '<option value="'.$obat[$i]['id_barang'].'">'.$obat[$i]['nama_barang'].' - Rp. '.number_format($obat[$i]['harga_jual'],2,',','.').'</option>';
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
		<input type="hidden" name="MasterTransaksi[obat]" value="{{obatCollection}}">
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_perawatan'); ?>
		<?php echo $form->dropDownList($model,'id_perawatan',array(''=>'Semua') + CHtml::listData(Perawatan::model()->findAll(),'id_perawatan','nama_perawatan'), array('ng-change' => 'updatePerawatan(perawatan.id, isMember)', 'ng-model'=>'perawatan.id')); ?>
		<?php echo $form->error($model,'id_perawatan'); ?>
	</div>

	<div class="row" ng-show="showPerawatan">
		<div class="span6">
			<label for="perawatan_harga">Biaya Perawatan</label>
			<input type="text" id="perawatan_harga" readonly="true" ng-model="perawatan.harga">
		</div>
		
		<div class="span6">
			<label for="perawatan_diskon">Diskon Perawatan</label>
			<input type="text" id="perawatan_diskon" readonly="true" ng-model="perawatan.diskon">
		</div>
	</div>

	<div class="row" ng-show="showPerawatan">
		<div class="span6">
			<label for="perawatan_diskon_dokter">Komisi Dokter</label>
			<input type="text" id="perawatan_diskon_dokter" readonly="true" ng-model="perawatan.komisi_dokter">
		</div>
		
		<div class="span6">
			<label for="perawatan_diskon_perawat">Komisi Perawat</label>
			<input type="text" id="perawatan_diskon_perawat" readonly="true" ng-model="perawatan.komisi_perawat">
		</div>
	</div>

	<br>

	<div class="row">
		<?php echo $form->labelEx($model,'total'); ?>
		<?php echo $form->textField($model,'total', array('class'=>'input-block-level', 'readonly'=>true, 'ng-model'=>'totalBiaya')); ?>
		<?php echo $form->error($model,'total'); ?>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'total_bayar'); ?>
			<?php echo $form->textField($model,'total_bayar', array('class'=>'input-block-level', 'ng-model'=>'totalBayar', 'ng-change'=>'countHutang()')); ?>
			<?php echo $form->error($model,'total_bayar'); ?>
		</div>
		<div class="span6">
			<?php echo $form->labelEx($model,'hutang'); ?>
			<?php echo $form->textField($model,'hutang', array('class'=>'input-block-level', 'readonly'=>true, 'ng-model'=>'totalHutang')); ?>
			<?php echo $form->error($model,'hutang'); ?>
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_pembayaran'); ?>
		<?php echo $form->textField($model,'status_pembayaran',array('size'=>20,'maxlength'=>20, 'readonly'=>true, 'class'=>'input-block-level', 'ng-model'=>'statusPembayaran')); ?>
		<?php echo $form->error($model,'status_pembayaran'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan', array('class' => 'btn btn-medium btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
	var arr_dokter = <?php echo json_encode($arr_dokter); ?>;
	var arr_perawat = <?php echo json_encode($arr_perawat); ?>;
	var arr_obat = <?php echo json_encode($arr_obat); ?>;
	var m_array = <?php echo json_encode($m_array); ?>;
</script>


</div><!-- form -->

</div>
</div>