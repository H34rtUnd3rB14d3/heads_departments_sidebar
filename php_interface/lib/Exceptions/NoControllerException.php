<?php
namespace lib\Exceptions;

use Exception;
class NoControllerException extends Exception
{
	function __construct() {
		parent::__construct("No controller found");
	}
}