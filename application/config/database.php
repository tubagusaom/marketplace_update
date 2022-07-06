<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$active_group = 'default';

$env = 'online'; // lokal atau online
if($env=='lokal'){
	$koneksi1 = 'extra';
	$koneksi2 = 'default';
}else{
	$koneksi1 = 'default';
	$koneksi2 = 'extra';
}


$active_record = TRUE;
$db[$koneksi1]['hostname'] = 'localhost'; //103.145.226.74
$db[$koneksi1]['username'] = 'homedepo_tb'; //homedepo_tb
$db[$koneksi1]['password'] = 'bismIll@h'; //bismIll@h
$db[$koneksi1]['database'] = 'homedepo_live_db'; //homedepo_db
$db[$koneksi1]['dbdriver'] = 'mysqli';
$db[$koneksi1]['dbprefix'] = '';
$db[$koneksi1]['pconnect'] = TRUE;
$db[$koneksi1]['db_debug'] = FALSE;
$db[$koneksi1]['cache_on'] = FALSE;
$db[$koneksi1]['cachedir'] = '';
$db[$koneksi1]['char_set'] = 'utf8';
$db[$koneksi1]['dbcollat'] = 'utf8_general_ci';
$db[$koneksi1]['swap_pre'] = '';
$db[$koneksi1]['autoinit'] = TRUE;
$db[$koneksi1]['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */

$active_record = TRUE;
$db[$koneksi2]['hostname'] = 'localhost'; //128.199.119.79
$db[$koneksi2]['username'] = 'root';
$db[$koneksi2]['password'] = ''; //bismIll@h99
$db[$koneksi2]['database'] = 'homedepo_db';
$db[$koneksi2]['dbdriver'] = 'mysqli';
$db[$koneksi2]['dbprefix'] = '';
$db[$koneksi2]['pconnect'] = TRUE;
$db[$koneksi2]['db_debug'] = TRUE;
$db[$koneksi2]['cache_on'] = FALSE;
$db[$koneksi2]['cachedir'] = '';
$db[$koneksi2]['char_set'] = 'utf8';
$db[$koneksi2]['dbcollat'] = 'utf8_general_ci';
$db[$koneksi2]['swap_pre'] = '';
$db[$koneksi2]['autoinit'] = TRUE;
$db[$koneksi2]['stricton'] = FALSE;
