<?php

class Grafik_kunjungan_mingguanController extends Controller
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
		$mingguan_start = (array_key_exists('mingguan_start',$_SESSION) ? $_SESSION['mingguan_start'].' 00:00:00' : date('d/m/Y H:i:s'));
		$mingguan_end = (array_key_exists('mingguan_end',$_SESSION) ? $_SESSION['mingguan_end'].' 23:59:59' : date('d/m/Y H:i:s'));

		$mingguan_start_to_str = strtotime(str_replace("/", "-", $mingguan_start));
		$mingguan_end_to_str = strtotime(str_replace("/", "-", $mingguan_end));

		$graph = $list= Yii::app()->db->createCommand('SELECT count(id_master_transaksi) as jumlah_pasien, SUBSTRING(created_at,9,2) as tanggal FROM `tbl_master_transaksi` WHERE UNIX_TIMESTAMP(created_at)>='.$mingguan_start_to_str.' and UNIX_TIMESTAMP(created_at)<='.$mingguan_end_to_str.' group by SUBSTRING(created_at,6,5) order by tanggal ASC')->queryAll();

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

	public function actionSet()
	{
		$_SESSION['mingguan_start'] = $_POST['mingguan_start'];
		$_SESSION['mingguan_end'] = $_POST['mingguan_end'];

		$this->redirect(array("grafik_kunjungan_mingguan/index"));
	}
}