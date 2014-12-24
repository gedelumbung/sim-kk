<?php

/**
 * This is the model class for table "tbl_master_transaksi".
 *
 * The followings are the available columns in table 'tbl_master_transaksi':
 * @property integer $id_master_transaksi
 * @property integer $id_pasien
 * @property string $created_at
 * @property string $updated_at
 * @property string $keterangan
 * @property integer $hutang
 * @property integer $total
 * @property integer $total_bayar
 * @property string $status_pembayaran
 */
class MasterTransaksi extends CActiveRecord
{
  public $nama_pasien;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_master_transaksi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pasien, created_at, updated_at, biaya', 'required'),
			array('id_pasien, hutang, total, total_bayar, biaya', 'numerical', 'integerOnly'=>true),
			array('created_at, updated_at', 'length', 'max'=>100),
			array('status_pembayaran', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_master_transaksi, id_pasien, created_at, updated_at, hutang, total, total_bayar, status_pembayaran, nama_pasien', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'Pasien'=>array(self::BELONGS_TO,'Pasien','id_pasien'),
			'TransaksiDokter'=>array(self::BELONGS_TO,'TransaksiDokter','id_master_transaksi'),
			'TransaksiPerawat'=>array(self::BELONGS_TO,'TransaksiPerawat','id_master_transaksi'),
			'TransaksiObat'=>array(self::BELONGS_TO,'TransaksiObat','id_master_transaksi'),
			'TransaksiPerawatan'=>array(self::BELONGS_TO,'TransaksiPerawatan','id_master_transaksi'),
			);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_master_transaksi' => 'Id Master Transaksi',
			'id_pasien' => 'Pasien',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'keterangan' => 'Keterangan',
			'hutang' => 'Hutang',
			'biaya' => 'Biaya Perawatan / Check Up',
			'total' => 'Total Biaya',
			'total_bayar' => 'Total Bayar',
			'status_pembayaran' => 'Status Pembayaran',
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
		
		$criteria->with = array( 'Pasien' );
		$criteria->compare( 'Pasien.nama', $this->nama_pasien, true );

		$criteria->compare('id_master_transaksi',$this->id_master_transaksi);
		$criteria->compare('id_pasien',$this->id_pasien);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('hutang',$this->hutang);
		$criteria->compare('total',$this->total);
		$criteria->compare('total_bayar',$this->total_bayar);
		if(!$this->status_pembayaran){
			$criteria->compare('status_pembayaran',$this->status_pembayaran,true);
		}
		else{
			$criteria->condition = 'status_pembayaran = "'.$this->status_pembayaran.'"';
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function search_pasien($id_pasien)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->with = array( 'Pasien' );
		$criteria->compare( 'Pasien.nama', $this->nama_pasien, true );

		$criteria->condition = "t.id_pasien = '".$id_pasien."'";

		$criteria->compare('id_master_transaksi',$this->id_master_transaksi);
		$criteria->compare('created_at',$this->created_at,true);
		if(!$this->status_pembayaran){
			$criteria->compare('status_pembayaran',$this->status_pembayaran,true);
		}
		else{
			$criteria->condition = 'status_pembayaran = "'.$this->status_pembayaran.'"';
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MasterTransaksi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
