<?php
/* @var $this DashboardController */

$this->breadcrumbs=array(
	'Dashboard',
);
?>
<h1>Grafik Kunjungan Mingguan - <?php echo $_SESSION['site_name']; ?></h1>

<div class="container-fluid" id="content-area">

    <div class="row-fluid">

    	<form method="post" action="<?php echo Yii::app()->baseUrl; ?>/grafik_kunjungan_mingguan/set">
	        <div class="span4">
	        	Start : 
	            <?php
				$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'name'=>'mingguan_start',
	    			'value'=>(array_key_exists('mingguan_start',$_SESSION) ? $_SESSION['mingguan_start'] : date('Y-m-d')),
				    'options'=>array(
				        'showAnim'=>'slideDown',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
	        			'dateFormat'=>'yy-mm-dd',//Date format 'mm/dd/yy','yy-mm-dd','d M, y','d
				    ),
				));
				?>
	        </div>

	        <div class="span4">
	        	End : 
	            <?php
				$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'name'=>'mingguan_end',
	    			'value'=>(array_key_exists('mingguan_end',$_SESSION) ? $_SESSION['mingguan_end'] : date('Y-m-d')),
				    'options'=>array(
				        'showAnim'=>'slideDown',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
	        			'dateFormat'=>'yy-mm-dd',//Date format 'mm/dd/yy','yy-mm-dd','d M, y','d
				    ),
				));
				?>
	        </div>

	        <div class="span4">
	        	<input type="submit" class="btn btn-warning" value="Lihat Grafik">
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
                     'title' => array('text' => 'Tanggal')
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
