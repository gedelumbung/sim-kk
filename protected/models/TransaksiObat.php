<?php

/**
 * This is the model class for table "tbl_transaksi_obat".
 *
 * The followings are the available columns in table 'tbl_transaksi_obat':
 * @property integer $id_transaksi_obat
 * @property integer $id_master_transaksi
 * @property integer $id_obat
 * @property integer $jumlah
 */
class TransaksiObat extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_transaksi_obat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_master_transaksi, id_obat, created_at', 'required'),
			array('id_master_transaksi, id_obat, jumlah', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_transaksi_obat, id_master_transaksi, id_obat, jumlah', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'Barang'=>array(self::BELONGS_TO,'Barang','id_obat'),
			);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_transaksi_obat' => 'Id Transaksi Obat',
			'id_master_transaksi' => 'Id Master Transaksi',
			'id_obat' => 'Id Obat',
			'jumlah' => 'Jumlah',
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

		$criteria->compare('id_transaksi_obat',$this->id_transaksi_obat);
		$criteria->compare('id_master_transaksi',$this->id_master_transaksi);
		$criteria->compare('id_obat',$this->id_obat);
		$criteria->compare('jumlah',$this->jumlah);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TransaksiObat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
