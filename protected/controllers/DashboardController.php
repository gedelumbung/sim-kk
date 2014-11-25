<?php

class DashboardController extends Controller
{
	public $layout='main';

	public function init()
	{
		if (Yii::app()->user->isGuest) 
		{
			$this->redirect(array("site/login"));
		}
		$this->widget('SetConfig');
	}

	public function actionIndex()
	{
		$graph = $list= Yii::app()->db->createCommand('SELECT count(id_master_transaksi) as jumlah_pasien, SUBSTRING(created_at,9,2) as tanggal FROM `tbl_master_transaksi` where SUBSTRING(created_at,1,7)="'.date('Y-m').'" group by SUBSTRING(created_at,9,2) order by tanggal ASC')->queryAll();

		$arr_date = array();
		$arr_total = array();
		foreach($graph as $g){
			array_push($arr_date, $g['tanggal']);
			array_push($arr_total, (int) $g['jumlah_pasien']);
		}

		$this->render('index', array(
				'arr_date' => $arr_date,
				'arr_total' => $arr_total,
			));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}