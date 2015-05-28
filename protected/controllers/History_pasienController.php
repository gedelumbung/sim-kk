<?php

class History_pasienController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';

	public function init()
	{
		if (Yii::app()->user->isGuest) 
		{
			$this->redirect(array("site/login"));
		}
		if (Yii::app()->user->status !== 'owner' && Yii::app()->user->status !== 'kasir') 
		{
			$this->redirect(array("dashboard/index"));
		}
		$this->widget('SetConfig');
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','cetak', 'by_pasien'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'		=>$this->loadModel($id),
			'dokter'	=>$this->loadModelDetailDokter($id),
			'perawat'	=>$this->loadModelDetailPerawat($id),
			'obat'		=>$this->loadModelDetailObat($id),
			'perawatan'	=>$this->loadModelDetailPerawatan($id),
		));
	}

	public function actionCetak($id)
	{
		$this->renderPartial('cetak',array(
			'model'		=>$this->loadModel($id),
			'dokter'	=>$this->loadModelDetailDokter($id),
			'perawat'	=>$this->loadModelDetailPerawat($id),
			'obat'		=>$this->loadModelDetailObat($id),
			'perawatan'	=>$this->loadModelDetailPerawatan($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new MasterTransaksi;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['MasterTransaksi']))
		{		
			$model->attributes=$_POST['MasterTransaksi'];
			$model->created_at = date('Y-m-d H:i:s');
			$model->updated_at = date('Y-m-d H:i:s');
			if($model->save())
			{
				//save dokter
				$model_dokter = json_decode($_POST['MasterTransaksi']['dokter'],true);

				for($a = 0; $a<count($model_dokter); $a++){
					$m_dokter = new TransaksiDokter;
					$m_dokter->id_master_transaksi 	= $model->id_master_transaksi;
					$m_dokter->id_dokter 			= $model_dokter[$a]['id_dokter'];
					$m_dokter->created_at 			= date('Y-m-d H:i:s');

					$m_dokter->save();
				}	

				//save perawat
				$model_perawat = json_decode($_POST['MasterTransaksi']['perawat'],true);

				for($a = 0; $a<count($model_perawat); $a++){
					$m_perawat = new TransaksiPerawat;
					$m_perawat->id_master_transaksi = $model->id_master_transaksi;
					$m_perawat->id_perawat 			= $model_perawat[$a]['id_perawat'];
					$m_perawat->created_at 			= date('Y-m-d H:i:s');

					$m_perawat->save();
				}	

				//save obat
				$model_obat = json_decode($_POST['MasterTransaksi']['obat'],true);

				for($a = 0; $a<count($model_obat); $a++){
					$m_obat = new TransaksiObat;
					$m_obat->id_master_transaksi 	= $model->id_master_transaksi;
					$m_obat->id_obat 				= $model_obat[$a]['id_obat'];
					$m_obat->jumlah 				= $model_obat[$a]['jumlah'];
					$m_obat->created_at 			= date('Y-m-d H:i:s');

					$m_obat->save();

					//update stok barang
					Yii::app()->db->createCommand("update tbl_barang set stok=stok-".$m_obat->jumlah." where id_barang='".$m_obat->id_obat."'")->execute();
				}	

				//save perawatan
				$model_perawatan = json_decode($_POST['MasterTransaksi']['perawatan'],true);

				for($a = 0; $a<count($model_perawatan); $a++){
					$m_perawatan = new TransaksiPerawatan;
					$m_perawatan->id_master_transaksi 	= $model->id_master_transaksi;
					$m_perawatan->id_perawatan 			= $model_perawatan[$a]['id'];
					$m_perawatan->created_at 			= date('Y-m-d H:i:s');

					$m_perawatan->save();

				}	

				$this->redirect(array('view','id'=>$model->id_master_transaksi));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MasterTransaksi']))
		{
			$model->attributes=$_POST['MasterTransaksi'];
			$model->updated_at = date('Y-m-d H:i:s');
			
			if($model->save())
			{
				//delete dokter
				$this->loadModelDeleteDokter($id);
				//save dokter
				$model_dokter = json_decode($_POST['MasterTransaksi']['dokter'],true);

				for($a = 0; $a<count($model_dokter); $a++){
					$m_dokter = new TransaksiDokter;
					$m_dokter->id_master_transaksi 	= $model->id_master_transaksi;
					$m_dokter->id_dokter 			= $model_dokter[$a]['id_dokter'];
					$m_dokter->created_at 			= date('Y-m-d H:i:s');

					$m_dokter->save();
				}	

				//delete perawat
				$this->loadModelDeletePerawat($id);
				//save perawat
				$model_perawat = json_decode($_POST['MasterTransaksi']['perawat'],true);

				for($a = 0; $a<count($model_perawat); $a++){
					$m_perawat = new TransaksiPerawat;
					$m_perawat->id_master_transaksi = $model->id_master_transaksi;
					$m_perawat->id_perawat 			= $model_perawat[$a]['id_perawat'];
					$m_perawat->created_at 			= date('Y-m-d H:i:s');

					$m_perawat->save();
				}	

				//delete obat
				$this->loadModelDeleteObat($id);
				//save obat
				$model_obat = json_decode($_POST['MasterTransaksi']['obat'],true);

				for($a = 0; $a<count($model_obat); $a++){
					$m_obat = new TransaksiObat;
					$m_obat->id_master_transaksi 	= $model->id_master_transaksi;
					$m_obat->id_obat 				= $model_obat[$a]['id_obat'];
					$m_obat->jumlah 				= $model_obat[$a]['jumlah'];
					$m_obat->created_at 			= date('Y-m-d H:i:s');

					$m_obat->save();

					//update stok barang
					Yii::app()->db->createCommand("update tbl_barang set stok=stok-".$m_obat->jumlah." where id_barang='".$m_obat->id_obat."'")->execute();
				}	

				//delete perawatan
				$this->loadModelDeletePerawatan($id);
				//save perawatan
				$model_perawatan = json_decode($_POST['MasterTransaksi']['perawatan'],true);

				for($a = 0; $a<count($model_perawatan); $a++){
					$m_perawatan = new TransaksiPerawatan;
					$m_perawatan->id_master_transaksi 	= $model->id_master_transaksi;
					$m_perawatan->id_perawatan 			= $model_perawatan[$a]['id'];
					$m_perawatan->created_at 			= date('Y-m-d H:i:s');

					$m_perawatan->save();

					$model_obat_perawatan = $model_perawatan[$a]['obat'];

					for($b = 0; $b<count($model_obat_perawatan); $b++){
						$m_obat_perawatan = new TransaksiObatDalam;
						$m_obat_perawatan->id_transaksi_perawatan 	= $m_perawatan->id_transaksi_perawatan;
						$m_obat_perawatan->id_obat 					= $model_obat_perawatan[$b]['id_obat'];
						$m_obat_perawatan->jumlah 					= $model_obat_perawatan[$b]['jumlah'];
						$m_obat_perawatan->created_at 				= date('Y-m-d H:i:s');

						$m_obat_perawatan->save();
					
						//update stok barang
						Yii::app()->db->createCommand("update tbl_barang_dalam set stok=stok-".$m_obat_perawatan->jumlah." where id_barang_dalam='".$m_obat_perawatan->id_obat."'")->execute();

					}
				}

				$this->redirect(array('view','id'=>$model->id_master_transaksi));
			}
		}

		$m_dokter = $this->loadModelDetailDokter($id);
		$arr_dokter = array();
		foreach($m_dokter as $md){
			$d['id_dokter'] = $md->id_dokter;

			array_push($arr_dokter, $d);
		}

		$m_perawat = $this->loadModelDetailPerawat($id);
		$arr_perawat= array();
		foreach($m_perawat as $mp){
			$d['id_perawat'] = $mp->id_perawat;

			array_push($arr_perawat, $d);
		}

		$m_obat = $this->loadModelDetailObat($id);
		$arr_obat= array();
		foreach($m_obat as $mo){
			$d['id_obat'] = $mo->id_obat;
			$d['harga'] = $mo->Barang->harga_jual - (($mo->Barang->harga_jual*$mo->Barang->diskon)/100);
			$d['diskon'] = $mo->Barang->diskon.'%';
			$d['jumlah'] = $mo->jumlah;

			array_push($arr_obat, $d);
		}

		$m_perawatan = $this->loadModelDetailPerawatan($id);
		$arr_perawatan = array();

		$member = $model->Pasien->member;

		$diskon = 0;

		foreach($m_perawatan as $mp){

			$perawatan=Perawatan::model()->findByPk($mp->id_perawatan);

			if($member === 'Tidak'){
				$diskon = $perawatan->diskon_umum;
			}
			else{
				if($perawatan->diskon_umum > $perawatan->diskon_member){
					$diskon = $perawatan->diskon_umum;
				}
				else{
					$diskon = $perawatan->diskon_member;
				}
			}

			$d['id'] 				= $mp->id_perawatan;
			$d['diskon'] 			= $diskon;
			$d['harga'] 			= ($perawatan->harga - ($perawatan->harga/100*$diskon));
			$d['komisi_dokter'] 	= $mp->Perawatan->komisi_dokter;
			$d['komisi_perawat'] 	= $mp->Perawatan->komisi_perawat;
			$d['obat']				= array();

			$criteria = new CDbCriteria();
			$criteria->condition = "id_perawatan = '".$mp->id_perawatan."'";
			$m_obat_perawatan=ObatPerawatan::model()->findAll($criteria);
			foreach ($m_obat_perawatan as $key => $op) {
				$d_op['id_obat'] = $op->id_obat;
				$d_op['jumlah'] = $op->jumlah;
				$d_op['nama_barang'] = $op->BarangDalam->nama_barang;
				$d_op['harga'] = ($op->BarangDalam->harga_jual-($op->BarangDalam->harga_jual*$op->BarangDalam->diskon/100))*$op->jumlah;

				array_push($d['obat'], $d_op);
			}

			array_push($arr_perawatan, $d);
		}

		$fetch_detail['biaya'] = $model->biaya;
		$fetch_detail['hutang'] = $model->hutang;
		$fetch_detail['total'] = $model->total;
		$fetch_detail['total_bayar'] = $model->total_bayar;
		$fetch_detail['id_pasien'] = $model->id_pasien;

		$this->render('update',array(
			'model'=>$model,
			'arr_dokter'=>$arr_dokter,
			'arr_perawat'=>$arr_perawat,
			'arr_obat'=>$arr_obat,
			'arr_perawatan'=>$arr_perawatan,
			'm_array'=>$fetch_detail,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new MasterTransaksi('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MasterTransaksi']))
			$model->attributes=$_GET['MasterTransaksi'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionBy_pasien($id)
	{
		$model=new MasterTransaksi('search_pasien');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MasterTransaksi']))
			$model->attributes=$_GET['MasterTransaksi'];

		$this->render('pasien',array(
			'model'=>$model,
			'id'=>$id,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MasterTransaksi('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MasterTransaksi']))
			$model->attributes=$_GET['MasterTransaksi'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MasterTransaksi the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=MasterTransaksi::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelDetailDokter($id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "id_master_transaksi = '".$id."'";
		$model=TransaksiDokter::model()->findAll($criteria);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelDetailPerawat($id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "id_master_transaksi = '".$id."'";
		$model=TransaksiPerawat::model()->findAll($criteria);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelDetailObat($id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "id_master_transaksi = '".$id."'";
		$model=TransaksiObat::model()->findAll($criteria);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelDetailPerawatan($id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "id_master_transaksi = '".$id."'";
		$model=TransaksiPerawatan::model()->findAll($criteria);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelObatDalam($id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "id_transaksi_perawatan = '".$id."'";
		$model=TransaksiObatDalam::model()->findAll($criteria);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelDeleteDokter($id)
	{
		$model = $this->loadModelDetailDokter($id);
		foreach($model as $md){
			TransaksiDokter::model()->findByPk($md->id_transaksi_dokter)->delete();
		}
		return;
	}

	public function loadModelDeletePerawat($id)
	{
		$model = $this->loadModelDetailPerawat($id);
		foreach($model as $md){
			TransaksiPerawat::model()->findByPk($md->id_transaksi_perawat)->delete();
		}
		return;
	}

	public function loadModelDeleteObat($id)
	{
		$model = $this->loadModelDetailObat($id);
		foreach($model as $md){
			$m_transaksi_obat = TransaksiObat::model()->findByPk($md->id_transaksi_obat);

			$this->updateObatBeforeDelete($md->id_obat, $md->jumlah);

			$m_transaksi_obat->delete();
		}
		return;
	}

	public function loadModelDeletePerawatan($id)
	{
		$model = $this->loadModelDetailPerawatan($id);
		foreach($model as $md){
			$m_transaksi_perawatan = TransaksiPerawatan::model()->findByPk($md->id_transaksi_perawatan);

			$m_obat_dalam = $this->loadModelObatDalam($md->id_transaksi_perawatan);

			foreach ($m_obat_dalam as $key => $od) {
				$m_transaksi_obat_perawatan = TransaksiObatDalam::model()->findByPk($od->id_transaksi_obat_dalam);
				$this->updateObatDalamBeforeDelete($m_transaksi_obat_perawatan->id_obat, $m_transaksi_obat_perawatan->jumlah);
				$m_transaksi_obat_perawatan->delete();
			}

			$m_transaksi_perawatan->delete();
			
		}
		return;
	}

	public function updateObatBeforeDelete($id, $stok)
	{
		$model = $this->loadModelBarang($id);
		$model->stok = $model->stok+$stok;
		$model->save();
		return;
	}

	public function updateObatDalamBeforeDelete($id, $stok)
	{
		$model = $this->loadModelBarangDalam($id);
		$model->stok = $model->stok+$stok;
		$model->save();
		return;
	}

	public function loadModelBarang($id)
	{
		$model=Barang::model()->findByPk($id);
		return $model;
	}

	public function loadModelBarangDalam($id)
	{
		$model=BarangDalam::model()->findByPk($id);
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MasterTransaksi $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='master-transaksi-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
