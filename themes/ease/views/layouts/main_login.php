<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title><?php echo $_SESSION['site_name']; ?></title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/asset/css/bootstrap.min.css" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/asset/css/bootstrap-responsive.min.css" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/asset/css/style.css" />

</head>
<body class='login-body'>
	<?php echo $content; ?>
</body>

</html>