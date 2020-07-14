<?php

namespace NumberToLcd;

class NumberToLcd {

	private const LCD_CHARACTERS = [
		0 => <<<NUMBER
 _ 
| |
|_|
NUMBER
		, 1 => <<<NUMBER
   
  |
  |
NUMBER
		, 2 => <<<NUMBER
 _ 
 _|
|_ 
NUMBER
		, 3 => <<<NUMBER
 _ 
 _|
 _|
NUMBER
		, 4 => <<<NUMBER
   
|_|
  |
NUMBER
		, 5 => <<<NUMBER
 _ 
|_ 
 _|
NUMBER
		, 6 => <<<NUMBER
 _ 
|_ 
|_|
NUMBER
		, 7 => <<<NUMBER
 _ 
| |
  |
NUMBER
		, 8 => <<<NUMBER
 _ 
|_|
|_|
NUMBER
		, 9 => <<<NUMBER
 _ 
|_|
 _|
NUMBER
	];

	/** @var int */
	private $number;

	public function __construct(int $number) {
		$this->number = $number;
	}

	public function print(int $width = 1, int $height = 1): string {
		if ($width <= 0 || $height <= 0) throw new \LogicException('The width and height should be greater than 0');

		$printedLines = $this->getLineArrayOfPrintedNumber($width, $height);

		$numberAsLcdStyle = '';

		for ($i=0; $i < sizeof($printedLines[0]); $i++) {
			if (!empty($numberAsLcdStyle)) {
				$numberAsLcdStyle .= PHP_EOL;
			}

			$numberAsLcdStyle .= $this->renderLineOfNumber($printedLines, $i);
		}

		return $numberAsLcdStyle;
	}

	private function getLineArrayOfPrintedNumber(int $width, int $height): array {
		$numberAsString = strval($this->number);

		$numberSplittedByLines = [];
		foreach (str_split($numberAsString) as $digit) {
			$digitPrint = self::LCD_CHARACTERS[ $digit ];
			$numberSplittedByLines[] = $this->extractLinesOfTheDigit($digitPrint, $width, $height);
		}

		return $numberSplittedByLines;
	}

	private function extractLinesOfTheDigit(string $printedDigit, int $width, int $height): array {
		$lines = mb_split(PHP_EOL, $printedDigit);

		$firstBaseLine = $lines[0];
		$secondBaseLine = $lines[1];
		$thirdBaseLine = $lines[2];

		$scaledLines[] = $firstBaseLine[0] . str_pad('', $width, $firstBaseLine[1]) . $firstBaseLine[2];

		for ($i=0; $i < $height - 1; $i++) {
			$scaledLines[] = $secondBaseLine[0] . str_pad('', $width, ' ') . $secondBaseLine[2];
		}
		$scaledLines[] = $secondBaseLine[0] . str_pad('', $width, $secondBaseLine[1]) . $secondBaseLine[2];

		for ($i = 0; $i < $height - 1; $i++) {
			$scaledLines[] = $thirdBaseLine[0] . str_pad('', $width, ' ') . $thirdBaseLine[2];
		}
		$scaledLines[] = $thirdBaseLine[0] . str_pad('', $width, $thirdBaseLine[1]) . $thirdBaseLine[2];

		return $scaledLines;
	}

	private function renderLineOfNumber(array $numberSplitByLines, int $lineToBeRendered): string {
		$line = '';

		foreach ($numberSplitByLines as $digitAsArray) {
			if (!empty($line)) {
				$line .= ' ';
			}

			$line .= $digitAsArray[ $lineToBeRendered ];
		}

		return $line;
	}
}
