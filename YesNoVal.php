<?php
final class YesNoVal
{
	const YES = 'y';
	const NO  = 'n';

	private $val;

	private $allowed = [
		self::YES, 
		self::NO,
	];

	public function __construct($val)
	{
		$this->setValue($val);
	}

	public function isValid()
	{
		return in_array($this->val, $this->allowed);
	}

	public function isYes() 
	{
		return $this->val === self::YES;
	}

	public function isNo()
	{
		return $this->val === self::NO;
	}

	private function setValue($val)
	{
		if ( ! is_string($val)) return;

		$val = strtolower($val)[0];

		if ( in_array($val, $this->allowed)) {
			$this->val = $val;
		}
	}

}

/*
 * TESTS
 */ 

it('should be a NO', (new YesNoVal('no'))->isNo());
it('accepts n as NO', (new YesNoVal('n'))->isNo());
it('should be a YES', (new YesNoVal('yes'))->isYes());
it('accepts y as YES', (new YesNoVal('Y'))->isYes());
it('lowercases the input', (new YesNoVal('N'))->isNo());
it('accepts YEP as YES', (new YesNoVal('YEP'))->isYes());
it('accepts NOPE as NO', (new YesNoVal('NOPE'))->isNo());
it('accepts both yes and no as valid input', (new YesNoVal('yes'))->isValid() && (new YesNoVal('no'))->isValid());
it('doesn\'t accept an invalid value', !(new YesNoVal('foo'))->isValid());
it('doesn\'t accept an invalid NO', !(new YesNoVal('bar'))->isNo());
it('doesn\'t accept an invalid YES', !(new YesNoVal('foo'))->isYes());
it('doesn\'t coerce string 0', !(new YesNoVal('0'))->isNo());
it('doesn\'t coerce string 1', !(new YesNoVal('1'))->isYes());
it('doesn\'t coerce int 0', !(new YesNoVal(0))->isNo());
it('doesn\'t coerce int 1', !(new YesNoVal(1))->isYes());
it('doesn\'t coerce boolean false', !(new YesNoVal(false))->isNo());
it('doesn\'t coerce boolean true', !(new YesNoVal(true))->isYes());

// Thanks to test framework in a tweet [https://gist.github.com/mathiasverraes/9046427]
function it($m,$p){echo "\033[".($p?"32m✔":"31m✘")." It $m\n"; if(!$p){$GLOBALS['f']=1;}}function done(){if(@$GLOBALS['f'])die(1);}