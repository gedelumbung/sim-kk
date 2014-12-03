<?php

/**
 * This is the model class for table "tbl_perawatan".
 *
 * The followings are the available columns in table 'tbl_perawatan':
 * @property integer $id_perawatan
 * @property string $nama_perawatan
 * @property integer $harga
 * @property string $diskon_member
 * @property string $diskon_umum
 * @property integer $komisi_dokter
 * @property integer $komisi_perawat
 * @property string $created_at
 * @property string $updated_at
 */
class Perawatan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_perawatan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_perawatan, harga, diskon_member, diskon_umum, komisi_dokter, komisi_perawat', 'required'),
			array('harga, komisi_dokter, komisi_perawat', 'numerical', 'integerOnly'=>true),
			array('nama_perawatan', 'length', 'max'=>150),
			array('diskon_member, diskon_umum', 'length', 'max'=>5),
			array('created_at, updated_at', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_perawatan, nama_perawatan, harga, diskon_member, diskon_umum, komisi_dokter, komisi_perawat, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'id_perawatan' => 'Id Perawatan',
			'nama_perawatan' => 'Nama Perawatan',
			'harga' => 'Harga',
			'komisi_dokter' => 'Komisi Dokter',
			'komisi_perawat' => 'Komisi Perawat',
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

		$criteria->compare('id_perawatan',$this->id_perawatan);
		$criteria->compare('nama_perawatan',$this->nama_perawatan,true);
		$criteria->compare('harga',$this->harga);
		$criteria->compare('diskon_member',$this->diskon_member,true);
		$criteria->compare('diskon_umum',$this->diskon_umum,true);
		$criteria->compare('komisi_dokter',$this->komisi_dokter);
		$criteria->compare('komisi_perawat',$this->komisi_perawat);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Perawatan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
