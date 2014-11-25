<?php

Yii::import('zii.widgets.CMenu', true);

class SelectOpBulan extends CMenu
{
    public $id_select;
    public function init()
    {
        for ($i=1;$i<=12;$i++)
        {
            if($i<=9)
            {
                if($i==$this->id_select)
                {
                    echo "<option value='0".$i."' selected>".$this->Bulan($i-1)."</option>";
                }
                else
                {
                    echo "<option value='0".$i."'>".$this->Bulan($i-1)."</option>";
                }
            }
            else
            {
                if($i==$this->id_select)
                {
                    echo "<option value='".$i."' selected>".$this->Bulan($i-1)."</option>";
                }
                else
                {
                    echo "<option value='".$i."'>".$this->Bulan($i-1)."</option>";
                }
            }
            
        }
        parent::init();
    }

    protected function Bulan($bulan)
    {
        $list_bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        return($list_bulan[$bulan]);
    }
}