<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require 'class.JavaScriptPacker.php';
Class CI_jso
{
	protected $obj;
	protected $javascriptCode;
	
	function setCode($scriptCode)
	{
		$this->javascriptCode = $scriptCode;
		return $this;
	}
	
	function obfuscate()
	{
		$encoding = 10;
		$fast_decode = 'on';
		$special_char = 'on';
		$packer = new JavaScriptPacker($this->javascriptCode, $encoding, $fast_decode, $special_char);
		$packed = $packer->pack();
		return $packed;
	}
}