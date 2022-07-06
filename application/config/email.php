<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
| -------------------------------------------------------------------
| EMAIL CONFIG
| -------------------------------------------------------------------
| Konfigurasi email keluar melalui mail server
| */
//5735wer@%432i

        $config['protocol']='smtp';
        $config['wordwrap'] = FALSE;
        $config['mailtype'] = 'html';
        
        $config['smtp_host']='ssl://smtp.googlemail.com'; 
         //$config['smtp_host']='ssl://smtp.mail.yahoo.co.id';
        // $config['smtp_host']='mail.mbs.web.id';
          
        $config['smtp_port']='465'; 
        $config['smtp_timeout']='30'; 
        $config['smtp_user']='lspinfo32@gmail.com'; 
        $config['smtp_pass']='bismIll@h99'; 
        //$config['smtp_user']='mitrabuanasolusindo@gmail.com'; 
        //$config['smtp_pass']='400485Aa'; 
        //$config['smtp_user']='buana_roy@yahoo.co.id'; 
        //$config['smtp_pass']='qwerty99';
        //$config['smtp_user']='bnspkompeten@gmail.com'; 
        //$config['smtp_pass']='400485Aa'; 
        //$config['smtp_user']='lspinfo61@gmail.com'; 
        //$config['smtp_pass']='5735wer@%432i';
        //$config['smtp_user']='lspinfo71@gmail.com'; 
        //$config['smtp_pass']='400485Aa';
        //$config['smtp_user']='info@mbs.web.id'; 
        //$config['smtp_pass']='123456';
        
        $config['charset']='utf-8'; 
        $config['newline']="\r\n";
        
/* End of file email.php */ 
/* Location: ./system/application/config/email.php */
