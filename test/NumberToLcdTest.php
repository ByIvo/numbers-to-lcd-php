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

	function getPrinted3x2ScaledDigits(): iterable {
		yield '0' => [0, <<<DISPLAY
 ___ 
|   |
|   |
|   |
|___|
DISPLAY
		];
		yield '1' => [1, <<<DISPLAY
     
    |
    |
    |
    |
DISPLAY
		];
		yield '2' => [2, <<<DISPLAY
 ___ 
    |
 ___|
|    
|___ 
DISPLAY
		];
		yield '3' => [3, <<<DISPLAY
 ___ 
    |
 ___|
    |
 ___|
DISPLAY
		];
		yield '4' => [4, <<<DISPLAY
     
|   |
|___|
    |
    |
DISPLAY
		];
		yield '5' => [5, <<<DISPLAY
 ___ 
|    
|___ 
    |
 ___|
DISPLAY
		];
		yield '6' => [6, <<<DISPLAY
 ___ 
|    
|___ 
|   |
|___|
DISPLAY
		];
		yield '7' => [7, <<<DISPLAY
 ___ 
|   |
|   |
    |
    |
DISPLAY
		];
		yield '8' => [8, <<<DISPLAY
 ___ 
|   |
|___|
|   |
|___|
DISPLAY
		];
		yield '9' => [9, <<<DISPLAY
 ___ 
|   |
|___|
    |
 ___|
DISPLAY
		];
	}

	/** @test @dataProvider getPrinted3x2ScaledDigits */
	function givenAWidthAndHeight_whenPrintingTheNumberZero_shouldPrintItInLcdStyle(
		int $digit,
		string $expectedPrintedScaledDigitInLcdStyle
	): void {
		$numberToLcd = new NumberToLcd($digit);

		$numberInLctStyle = $numberToLcd->print($width = 3, $height = 2);

		Assert::assertEquals($expectedPrintedScaledDigitInLcdStyle, $numberInLctStyle);
	}

	/** @test */
	function givenAWithAndHeight_whenPrintingATwoNumbers_shouldPrintItInLcdStyle(): void {
		$numberToLcd = new NumberToLcd(12);

		$numberInLctStyle = $numberToLcd->print($width = 3, $height = 2);

		$expectedNumberInLcdStyle = <<<DISPLAY
       ___ 
    |     |
    |  ___|
    | |    
    | |___ 
DISPLAY;
		Assert::assertEquals($expectedNumberInLcdStyle, $numberInLctStyle);
	}

	/** @test */
	function givenAWithAndHeight_whenPrintingALargeNumber_shouldPrintItInLcdStyle(): void {
		$numberToLcd = new NumberToLcd(1234567890);

		$numberInLctStyle = $numberToLcd->print($width = 3, $height = 2);

		$expectedNumberInLcdStyle = <<<DISPLAY
       ___   ___         ___   ___   ___   ___   ___   ___ 
    |     |     | |   | |     |     |   | |   | |   | |   |
    |  ___|  ___| |___| |___  |___  |   | |___| |___| |   |
    | |         |     |     | |   |     | |   |     | |   |
    | |___   ___|     |  ___| |___|     | |___|  ___| |___|
DISPLAY;
		Assert::assertEquals($expectedNumberInLcdStyle, $numberInLctStyle);
	}

	/** @test */
	function whenPrintingAScaledNumber_shouldScaleTheWidthCorrectly(): void {
		$numberToLcd = new NumberToLcd(2);

		$numberInLctStyle = $numberToLcd->print($width = 6, $height = 2);

		$expectedNumberInLcdStyle = <<<DISPLAY
 ______ 
       |
 ______|
|       
|______ 
DISPLAY;
		Assert::assertEquals($expectedNumberInLcdStyle, $numberInLctStyle);
	}

	/** @test */
	function whenPrintingAScaledNumber_shouldScaleTheHeightCorrectly(): void {
		$numberToLcd = new NumberToLcd(2);

		$numberInLctStyle = $numberToLcd->print($width = 3, $height = 4);

		$expectedNumberInLcdStyle = <<<DISPLAY
 ___ 
    |
    |
    |
 ___|
|    
|    
|    
|___ 
DISPLAY;
		Assert::assertEquals($expectedNumberInLcdStyle, $numberInLctStyle);
	}

	/** @test */
	function whenPrintingAZeroWidth_shouldThrownAnException(): void {
		$numberToLcd = new NumberToLcd(1);

		$this->expectException(\LogicException::class);
		$this->expectExceptionMessage('The width and height should be greater than 0');
		$numberToLcd->print($width = 0, $height = 1);
	}

	/** @test */
	function whenPrintingAZeroHeight_shouldThrownAnException(): void {
		$numberToLcd = new NumberToLcd(1);

		$this->expectException(\LogicException::class);
		$this->expectExceptionMessage('The width and height should be greater than 0');
		$numberToLcd->print($width = 1, $height = 0);
	}
}
