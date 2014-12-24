<?php

/**
 * This is the model class for table "tbl_transaksi_perawatan".
 *
 * The followings are the available columns in table 'tbl_transaksi_perawatan':
 * @property integer $id_transaksi_perawatan
 * @property integer $id_master_transaksi
 * @property integer $id_perawatan
 * @property string $created_at
 */
class TransaksiPerawatan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_transaksi_perawatan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_master_transaksi, id_perawatan, created_at', 'required'),
			array('id_master_transaksi, id_perawatan', 'numerical', 'integerOnly'=>true),
			array('created_at', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_transaksi_perawatan, id_master_transaksi, id_perawatan, created_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'Perawatan'=>array(self::BELONGS_TO,'Perawatan','id_perawatan'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_transaksi_perawatan' => 'Id Transaksi Perawatan',
			'id_master_transaksi' => 'Id Master Transaksi',
			'id_perawatan' => 'Id Perawatan',
			'created_at' => 'Created At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_transaksi_perawatan',$this->id_transaksi_perawatan);
		$criteria->compare('id_master_transaksi',$this->id_master_transaksi);
		$criteria->compare('id_perawatan',$this->id_perawatan);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TransaksiPerawatan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
