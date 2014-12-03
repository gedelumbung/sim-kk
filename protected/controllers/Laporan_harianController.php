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
		$this->widget('SetConfig');
	}

	public function actionIndex()
	{
		$graph = Yii::app()->db->createCommand('SELECT SUBSTRING(a.created_at,1,7) as created, a.id_master_transaksi, a.total, b.komisi_dokter, b.komisi_perawat FROM `tbl_master_transaksi` a left join tbl_perawatan b on a.id_perawatan=b.id_perawatan WHERE SUBSTRING(a.created_at,1,4) = "2014" order by SUBSTRING(a.created_at,1,7) ASC')->queryAll();

		$keuntungan = 0;
		$arr = array();
		foreach($graph as $g){
			$dokter = Yii::app()->db->createCommand('SELECT count(a.id_master_transaksi) as jum_dokter FROM tbl_transaksi_dokter a where id_master_transaksi="'.$g['id_master_transaksi'].'"')->queryAll();
			
			$perawat = Yii::app()->db->createCommand('SELECT count(a.id_master_transaksi) as jum_perawat FROM tbl_transaksi_perawat a where id_master_transaksi="'.$g['id_master_transaksi'].'"')->queryAll();
			
			$obat = Yii::app()->db->createCommand('select y.keuntungan*x.jumlah as total_keuntungan, y.harga_jual*x.jumlah as total_jual_obat, y.harga_pokok*x.jumlah as total_pokok_obat  from tbl_transaksi_obat x left join tbl_barang y on x.id_obat=y.id_barang where x.id_master_transaksi="'.$g['id_master_transaksi'].'"')->queryAll();

			$komisi_dokter = $dokter[0]['jum_dokter']*$g['komisi_dokter'];
			$komisi_perawat = $perawat[0]['jum_perawat']*$g['komisi_perawat'];
			$total_keuntungan = 0;
			$total_pokok_obat = 0;
			$total_jual_obat = 0;
			foreach($obat as $o){
				$total_pokok_obat = $total_pokok_obat+$o['total_pokok_obat'];
				$total_jual_obat = $total_jual_obat+$o['total_jual_obat'];
				$total_keuntungan = $total_keuntungan+$o['total_keuntungan'];
			}
			$d['created_at'] = $g['created'];
			$d['keuntungan'] = $g['total']-($total_jual_obat-($total_jual_obat-$total_pokok_obat))-$komisi_dokter-$komisi_perawat;
			array_push($arr, $d);
		}
		//var_dump($arr);
		$hasil = array();
		$temp = '';
		foreach($arr as $key=>$s){
			if(count($hasil)>0){
				foreach($hasil as $k=>$h){
					if($temp == $s['created_at']){
						$i['created_at'] = $h['created_at'];
						$i['keuntungan'] = $h['keuntungan']+$s['keuntungan'];
						array_pop($hasil);
						array_push($hasil, $i);

					}
					else{
						$temp = $s['created_at'];
						array_push($hasil, $s);
					}
				}
			}
			else{
				$temp = $s['created_at'];
				array_push($hasil, $s);
			}
		}
		var_dump($hasil);
		//echo $keuntungan;

		//$this->render('index');
	}
}