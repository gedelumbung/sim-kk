<?php
/* @var $this DashboardController */

$this->breadcrumbs=array(
	'Dashboard',
);
?>
<h1>Grafik Kunjungan Bulanan - <?php echo $_SESSION['site_name']; ?></h1>

<div class="container-fluid" id="content-area">

    <div class="row-fluid">

    	<form method="post" action="<?php echo Yii::app()->baseUrl; ?>/grafik_kunjungan_bulanan/set">
	        <div class="span4">
	        	Start : 
	            <select name="bulanan_start">
	            	<?php $this->widget('SelectOpBulan', array('id_select' => (array_key_exists('bulanan_start',$_SESSION) ? $_SESSION['bulanan_start'] : date('m')))); ?>
	            </select>
	        </div>

	        <div class="span4">
	        	End : 
	            <select name="bulanan_end">
	            	<?php $this->widget('SelectOpBulan', array('id_select' => (array_key_exists('bulanan_end',$_SESSION) ? $_SESSION['bulanan_end'] : date('m')))); ?>
	            </select>
	        </div>

	        <div class="span4">
	        	Year : 
	            <select name="bulanan_tahun">
	            	<?php $this->widget('SelectOpTahun', array('id_select' => (array_key_exists('bulanan_tahun',$_SESSION) ? $_SESSION['bulanan_tahun'] : date('Y')))); ?>
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
                  'title' => array('text' => 'Grafik Kunjungan'),
                  'xAxis' => array(
                     'categories' => $arr_date,
                     'title' => array('text' => 'Bulan')
                  ),
                  'yAxis' => array(
                     'title' => array('text' => 'Jumlah Pasien')
                  ),
                  'series' => array(
                     array('name' => 'Jumlah Pasien', 'data' => $arr_total)
                  )
               )
            ));
            ?>
        </div>

    </div>
</div>
