<?php

class Grafik_kunjungan_tahunanController extends Controller
{
	public $layout='main';

	public function init()
	{
		if (Yii::app()->user->isGuest) 
		{
			$this->redirect(array("site/login"));
		}
		if (Yii::app()->user->status !== 'owner') 
		{
			$this->redirect(array("dashboard/index"));
		}
		$this->widget('SetConfig');
	}

	public function actionIndex()
	{
		$tahunan_start = (array_key_exists('tahunan_start',$_SESSION) ? $_SESSION['tahunan_start'] : date('Y'));
		$tahunan_end = (array_key_exists('tahunan_end',$_SESSION) ? $_SESSION['tahunan_end'] : date('Y'));

		$in_date = '';

		for($i=(int)$tahunan_start; $i<=$tahunan_end; $i++){
			if($i<10){
				$i = '0'.$i;
			}
			if(empty($in_date)){
				$in_date = '"'.$i.'"';
			}
			else{
				$in_date .= ',"'.$i.'"';
			}
		}

		$graph = Yii::app()->db->createCommand('SELECT count(id_master_transaksi) as jumlah_pasien, SUBSTRING(created_at,1,4) as tahun FROM `tbl_master_transaksi` WHERE SUBSTRING(created_at,1,4) in ('.$in_date.') group by SUBSTRING(created_at,1,4)')->queryAll();


		$arr_date = array();
		$arr_total = array();
		foreach($graph as $g){
			array_push($arr_date, $g['tahun']);
			array_push($arr_total, (int) $g['jumlah_pasien']);
		}

		$this->render('index', array(
				'arr_date' => $arr_date,
				'arr_total' => $arr_total,
			));
	}

	public function actionSet()
	{
		$_SESSION['tahunan_start'] = $_POST['tahunan_start'];
		$_SESSION['tahunan_end'] = $_POST['tahunan_end'];

		$this->redirect(array("grafik_kunjungan_tahunan/index"));
	}
}