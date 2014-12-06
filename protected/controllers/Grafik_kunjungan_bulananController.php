<?php

class Grafik_kunjungan_bulananController extends Controller
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
		$bulanan_start = (array_key_exists('bulanan_start',$_SESSION) ? $_SESSION['bulanan_start'] : date('m'));
		$bulanan_end = (array_key_exists('bulanan_end',$_SESSION) ? $_SESSION['bulanan_end'] : date('m'));
		$bulanan_tahun = (array_key_exists('bulanan_tahun',$_SESSION) ? $_SESSION['bulanan_tahun'] : date('Y'));

		$in_date = '';
		for($i=(int)$bulanan_start; $i<=$bulanan_end; $i++){
			if($i<10){
				$i = '0'.$i;
			}
			if(empty($in_date)){
				$in_date = '"'.$bulanan_tahun.'-'.$i.'"';
			}
			else{
				$in_date .= ',"'.$bulanan_tahun.'-'.$i.'"';
			}
		}

		$graph = Yii::app()->db->createCommand('SELECT count(id_master_transaksi) as jumlah_pasien, SUBSTRING(created_at,6,2) as bulan FROM `tbl_master_transaksi` WHERE SUBSTRING(created_at,1,7) in ('.$in_date.') group by SUBSTRING(created_at,1,7)')->queryAll();


		$arr_date = array();
		$arr_total = array();
		foreach($graph as $g){
			array_push($arr_date, $this->Bulan($g['bulan']-1));
			array_push($arr_total, (int) $g['jumlah_pasien']);
		}

		$this->render('index', array(
				'arr_date' => $arr_date,
				'arr_total' => $arr_total,
			));
	}

	public function actionSet()
	{
		$_SESSION['bulanan_start'] = $_POST['bulanan_start'];
		$_SESSION['bulanan_end'] = $_POST['bulanan_end'];
		$_SESSION['bulanan_tahun'] = $_POST['bulanan_tahun'];

		$this->redirect(array("grafik_kunjungan_bulanan/index"));
	}

    protected function Bulan($bulan)
    {
        $list_bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        return($list_bulan[$bulan]);
    }
}