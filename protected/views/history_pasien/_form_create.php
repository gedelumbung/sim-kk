
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

<div class="form" ng-controller="TransasksiCtrl">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'master-transaksi-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
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
			   'htmlOptions' => array('ng-change' => 'updatePasien(id_pasien)', 'ng-model' => 'id_pasien')
			));
		?>
		<?php echo $form->error($model,'id_pasien'); ?>
	</div>
	<br>

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
		<label>Perawatan</label>
		<table class="table table-bordered">
			<thead>
				<th>No.</th>
				<th>Nama Perawatan</th>
				<th>Biaya</th>
				<th>Diskon</th>
				<th>Komisi Dokter</th>
				<th>Komisi Perawat</th>
				<th>Obat Dalam</th>
				<th></th>
			</thead>
			<tbody>
				<tr ng-repeat="perawatan in perawatanCollection" ng-init="indexPerawatan=$index">
					<td>{{$index+1}}</td>
					<td width="30%">
						<?php
							$perawatan = Perawatan::model()->findAll();
						?>
						<select ng-change="updatePerawatan(perawatan.id, isMember, $index)" ng-model="perawatan.id">
							<?php
								for($i = 0; $i<count($perawatan); $i++){
									echo '<option value="'.$perawatan[$i]['id_perawatan'].'">'.$perawatan[$i]['nama_perawatan'].' - Rp. '.number_format($perawatan[$i]['harga'],2,',','.').'</option>';
								}
							?>
						</select>
					</td>
					<td>
						{{perawatan.harga}}
					</td>
					<td>
						{{perawatan.diskon}}
					</td>
					<td>
						{{perawatan.komisi_dokter}}
					</td>
					<td>
						{{perawatan.komisi_perawat}}
					</td>
					<td>
						<table>
							<tr ng-repeat="obatPerawatan in perawatan.obat">
								<td>
									{{obatPerawatan.nama_barang}} * {{obatPerawatan.jumlah}}
								</td>
								<td>
									{{obatPerawatan.harga}}
								</td>
							</tr>
						</table>
					</td>
					<td>
						<span class="btn btn-small btn-warning pull-right" ng-click="deleteRowPerawatan($index)">x</span>
					</td>
				</tr>
				<tr>
					<td colspan="5">{{totalBiayaObatPerawatan}}</td>
					<td colspan="3"><span class="btn btn-small btn-warning pull-right" ng-click="addRowPerawatan()">Tambah Perawatan</span></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="MasterTransaksi[perawatan]" value="{{perawatanCollection}}">
	</div>

	<br>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'total'); ?>
			<?php echo $form->textField($model,'total', array('class'=>'input-block-level', 'readonly'=>true, 'ng-model'=>'totalBiaya')); ?>
			<?php echo $form->error($model,'total'); ?>
		</div>
		<div class="span6">
			<?php echo $form->labelEx($model,'total_bayar'); ?>
			<?php echo $form->textField($model,'total_bayar', array('class'=>'input-block-level', 'ng-model'=>'totalBayar', 'ng-change'=>'countHutang()')); ?>
			<?php echo $form->error($model,'total_bayar'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'hutang'); ?>
			<?php echo $form->textField($model,'hutang', array('class'=>'input-block-level', 'readonly'=>true, 'ng-model'=>'totalHutang')); ?>
			<?php echo $form->error($model,'hutang'); ?>
		</div>
		<div class="span6">
			<label for="kembalian">Kembalian</label>
			<input type="text" ng-model="totalKembalian" readonly="true">
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

</div><!-- form -->

</div>
</div>