<?php
/* @var $this DashboardController */

$this->breadcrumbs=array(
	'Dashboard',
);
?>
<h1>Laporan tahunan - <?php echo $_SESSION['site_name']; ?></h1>

<div class="container-fluid" id="content-area">

    <div class="row-fluid">

    	<form method="post" action="<?php echo Yii::app()->baseUrl; ?>/laporan_tahunan/set">
	        <div class="span4">
	        	Start : 
	            <select name="laporan_tahunan_start">
	            	<?php $this->widget('SelectOpTahun', array('id_select' => (array_key_exists('laporan_tahunan_start',$_SESSION) ? $_SESSION['laporan_tahunan_start'] : date('Y')))); ?>
	            </select>
	        </div>

	        <div class="span4">
	        	End : 
	            <select name="laporan_tahunan_end">
	            	<?php $this->widget('SelectOpTahun', array('id_select' => (array_key_exists('laporan_tahunan_end',$_SESSION) ? $_SESSION['laporan_tahunan_end'] : date('Y')))); ?>
	            </select>
	        </div>

	        <div class="span1">
	        	<input type="submit" class="btn btn-warning pull-right" value="Lihat Grafik">
	        </div>
    	</form>

    </div>
    <div class="row-fluid">

        <div class="span12">
            <?php
            $this->Widget('ext.highcharts.HighchartsWidget', array(
               'options'=>array(
                  'title' => array('text' => 'Laporan tahunan'),
                  'xAxis' => array(
                     'categories' => $arr_date,
                     'title' => array('text' => 'Tahun'),
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
