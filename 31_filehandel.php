<?php

/**
 * file handling
 * 
 * require : makes error if file not exists
 * require_once
 * include : makes warning if file not exist 
 * include_once
**/

include_once './filehandel/thefile.php';


echo '<br/>'. $x . '<br/>';

$y = require('./filehandel/thefile2.php');

print_r($y);


ob_start(); 
include './filehandel/mainpage.php';
$nav = ob_get_clean();
// ob_start()  , ob_get_clean()          علشان يمنع تشغيل الملف لحين استدعاؤه 

// echo $nav;

echo '<br/><br/><br/><br/><br/><br/>';

// mkdir('./filehandel/testDir/test' , recursive:true);
// rmdir('./filehandel/testDir' );
// print_r( scandir('./filehandel') );
// echo is_file('./filehandel/mainpage.php');
// echo file_exists('./filehandel/nav.php');
// echo filesize('./filehandel/nav.php');
// echo filetype('./filehandel/nav.php');
// file_put_contents('./filehandel/test.txt' , ' ahmed mohamed ' , FILE_APPEND);
// echo file_get_contents('./filehandel/test.txt' );
// rename('./filehandel/test2.txt' , './filehandel/test.txt' );
// unlink('./filehandel/test2.txt');
// print_r(pathinfo('./filehandel/test.txt' ));
