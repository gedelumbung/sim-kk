<?php

/**
 * This is the model class for table "tbl_pengeluaran".
 *
 * The followings are the available columns in table 'tbl_pengeluaran':
 * @property integer $id_pengeluaran
 * @property string $pengeluaran
 * @property integer $jumlah
 * @property integer $total
 * @property string $created_at
 */
class Pengeluaran extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_pengeluaran';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pengeluaran, jumlah, total', 'required'),
			array('jumlah, total', 'numerical', 'integerOnly'=>true),
			array('pengeluaran', 'length', 'max'=>100),
			array('created_at', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pengeluaran, pengeluaran, jumlah, total, created_at', 'safe', 'on'=>'search'),
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
			'id_pengeluaran' => 'Id Pengeluaran',
			'pengeluaran' => 'Pengeluaran',
			'jumlah' => 'Jumlah',
			'total' => 'Total',
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

		$criteria->compare('id_pengeluaran',$this->id_pengeluaran);
		$criteria->compare('pengeluaran',$this->pengeluaran,true);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('total',$this->total);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pengeluaran the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
