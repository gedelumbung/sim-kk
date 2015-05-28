<?php

class Laporan_bulananController extends Controller
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
		$laporan_bulanan_start = (array_key_exists('laporan_bulanan_start',$_SESSION) ? $_SESSION['laporan_bulanan_start'] : date('m'));
		$laporan_bulanan_end = (array_key_exists('laporan_bulanan_end',$_SESSION) ? $_SESSION['laporan_bulanan_end'] : date('m'));
		$laporan_bulanan_tahun = (array_key_exists('laporan_bulanan_tahun',$_SESSION) ? $_SESSION['laporan_bulanan_tahun'] : date('Y'));

		$in_date = '';
		for($i=(int)$laporan_bulanan_start; $i<=$laporan_bulanan_end; $i++){
			if($i<10){
				$i = '0'.$i;
			}
			if(empty($in_date)){
				$in_date = '"'.$laporan_bulanan_tahun.'-'.$i.'"';
			}
			else{
				$in_date .= ',"'.$laporan_bulanan_tahun.'-'.$i.'"';
			}
		}

		$graph = Yii::app()->db->createCommand('SELECT SUBSTRING(a.created_at,1,7) as created, a.id_master_transaksi, a.total, b.member FROM `tbl_master_transaksi` a left join tbl_pasien b on a.id_pasien = b.id_pasien WHERE SUBSTRING(a.created_at,1,7) in ('.$in_date.') order by SUBSTRING(a.created_at,1,7) ASC')->queryAll();

		$keuntungan = 0;
		$arr = array();
		foreach($graph as $g){
			$dokter = Yii::app()->db->createCommand('SELECT count(a.id_master_transaksi) as jum_dokter FROM tbl_transaksi_dokter a where id_master_transaksi="'.$g['id_master_transaksi'].'"')->queryAll();
			
			$perawat = Yii::app()->db->createCommand('SELECT count(a.id_master_transaksi) as jum_perawat FROM tbl_transaksi_perawat a where id_master_transaksi="'.$g['id_master_transaksi'].'"')->queryAll();
			
			$perawatan = Yii::app()->db->createCommand('SELECT b.komisi_dokter, b.komisi_perawat, a.id_perawatan FROM tbl_transaksi_perawatan a left join tbl_perawatan b on a.id_perawatan = b.id_perawatan where id_master_transaksi="'.$g['id_master_transaksi'].'"')->queryAll();

			$komisi_dokter = 0;
			$komisi_perawat = 0;
			$biaya_perawatan = 0;
			$biaya_obat_dalam = 0;

			foreach ($perawatan as $key => $p) {
				$komisi_dokter = $komisi_dokter+$p['komisi_dokter'];
				$komisi_perawat = $komisi_perawat+$p['komisi_perawat'];
			
				$obat_dalam = Yii::app()->db->createCommand('select y.keuntungan*x.jumlah as total_keuntungan, y.harga_jual*x.jumlah as total_jual_obat, y.harga_pokok*x.jumlah as total_pokok_obat  from tbl_obat_perawatan x left join tbl_barang_dalam y on x.id_obat=y.id_barang_dalam where x.id_perawatan="'.$p['id_perawatan'].'"')->queryAll();
				
				foreach ($obat_dalam as $key => $od) {
					$biaya_obat_dalam = $biaya_obat_dalam+$od['total_pokok_obat'];
				}
			}
			
			$obat = Yii::app()->db->createCommand('select y.keuntungan*x.jumlah as total_keuntungan, y.harga_jual*x.jumlah as total_jual_obat, y.harga_pokok*x.jumlah as total_pokok_obat  from tbl_transaksi_obat x left join tbl_barang y on x.id_obat=y.id_barang where x.id_master_transaksi="'.$g['id_master_transaksi'].'"')->queryAll();

			$komisi_dokter = $dokter[0]['jum_dokter']*$komisi_dokter;
			$komisi_perawat = $perawat[0]['jum_perawat']*$komisi_perawat;
			$total_pokok_obat = 0;
			$total_jual_obat = 0;
			foreach($obat as $o){
				$total_pokok_obat = $total_pokok_obat+$o['total_pokok_obat'];
				$total_jual_obat = $total_jual_obat+$o['total_jual_obat'];
			}
			$d['created_at'] = $g['created'];
			$d['keuntungan'] = $g['total']-($total_jual_obat-($total_jual_obat-$total_pokok_obat))-$biaya_obat_dalam-$komisi_dokter-$komisi_perawat;
			$d['penjualan'] = $g['total'];
			array_push($arr, $d);
		}
		$hasil = array();
		$temp = '';

		$data_summ = array();
		foreach ( $arr as $value ) {
		    $data_summ[ 'keuntungan_'.$value['created_at'] ] = 0;
		    $data_summ[ 'penjualan_'.$value['created_at'] ] = 0;
		}

		foreach ( $arr as $list ) {
		    $keuntungan = str_replace( ",", ".", $list['keuntungan'] ) * 1;
		    $penjualan = str_replace( ",", ".", $list['penjualan'] ) * 1;
		    $data_summ[ 'keuntungan_'.$list['created_at'] ] += $keuntungan;
		    $data_summ[ 'penjualan_'.$list['created_at'] ] += $penjualan;
		}

		//var_dump($data_summ);die;

		$arr_date = array();
		$arr_keuntungan = array();
		$arr_penjualan = array();
		$keys = array_keys($data_summ);
		foreach($keys as $key=>$date){
			$explode_month = explode("_", $date);

			$split_month = substr($explode_month[1], 5, 1);
			if($split_month == 0){
				$date = substr($explode_month[1], 6, 1)-1;
			}
			else{
				$date = substr($explode_month[1], 5, 2)-1;
			}
			if($key%2===0){
				array_push($arr_date, $this->Bulan($date));
			}
		}

		$n = 0;
		foreach($data_summ as $key=>$val){
			if($n%2===1){
				array_push($arr_penjualan, $val);
			}
			else{
				array_push($arr_keuntungan, $val);
			}
			$n++;
		}

		$this->render('index', array(
				'arr_date' => $arr_date,
				'arr_keuntungan' => $arr_keuntungan,
				'arr_penjualan' => $arr_penjualan,
			));
	}

	public function actionSet()
	{
		$_SESSION['laporan_bulanan_start'] = $_POST['laporan_bulanan_start'];
		$_SESSION['laporan_bulanan_end'] = $_POST['laporan_bulanan_end'];
		$_SESSION['laporan_bulanan_tahun'] = $_POST['laporan_bulanan_tahun'];

		$this->redirect(array("laporan_bulanan/index"));
	}

    protected function Bulan($bulan)
    {
        $list_bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        return($list_bulan[$bulan]);
    }
}