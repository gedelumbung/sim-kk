<?php

class Laporan_harianController extends Controller
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
		$laporan_harian_start = (array_key_exists('laporan_harian_start',$_SESSION) ? $_SESSION['laporan_harian_start'].' 00:00:00' : date('d/m/Y H:i:s'));

		$laporan_harian_start_to_str = substr(str_replace("/", "-", $laporan_harian_start), 5,5);

		$graph = Yii::app()->db->createCommand('SELECT SUBSTRING(a.created_at,9,2) as created, a.id_master_transaksi, a.total, b.member, b.nama FROM `tbl_master_transaksi` a left join tbl_pasien b on a.id_pasien = b.id_pasien  WHERE SUBSTRING(a.created_at,6,5) ="'.$laporan_harian_start_to_str.'" order by created ASC')->queryAll();

		$keuntungan = 0;
		$arr = array();
		foreach($graph as $g){
			$dokter = Yii::app()->db->createCommand('SELECT count(a.id_master_transaksi) as jum_dokter FROM tbl_transaksi_dokter a where id_master_transaksi="'.$g['id_master_transaksi'].'"')->queryAll();
			
			$perawat = Yii::app()->db->createCommand('SELECT count(a.id_master_transaksi) as jum_perawat FROM tbl_transaksi_perawat a where id_master_transaksi="'.$g['id_master_transaksi'].'"')->queryAll();
			
			$perawatan = Yii::app()->db->createCommand('SELECT b.komisi_dokter, b.komisi_perawat, a.id_perawatan, b.nama_perawatan FROM tbl_transaksi_perawatan a left join tbl_perawatan b on a.id_perawatan = b.id_perawatan where id_master_transaksi="'.$g['id_master_transaksi'].'"')->queryAll();

			$komisi_dokter = 0;
			$komisi_perawat = 0;
			$biaya_perawatan = 0;
			$biaya_obat_dalam = 0;

			$nama_perawatan = '';

			foreach ($perawatan as $key => $p) {
				$komisi_dokter = $komisi_dokter+$p['komisi_dokter'];
				$komisi_perawat = $komisi_perawat+$p['komisi_perawat'];

				$nama_perawatan .= $p['nama_perawatan'].',';
			
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
			$d['nama_pasien'] = $g['nama'];
			$d['perawatan'] = $nama_perawatan;
			array_push($arr, $d);
		}

		$this->render('index', array(
				'arr' => $arr,
			));
	}

	public function actionSet()
	{
		$_SESSION['laporan_harian_start'] = $_POST['laporan_harian_start'];

		$this->redirect(array("laporan_harian/index"));
	}
}