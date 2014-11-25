<?php

/**
 * This is the model class for table "tbl_barang".
 *
 * The followings are the available columns in table 'tbl_barang':
 * @property integer $id_barang
 * @property string $nama_barang
 * @property integer $stok
 * @property integer $harga_pokok
 * @property integer $harga_jual
 * @property string $diskon
 * @property string $created_at
 * @property string $updated_at
 */
class Barang extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_barang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_barang, stok, harga_pokok, harga_jual', 'required'),
			array('stok, harga_pokok, harga_jual', 'numerical', 'integerOnly'=>true),
			array('nama_barang', 'length', 'max'=>150),
			array('diskon', 'length', 'max'=>10),
			array('created_at, updated_at', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_barang, nama_barang, stok, harga_pokok, harga_jual, diskon', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_barang' => 'Id Barang',
			'nama_barang' => 'Nama Barang',
			'stok' => 'Stok',
			'harga_pokok' => 'Harga Pokok',
			'harga_jual' => 'Harga Jual',
			'diskon' => 'Diskon',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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

		$criteria->compare('id_barang',$this->id_barang);
		$criteria->compare('nama_barang',$this->nama_barang,true);
		$criteria->compare('stok',$this->stok);
		$criteria->compare('harga_pokok',$this->harga_pokok);
		$criteria->compare('harga_jual',$this->harga_jual);
		$criteria->compare('diskon',$this->diskon,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Barang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
