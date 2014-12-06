<?php

class ProfileController extends Controller
{
	public function init()
	{
		if (Yii::app()->user->isGuest) 
		{
			$this->redirect(array("site/index"));
		}
	}
	
	public $layout='main';

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
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$model=$this->loadModel(Yii::app()->user->id);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];

			if(!empty($_POST['Users']['password']))
			{
				$acak=$model->generateSalt();
				$model->password=$model->hashPassword($_POST['Users']['password'],$acak);
			}

			if($model->save()){
				Yii::app()->user->setState('nama_lengkap', $_POST['Users']['nama']);
				Yii::app()->user->setState('email', $_POST['Users']['email']);
				$this->redirect(array('index'));
			}
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}