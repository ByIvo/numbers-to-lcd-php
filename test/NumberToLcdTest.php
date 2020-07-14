<?php

namespace Test\NumberToLcd;

use NumberToLcd\NumberToLcd;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class NumberToLcdTest extends TestCase {

	function getAllDigitsIndividually(): iterable {
		yield '0' => [0, <<<NUMBER
 _ 
| |
|_|
NUMBER
		];
		yield '1' => [1, <<<NUMBER
   
  |
  |
NUMBER
		];
		yield '2' => [2, <<<NUMBER
 _ 
 _|
|_ 
NUMBER
		];
		yield '3' => [3, <<<NUMBER
 _ 
 _|
 _|
NUMBER
		];
		yield '4' => [4, <<<NUMBER
   
|_|
  |
NUMBER
		];
		yield '5' => [5, <<<NUMBER
 _ 
|_ 
 _|
NUMBER
		];
		yield '6' => [6, <<<NUMBER
 _ 
|_ 
|_|
NUMBER
		];
		yield '7' => [7, <<<NUMBER
 _ 
| |
  |
NUMBER
		];
		yield '8' => [8, <<<NUMBER
 _ 
|_|
|_|
NUMBER
		];
		yield '9' => [9, <<<NUMBER
 _ 
|_|
 _|
NUMBER
		];
	}

	/** @test @dataProvider getAllDigitsIndividually */
	function givenTheADigit_shouldPrintItInLcdStyle(
		int $digit,
		string $expectedDigitLcdStyle
	): void {
		$numberToLcd = new NumberToLcd($digit);

		$lcdNumber = $numberToLcd->print();

		Assert::assertEquals($expectedDigitLcdStyle, $lcdNumber);
	}

	/** @test */
	function givenANumber_shouldPrintItInLcdStyle(): void {
		$numberToLcd = new NumberToLcd(10);

		$numberInLctStyle = $numberToLcd->print();

		$expectedNumberInLcdStyle = <<<DISPLAY
     _ 
  | | |
  | |_|
DISPLAY;
		Assert::assertEquals($expectedNumberInLcdStyle, $numberInLctStyle);
	}

	/** @test */
	function givenTheNumberTwelve_shouldPrintItInLcdStyle(): void {
		$numberToLcd = new NumberToLcd(12);

		$numberInLctStyle = $numberToLcd->print();

		$expectedNumberInLcdStyle = <<<DISPLAY
     _ 
  |  _|
  | |_ 
DISPLAY;
		Assert::assertEquals($expectedNumberInLcdStyle, $numberInLctStyle);
	}

	/** @test */
	function givenAGiantNumber_shouldPrintItInLcdStyle(): void {
		$numberToLcd = new NumberToLcd(1234567890);

		$numberInLctStyle = $numberToLcd->print();

		$expectedNumberInLcdStyle = <<<DISPLAY
     _   _       _   _   _   _   _   _ 
  |  _|  _| |_| |_  |_  | | |_| |_| | |
  | |_   _|   |  _| |_|   | |_|  _| |_|
DISPLAY;
		Assert::assertEquals($expectedNumberInLcdStyle, $numberInLctStyle);
	}
}
