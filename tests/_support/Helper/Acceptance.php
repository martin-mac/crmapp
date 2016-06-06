<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Acceptance extends \Codeception\Module
{
	public function seeContentIsLong($content, $trigger_length = 100)
	{
		$this->assertGreaterThen($trigger_length, strlen($content));
	}
	function seePageHasElement($element)
	{
		try {
			$this->getModule('WebDriver')->seeElement($element);
		} catch (\PHPUnit_Framework_AssertionFailedError $f) {
			return false;
		}
		return true;
	}
}
