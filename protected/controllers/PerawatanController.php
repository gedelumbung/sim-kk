<?php

class PerawatanController extends Controller
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
				'actions'=>array('index','view','get_detail'),
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
		if (Yii::app()->user->status !== 'owner' && Yii::app()->user->status !== 'admin') 
		{
			$this->redirect(array("dashboard/index"));
		}
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionGet_Detail($id)
	{
		$model = $this->loadModel($id);

		$member = Yii::app()->request->getParam('member');

		if($member === 'false'){
			$data['diskon'] = $model->diskon_umum;
		}
		else{
			if($model->diskon_umum > $model->diskon_member){
				$data['diskon'] = $model->diskon_umum;
			}
			else{
				$data['diskon'] = $model->diskon_member;
			}
		}

		$data['id'] = $model->id_perawatan;
		$data['harga'] = $model->harga - ($model->harga/100*$data['diskon']);
		$data['komisi_dokter'] = $model->komisi_dokter;
		$data['komisi_perawat'] = $model->komisi_perawat;

		$m_obat = $this->loadModelDetailObat($id);
		$arr_obat= array();
		foreach($m_obat as $mo){
			$d['id_obat'] = $mo->id_obat;
			$d['nama_barang'] = $mo->BarangDalam->nama_barang;
			$d['harga'] = ($mo->BarangDalam->harga_jual - (($mo->BarangDalam->harga_jual*$mo->BarangDalam->diskon)/100))*$mo->jumlah;
			$d['diskon'] = $mo->BarangDalam->diskon.'%';
			$d['jumlah'] = $mo->jumlah;

			array_push($arr_obat, $d);
		}

		$data['obat'] = $arr_obat;

		echo json_encode($data,true);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		if (Yii::app()->user->status !== 'owner' && Yii::app()->user->status !== 'admin') 
		{
			$this->redirect(array("dashboard/index"));
		}
		$model=new Perawatan;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Perawatan']))
		{
			$model->attributes=$_POST['Perawatan'];
			$model->created_at = date('Y-m-d H:i:s');
			$model->updated_at = date('Y-m-d H:i:s');
			if($model->save())
			{
				//save obat
				$model_obat = json_decode($_POST['Perawatan']['obat'],true);

				for($a = 0; $a<count($model_obat); $a++){
					$m_obat = new ObatPerawatan;
					$m_obat->id_perawatan 			= $model->id_perawatan;
					$m_obat->id_obat 				= $model_obat[$a]['id_obat'];
					$m_obat->jumlah 				= $model_obat[$a]['jumlah'];
					$m_obat->created_at 			= date('Y-m-d H:i:s');

					$m_obat->save();

					//update stok barang
					Yii::app()->db->createCommand("update tbl_barang_dalam set stok=stok-".$m_obat->jumlah." where id_barang_dalam='".$m_obat->id_obat."'")->execute();
				}	
				$this->redirect(array('view','id'=>$model->id_perawatan));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'arr_obat' => array()
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		if (Yii::app()->user->status !== 'owner' && Yii::app()->user->status !== 'admin') 
		{
			$this->redirect(array("dashboard/index"));
		}
		$model=$this->loadModel($id);

		$m_obat = $this->loadModelDetailObat($id);
		$arr_obat= array();
		foreach($m_obat as $mo){
			$d['id_obat'] = $mo->id_obat;
			$d['harga'] = $mo->BarangDalam->harga_jual - (($mo->BarangDalam->harga_jual*$mo->BarangDalam->diskon)/100);
			$d['diskon'] = $mo->BarangDalam->diskon.'%';
			$d['jumlah'] = $mo->jumlah;

			array_push($arr_obat, $d);
		}

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Perawatan']))
		{
			$model->attributes=$_POST['Perawatan'];
			$model->updated_at = date('Y-m-d H:i:s');
			if($model->save()){

				//delete obat
				$this->loadModelDeleteObat($id);
				//save obat
				$model_obat = json_decode($_POST['Perawatan']['obat'],true);

				for($a = 0; $a<count($model_obat); $a++){
					$m_obat = new ObatPerawatan;
					$m_obat->id_perawatan 			= $model->id_perawatan;
					$m_obat->id_obat 				= $model_obat[$a]['id_obat'];
					$m_obat->jumlah 				= $model_obat[$a]['jumlah'];
					$m_obat->created_at 			= date('Y-m-d H:i:s');

					$m_obat->save();

					//update stok barang
					Yii::app()->db->createCommand("update tbl_barang set stok=stok-".$m_obat->jumlah." where id_barang='".$m_obat->id_obat."'")->execute();
				}	

				$this->redirect(array('view','id'=>$model->id_perawatan));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'arr_obat' => $arr_obat
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->user->status !== 'owner' && Yii::app()->user->status !== 'admin') 
		{
			$this->redirect(array("dashboard/index"));
		}
		$this->loadModelDeleteObat($id);
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
		if (Yii::app()->user->status !== 'owner' && Yii::app()->user->status !== 'admin') 
		{
			$this->redirect(array("dashboard/index"));
		}
		$model=new Perawatan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Perawatan']))
			$model->attributes=$_GET['Perawatan'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		if (Yii::app()->user->status !== 'owner' && Yii::app()->user->status !== 'admin') 
		{
			$this->redirect(array("dashboard/index"));
		}
		$model=new Perawatan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Perawatan']))
			$model->attributes=$_GET['Perawatan'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Perawatan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Perawatan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelObat($id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "id_perawatan = '".$id."'";
		$model=ObatPerawatan::model()->findAll($criteria);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelDetailObat($id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "id_perawatan = '".$id."'";
		$model=ObatPerawatan::model()->findAll($criteria);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelDeleteObat($id)
	{
		$model = $this->loadModelDetailObat($id);
		foreach($model as $md){
			$m_transaksi_obat = ObatPerawatan::model()->findByPk($md->id_obat_perawatan);

			$this->updateObatBeforeDelete($md->id_obat, $md->jumlah);

			$m_transaksi_obat->delete();
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

	public function loadModelBarang($id)
	{
		$model=BarangDalam::model()->findByPk($id);
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Perawatan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='perawatan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
