<?php
/* @var $this DashboardController */

$this->breadcrumbs=array(
	'Dashboard',
);
?>
<h1>
    Dashboard - <?php echo $_SESSION['site_name']; ?> 
    <?php 
        if(Yii::app()->user->status === 'kasir' || Yii::app()->user->status === 'owner'){
    ?>
    <a href="<?php echo Yii::app()->baseUrl; ?>/history_pasien/create" class="btn btn-warning pull-right">Tambah Transaksi</a>
    <?php
        }
    ?>
</h1>

<?php 
    if(Yii::app()->user->status === 'owner'){
?>
<div class="container-fluid" id="content-area">

    <div class="row-fluid">

        <div class="span12">
            <?php
            $this->Widget('ext.highcharts.HighchartsWidget', array(
               'options'=>array(
                  'title' => array('text' => 'Grafik Kunjungan Pasien - '.date('M/Y')),
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
<?php
    }
?>

<div class="row">
    <div class="dashIcon span2 btn btn-default">
        <a href="<?php echo Yii::app()->baseUrl; ?>/pasien"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-folder-person.png" alt="Inbox" /></a>
        <div class="dashIconText "><a href="<?php echo Yii::app()->baseUrl; ?>/pasien">Data Pasien</a></div>
    </div>

    <?php 
        if(Yii::app()->user->status === 'owner' || Yii::app()->user->status === 'admin'){
    ?>
    <div class="dashIcon span2 btn btn-default">
        <a href="<?php echo Yii::app()->baseUrl; ?>/barang"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-safe.png" alt="Order History" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/barang">Data Barang</a></div>
    </div>
    
    <div class="dashIcon span2 btn btn-default">
        <a href="<?php echo Yii::app()->baseUrl; ?>/dokter"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-man-tie.png" alt="Manage Prices" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/dokter">Data Dokter</a></div>
    </div>
    
    <div class="dashIcon span2 btn btn-default">
        <a href="<?php echo Yii::app()->baseUrl; ?>/perawat"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-ladies.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/perawat">Data Perawat</a></div>
    </div>
    
    <div class="dashIcon span2 btn btn-default">
        <a href="<?php echo Yii::app()->baseUrl; ?>/diskon"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-cash.png" alt="Products" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/perawatan">Jenis Perawatan</a></div>
    </div>
    <?php
        }
    ?>

    <?php 
        if(Yii::app()->user->status === 'owner' || Yii::app()->user->status === 'kasir'){
    ?>
    <div class="dashIcon span2 btn btn-default">
        <a href="<?php echo Yii::app()->baseUrl; ?>/history_pasien"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-bag-medicine.png" alt="Page" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/history_pasien">History Pasien</a></div>
    </div>
    <?php
        }
    ?>
    
    
    
 </div>
 <div class="row">
    <?php 
        if(Yii::app()->user->status === 'owner'){
    ?>
    <div class="dashIcon span2 btn btn-default">
        <a href="<?php echo Yii::app()->baseUrl; ?>/"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-book3.png" alt="Calendar" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/">Laporan Mingguan</a></div>
    </div>
    
    <div class="dashIcon span2 btn btn-default">
        <a href="<?php echo Yii::app()->baseUrl; ?>/"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-books-stacked.png" alt="Trash" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/">Laporan Bulanan</a></div>
    </div>
    
    <div class="dashIcon span2 btn btn-default">
        <a href="<?php echo Yii::app()->baseUrl; ?>/"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-books.png" alt="System Alerts" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/">Laporan Tahunan</a></div>
    </div>

    <div class="dashIcon span2 btn btn-default">
        <a href="<?php echo Yii::app()->baseUrl; ?>/"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-download.png" alt="Inbox" /></a>
        <div class="dashIconText "><a href="<?php echo Yii::app()->baseUrl; ?>/backup">Backup Data</a></div>
    </div>
    
    <div class="dashIcon span2 btn btn-default">
        <a href="<?php echo Yii::app()->baseUrl; ?>/users"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-people.png" alt="Order History" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/">Pengguna</a></div>
    </div>
    <?php
        }
    ?>
   
    
</div><!-- END OF .dashIcons -->
