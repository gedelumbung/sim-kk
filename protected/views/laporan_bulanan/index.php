<?php
/* @var $this DashboardController */

$this->breadcrumbs=array(
	'Dashboard',
);
?>
<h1>Laporan bulanan - <?php echo $_SESSION['site_name']; ?></h1>

<div class="container-fluid" id="content-area">

    <div class="row-fluid">

    	<form method="post" action="<?php echo Yii::app()->baseUrl; ?>/laporan_bulanan/set">
	        <div class="span4">
	        	Start : 
	            <select name="laporan_bulanan_start">
	            	<?php $this->widget('SelectOpBulan', array('id_select' => (array_key_exists('laporan_bulanan_start',$_SESSION) ? $_SESSION['laporan_bulanan_start'] : date('m')))); ?>
	            </select>
	        </div>

	        <div class="span4">
	        	End : 
	            <select name="laporan_bulanan_end">
	            	<?php $this->widget('SelectOpBulan', array('id_select' => (array_key_exists('laporan_bulanan_end',$_SESSION) ? $_SESSION['laporan_bulanan_end'] : date('m')))); ?>
	            </select>
	        </div>

	        <div class="span4">
	        	Year : 
	            <select name="laporan_bulanan_tahun">
	            	<?php $this->widget('SelectOpTahun', array('id_select' => (array_key_exists('laporan_bulanan_tahun',$_SESSION) ? $_SESSION['laporan_bulanan_tahun'] : date('Y')))); ?>
	            </select>
	        </div>

	        <div class="span3 pull-right">
	        	<input type="submit" class="btn btn-warning pull-right" value="Lihat Grafik">
	        </div>
    	</form>

    </div>
    <div class="row-fluid">

        <div class="span12">
            <?php
            $this->Widget('ext.highcharts.HighchartsWidget', array(
               'options'=>array(
                  'title' => array('text' => 'Laporan bulanan'),
                  'xAxis' => array(
                     'categories' => $arr_date,
                     'title' => array('text' => 'Bulan'),
                  ),
                  'yAxis' => array(
                     'title' => array('text' => 'Keuntungan'),
                     'labels' => array('format' => 'Rp {value:,.0f}')
                  ),
                  'series' => array(
                     array('name' => 'Penjualan', 'data' => $arr_penjualan),
                     array('name' => 'Keuntungan', 'data' => $arr_keuntungan),
                  ),
                  'tooltip' => array(
                     'pointFormat' => "Rp {point.y:,.0f}"
                  ),
               )
            ));
            ?>
        </div>

    </div>
</div>
