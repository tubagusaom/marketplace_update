<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once 'guzzle/autoload.php';
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;

Class CI_guzzle
{
	
	var $client;
	
	function __construct()
	{
		$this->client =  new Client();
	}
	
}