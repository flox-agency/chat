<?php

        // ======================
        //   connection a la base
        //=======================
        
        include 'mysqli.class.php';

        $config = array();
		$config['host'] = 'localhost';
		$config['user'] = 'root';
		$config['pass'] = '';
		$config['table'] = 'dc_livechat';
		
		
		
		
	//$config = array();
	//	$config['host'] = 'db446462646.db.1and1.com';
	//	$config['user'] = 'dbo446462646';
	//	$config['pass'] = 'fidelejesus';
	//	$config['table'] = 'db446462646';
	
 		$db = new DB($config);