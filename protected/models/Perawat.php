<?php

/**
 * This is the model class for table "tbl_perawat".
 *
 * The followings are the available columns in table 'tbl_perawat':
 * @property integer $id_perawat
 * @property string $nama
 * @property string $tempat_tanggal_lahir
 * @property string $alamat
 * @property string $no_telepon
 * @property string $created_at
 */
class Perawat extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_perawat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama, tempat_tanggal_lahir, alamat, no_telepon', 'required'),
			array('nama', 'length', 'max'=>150),
			array('tempat_tanggal_lahir, no_telepon, created_at', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_perawat, nama, tempat_tanggal_lahir, alamat, no_telepon, created_at', 'safe', 'on'=>'search'),
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
			'id_perawat' => 'Id Perawat',
			'nama' => 'Nama',
			'tempat_tanggal_lahir' => 'Tempat Tanggal Lahir',
			'alamat' => 'Alamat',
			'no_telepon' => 'No Telepon',
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

		$criteria->compare('id_perawat',$this->id_perawat);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('tempat_tanggal_lahir',$this->tempat_tanggal_lahir,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('no_telepon',$this->no_telepon,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Perawat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
