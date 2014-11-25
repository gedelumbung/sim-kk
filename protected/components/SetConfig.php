<?php

class SetConfig extends CWidget {

    public function run() {

    	if(session_status() === PHP_SESSION_NONE){
    		session_start();
    	}
        $dt = Pengaturan::model()->findAll();

        foreach($dt as $d){
        	$_SESSION[$d['type']] = $d['content'];
        }
    }
}