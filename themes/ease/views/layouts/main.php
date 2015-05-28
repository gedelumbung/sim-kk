<!doctype html>
<html ng-app="App">
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no,maximum-scale=1">

	<title><?php echo $_SESSION['site_name']; ?></title>
	

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/asset/css/bootstrap.min.css" />
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/asset/css/bootstrap-responsive.min.css" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/asset/css/style.css" />


	<style type="text/css">

/* GridView */

li.page, li.next, li.previous {margin:0}

.grid-view table.items
{
	border-collapse: collapse;
	width: 100%;
	border: 0 none !important;
}

.grid-view table.items th
{
	border-bottom:1px solid #ddd;
	background:transparent;
	-moz-background-clip:border;
	-moz-background-inline-policy:continuous;
	-moz-background-origin:padding;
}

.grid-view table.items th, .grid-view table.items td
{
	font-size: 0.9em;
	padding: 0.3em;
}

.grid-view table.items th a
{
	color: #000;
	font-weight: bold;
	text-decoration: none;
}

.grid-view table.items th
{
	color: #000;
	font-weight: bold;
	text-decoration: none;
}

.grid-view table.items th a:hover
{
	color: #000;
}

.grid-view table.items th a.asc
{
	background:url(up.gif) right center no-repeat;
	padding-right: 10px;
}

.grid-view table.items th a.desc
{
	background:url(down.gif) right center no-repeat;
	padding-right: 10px;
}

/*.grid-view table.items tr.even*/
tr.even
{
	background: #fff;
}

/*.grid-view table.items tr.odd*/
tr.odd
{
	background: #f3f3f3;
}

.grid-view table.items tr.selected
{
	background:#9eec55;
}

.grid-view table.items tr:hover td, .grid-view table.items tr:hover td a
{
	background:#e58616;
	color:#fff;
}


/*.grid-view .link-column img
{
    border: 0;
}*/

/*.grid-view .button-column img
{
    border: 0;
}*/


.grid-view .button-column
{
	text-align: center;
	width: 60px;
}

.grid-view .checkbox-column
{
	width: 15px;
}

/*.grid-view .summary*/
div.summary
{
	margin: 0 0 5px 0;
	text-align: right;
	font-size:0.8em
}

/*.grid-view .pager*/
div.pager
{
	margin: 5px 0 0 0;
	text-align: center;
	padding:0;
	height:30px;
	float: left;
}

.grid-view .empty
{
	font-style: italic;
}

.grid-view .filters input,
.grid-view .filters select
{
	width: 100%;
	border: 1px solid #ccc;
	-moz-border-radius: 2px; -webkit-border-radius: 2px; border-radius: 2px;
}


/* Styles for ClinkPager */
ul.yiiPager
{
	font-size:.9em;
	border:0;
	margin:0;
	padding:0;
	line-height:100%;
	display:inline;
}

ul.yiiPager li
{
	display:inline;
}

ul.yiiPager a:link,
ul.yiiPager a:visited
{
	border:solid 1px #ccc;
	color:inherit;
	font-weight:bold;
	padding:2px 8px;
	text-decoration:none;
	-moz-border-radius:3px; -webkit-border-radius:3px; border-radius: 3px;
}

ul.yiiPager .page a
{
	font-weight: 600;
}

ul.yiiPager a:hover
{
	background:#e58616;
	color:#fff;
}

ul.yiiPager .selected a
{
	background:#e58616;
	color:#fff;
	font-weight:bold;
}

ul.yiiPager .hidden a
{
	border:1px solid #ccc;
	color:inherit;
}

/**
 * Hide first and last buttons by default.
 */
ul.yiiPager .first,
ul.yiiPager .last
{
	display:none;
}

div.demo_box{
	background: transparent url('images/bg.gif') repeat scroll left top;
	-moz-border-radius: 6px; -webkit-border-radius: 6px; border-radius: 6px;
}

div.grid-view {
	border:1px dotted #333;
	-moz-background-clip:border;
	-moz-background-inline-policy:continuous;
	-moz-background-origin:padding;
	padding:5px;
	background-color: #f1f1f1;
}

.search-form{
	padding: 10px 15px 10px 0px;
	border:1px dotted #333;
	margin-bottom: 20px;
}

.search-form form{
	padding: 5px;
}

.search-form form label{
	font-size: 12px;
}
	.row{
		margin-left: 0px;
	}
	.row input{
		width: 100%;
	}
	.row textarea{
		width: 100%;
	}
	.portlet-content ul{
		list-style: none;
		float: none;
	}
	.portlet-content ul li{
		padding: 5px 15px;
		float: left;
	}
	.portlet-content ul li a{
		color: #fff;
	}
	.portlet-content ul li a:hover{
		color: #fff;
		text-decoration: underline;
	}
	.items input{
		padding: 0px;
	}
	h1{
		font-size: 24px;
		border-bottom: 1px dotted #333;
	}
	.search-button{
		padding: 5px;
		border:1px solid #999;
		position: absolute;
		right: 20px;
		top: 110px;
	}

.dashIcon {
  float:left;
  /*padding-left:4px;width:123px;*/
  border: solid 1px #CCCCCC;  
  background-color:#F9F9F9;
  padding:20px;
  margin-bottom:10px;
  text-align:center;
  min-height: 150px!important;
}

.errorSummary{
	background-color: #ff4c4b;
	color: #fff;
	padding: 5px;
}

.errorSummary ul{
	list-style: square;
}

.errorSummary ul li{
	padding: 1px;
	float: none;
}
</style>

	<!-- jQuery -->
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<!-- Bootstrap -->
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/asset/js/bootstrap.min.js"></script>

	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/asset/js/jquery.nicescroll.min.js"></script>

	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/asset/js/application.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/asset/js/angular.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/asset/js/custom/module.angular.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/asset/js/custom/master.transaksi.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/asset/js/custom/perawatan.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/asset/js/custom/service/barang.service.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/asset/js/custom/service/barang.dalam.service.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/asset/js/custom/service/perawatan.service.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/asset/js/custom/service/pasien.service.js"></script>

</head>

<body data-layout="fixed">
	<div id="top"> 
		<div class="container-fluid">
			<div class="pull-left">
				<a href="#" id="brand"><span></span><?php echo $_SESSION['site_name']; ?></a>
				<div class="collapse-me">
				</div>
			</div>
			<div class="pull-right">
				<div class="btn-group">
				<?php
					if(Yii::app()->user->status==='administrasi')
					{
				?>
				<a href="<?php echo Yii::app()->baseUrl; ?>/manajemen_user" class="button">
					<i class="icon-fire"></i>
					Manajemen Pengguna
				</a>
				<?php } ?>
					<a href="#" class="button dropdown-toggle" data-toggle="dropdown"><i class="icon-white icon-user"></i><?php echo Yii::app()->user->nama_lengkap; ?><span class="caret"></span></a>
					<div class="dropdown-menu pull-right">
						<div class="right-details">
							<h6>Logged in as</h6>
							<span class="name"><?php echo Yii::app()->user->nama_lengkap; ?></span>
							<span class="email"><?php echo Yii::app()->user->email; ?></span>
							<ul>
								<li>
									<a href="<?php echo Yii::app()->baseUrl; ?>/profile">Edit Profil</a>
								</li>
								<li>
									<a href="<?php echo Yii::app()->baseUrl; ?>/profile">Change Password</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<a href="<?php echo Yii::app()->baseUrl; ?>/site/logout" class="button">
					<i class="icon-signout"></i>
					Logout
				</a>
			</div>
		</div>
	</div>

	<div id="main">
		<div id="navigation" style="width:290px;">
			<div class="search">
			</div>

			<ul class="mainNav" data-open-subnavs="multi" style="width:280px;">
				<li class='active'>
					<a href="<?php echo Yii::app()->baseUrl; ?>/dashboard"><i class="icon-home icon-white"></i><span>Dashboard</span></a>
				</li>

				<li class='active'>
					<a href="#"><i class="icon-th-large icon-white"></i><span>Master Data</span><span class="label">5</span></a>
					<ul class="subnav">
						<?php 
							if(Yii::app()->user->status === 'kasir'){
						?>
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/pasien"><i class="icon-th-list icon-white"></i><span> Data Pasien</span></a>
						</li>
						<?php
							}
						?>
						<?php 
							if(Yii::app()->user->status === 'admin' || Yii::app()->user->status === 'owner'){
						?>
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/pasien"><i class="icon-th-list icon-white"></i><span> Data Pasien</span></a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/barang_dalam"><i class="icon-hdd icon-white"></i><span> Data Barang Dalam</span></a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/barang"><i class="icon-hdd icon-white"></i><span> Data Barang Jual</span></a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/perawatan"><i class="icon-list-alt icon-white"></i><span> Jenis Perawatan</span></a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/dokter"><i class="icon-asterisk icon-white"></i><span> Data Dokter</span></a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/perawat"><i class="icon-asterisk icon-white"></i><span> Data Perawat</span></a>
						</li>
						<?php
							}
						?>
					</ul>
				</li>

				<?php 
					if(Yii::app()->user->status === 'kasir' || Yii::app()->user->status === 'owner'){
				?>
				<li class='active'>
					<a href="#"><i class="icon-briefcase icon-white"></i><span>Transaksi</span><span class="label">2</span></a>
					<ul class="subnav">
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/history_pasien"><i class="icon-th-list icon-white"></i><span> History Pasien</span></a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/history_pasien/create"><i class="icon-plus-sign icon-white"></i><span> Tambah Transaksi</span></a>
						</li>
					</ul>
				</li>
				<?php
					}
				?>

				<?php 
					if(Yii::app()->user->status === 'admin' || Yii::app()->user->status === 'owner'){
				?>
				<li class='active'>
					<a href="#"><i class="icon-briefcase icon-white"></i><span>Pengeluaran</span><span class="label">2</span></a>
					<ul class="subnav">
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/pengeluaran"><i class="icon-th icon-white"></i><span> Pengeluaran</span></a>
						</li>
					</ul>
				</li>
				<?php
					}
				?>

				<?php 
					if(Yii::app()->user->status === 'owner'){
				?>
				<li class='active'>
					<a href="#"><i class="icon-th icon-white"></i><span>Laporan</span><span class="label">4</span></a>
					<ul class="subnav">
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/laporan_harian"><i class="icon-th-list icon-white"></i><span> Laporan Harian</span></a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/laporan_mingguan"><i class="icon-th-list icon-white"></i><span> Laporan Mingguan</span></a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/laporan_bulanan"><i class="icon-th-list icon-white"></i><span> Laporan Bulanan</span></a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/laporan_tahunan"><i class="icon-th-list icon-white"></i><span> Laporan Tahunan</span></a>
						</li>
					</ul>
				</li>

				<li class='active'>
					<a href="#"><i class="icon-signal icon-white"></i><span>Grafik Kunjungan</span><span class="label">3</span></a>
					<ul class="subnav">
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/grafik_kunjungan_mingguan"><i class="icon-signal icon-white"></i><span> Grafik Kunjungan Mingguan</span></a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/grafik_kunjungan_bulanan"><i class="icon-signal icon-white"></i><span> Grafik Kunjungan Bulanan</span></a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/grafik_kunjungan_tahunan"><i class="icon-signal icon-white"></i><span> Grafik Kunjungan Tahunan</span></a>
						</li>
					</ul>
				</li>

				<li class='active'>
					<a href="#"><i class="icon-wrench icon-white"></i><span>Tools</span><span class="label">3</span></a>
					<ul class="subnav">
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/backup"><i class="icon-leaf icon-white"></i><span> Backup Data</span></a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/users"><i class="icon-user icon-white"></i><span> Manajemen User</span></a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->baseUrl; ?>/pengaturan"><i class="icon-wrench icon-white"></i><span> Pengaturan</span></a>
						</li>
					</ul>
				</li>
				<?php
					}
				?>

			</ul>

			<div class="status button">
				<div class="status-top">
					<div class="left">
						© <?php echo date('Y'); ?> - <?php echo $_SESSION['site_name']; ?>. <a href="http://gedelumbung.com" target="_blank">DLMBG</a>.
					</div>
				</div>
			</div>
			
		</div>
		<div id="content">

			<div class="container-fluid" id="content-area">
				
				<div class="row-fluid">

					<div class="span12">
						<?php
							$this->beginWidget('zii.widgets.CPortlet', array(
								'title'=>'',
							));
							$this->widget('zii.widgets.CMenu', array(
								'items'=>$this->menu,
								'htmlOptions'=>array('class'=>'button'),
							));
							$this->endWidget();
						?>
						
						<?php echo $content; ?>
					</div>

				</div>
			</div>


		</div>
	</div>
	<script type="text/javascript">
		var baseUrl = "<?php echo Yii::app()->baseUrl; ?>";
	</script>
</body>

</html>