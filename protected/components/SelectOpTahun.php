<?php

Yii::import('zii.widgets.CMenu', true);

class SelectOpTahun extends CMenu
{
    public $id_select;
    public function init()
    {
        for ($i=2013;$i<=date("Y");$i++)
        {
            if($i==$this->id_select)
            {
                echo "<option value='".$i."' selected>".$i."</option>";
            }
            else
            {
                echo "<option value='".$i."'>".$i."</option>";
            }
        }
        parent::init();
    }
}