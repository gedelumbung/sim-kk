<?php
	Yii::app()->clientscript
		// use it when you need it!
		
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap.css' )
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.css' )
      	->registerCssFile( Yii::app()->theme->baseUrl . '/css/font-awesome/css/font-awesome.min.css')
		->registerCoreScript( 'jquery' )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-transition.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-alert.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-modal.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-dropdown.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-scrollspy.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tab.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tooltip.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-popover.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-button.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-collapse.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-carousel.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-typeahead.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/angular.js')
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/custom/module.angular.js')
		
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" ng-app="App">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="language" content="en" />
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Le styles -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
<!-- Le fav and touch icons -->
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="#"><?php echo Yii::app()->name ?></a>
				<div class="nav-collapse">
				<?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'nav pull-right'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>'<i class="fa fa-institution"></i> Dashboard', 'url'=>array('/site/index')),
                        array('label'=>'<i class="fa fa-cube"></i> Master Data <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                            array('label'=>'<i class="fa fa-cube"></i> Data Pasien', 'url'=>array('/pasien')),
                            array('label'=>'<i class="fa fa-cube"></i> Data Barang', 'url'=>array('/barang')),
                            array('label'=>'<i class="fa fa-cube"></i> Data Dokter', 'url'=>array('/dokter')),
                            array('label'=>'<i class="fa fa-cube"></i> Data Perawat', 'url'=>array('/perawat')),
                        ), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'<i class="fa fa-tags"></i> Transaksi <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                            array('label'=>'<i class="fa fa-cube"></i> History Pasien', 'url'=>array('/history_pasien')),
                            array('label'=>'<i class="fa fa-cube"></i> Diskon', 'url'=>array('/diskon')),
                        ), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'<i class="fa fa-list"></i> Laporan <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                            array('label'=>'<i class="fa fa-cube"></i> Laporan Harian', 'url'=>array('/provinsi')),
                            array('label'=>'<i class="fa fa-cube"></i> Laporan Mingguan', 'url'=>array('/kabupaten')),
                            array('label'=>'<i class="fa fa-cube"></i> Laporan Bulanan', 'url'=>array('/kabupaten')),
                            array('label'=>'<i class="fa fa-cube"></i> Laporan Tahunan', 'url'=>array('/kabupaten')),
                        ), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'<i class="fa fa-wrench"></i> Tools <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                            array('label'=>'<i class="fa fa-cube"></i> Backup Data', 'url'=>array('/backup')),
                        ), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'<i class="fa fa-user"></i> Pengguna', 'url'=>array('/users'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'<i class="fa fa-user"></i> Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'<i class="fa fa-share"></i> Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    ),
                )); ?>
					
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	
	<div class="cont">
	<div class="container-fluid">
	  <?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
				'homeLink'=>false,
				'tagName'=>'ul',
				'separator'=>'',
				'activeLinkTemplate'=>'<li><a href="{url}">{label}</a> <span class="divider">/</span></li>',
				'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
				'htmlOptions'=>array ('class'=>'breadcrumb')
			)); ?>
		<!-- breadcrumbs -->
	  <?php endif?>
	
	<?php echo $content ?>
	
	
	</div><!--/.fluid-container-->
	</div>
	
	<div class="extra">
	  <div class="container">
		</div> <!-- /container -->
	</div>
	
	<div class="footer">
	  <div class="container">
		<div class="row">
			<div id="footer-terms" class="col-md-12">
				© <?php echo date('Y'); ?> - <?php echo CHtml::encode($this->pageTitle); ?>. <a href="http://gedelumbung.com" target="_blank">DLMBG</a>.
			</div> <!-- /.span6 -->
		 </div> <!-- /row -->
	  </div> <!-- /container -->
	</div>
	<script type="text/javascript">
		var baseUrl = "<?php echo Yii::app()->baseUrl; ?>";
	</script>
</body>
</html>
