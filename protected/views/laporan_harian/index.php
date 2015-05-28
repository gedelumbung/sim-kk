<?php
/* @var $this DashboardController */

$this->breadcrumbs=array(
	'Dashboard',
);
?>
<h1>Laporan harian - <?php echo $_SESSION['site_name']; ?></h1>

<div class="container-fluid" id="content-area">

    <div class="row-fluid">

    	<form method="post" action="<?php echo Yii::app()->baseUrl; ?>/laporan_harian/set">
	        <div class="span4">
	        	Start : 
	            <?php
				$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'name'=>'laporan_harian_start',
	    			'value'=>(array_key_exists('laporan_harian_start',$_SESSION) ? $_SESSION['laporan_harian_start'] : date('Y-m-d')),
				    'options'=>array(
				        'showAnim'=>'slideDown',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
	        			'dateFormat'=>'yy-mm-dd',//Date format 'mm/dd/yy','yy-mm-dd','d M, y','d
				    ),
				));
				?>
	        </div>

	        <div class="span4">
	        	<input type="submit" class="btn btn-warning" value="Lihat Rekap Laporan">
	        </div>
    	</form>

    </div>
    <div class="row-fluid">

        <div class="span12">
			<table border="1" cellpadding="5" cellspacing="0" width="100%">
        		<tr>
	        		<th>No.</th>
	        		<th>Nama Pasien</th>
	        		<th>Nama Perawatan</th>
	        		<th>Total Belanja</th>
	        		<th>Keuntungan</th>
	        	</tr>
            <?php
            	$total_belanja = 0;
            	$total_keuntungan = 0;
            	foreach ($arr as $key => $value) {
            	?>
	        		<tr>
		        		<th><?php echo $key+1; ?></th>
		        		<th><?php echo $value['nama_pasien']; ?></th>
		        		<th><?php echo $value['perawatan']; ?></th>
		        		<th><?php echo number_format($value['penjualan'],2,',','.'); ?></th>
		        		<th><?php echo number_format($value['keuntungan'],2,',','.'); ?></th>
		        	</tr>
		        <?php
		        	$total_belanja = $total_belanja+$value['penjualan'];
		        	$total_keuntungan = $total_keuntungan+$value['keuntungan'];
            	}
            ?>
        		<tr>
	        		<th colspan="3"></th>
	        		<th><?php echo number_format($total_belanja,2,',','.'); ?></th>
	        		<th><?php echo number_format($total_keuntungan,2,',','.'); ?></th>
	        	</tr>
        	</table>
        </div>

    </div>
</div>
