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

	public function print(): string {
		$printedLines = $this->getLineArrayOfPrintedNumber();

		$firstLine = $this->renderLineOfNumber($printedLines, 0);
		$secondLine = $this->renderLineOfNumber($printedLines, 1);
		$thirdLine = $this->renderLineOfNumber($printedLines, 2);

		$numberAsLcdStyle = '';
		$numberAsLcdStyle .= $firstLine . PHP_EOL;
		$numberAsLcdStyle .= $secondLine . PHP_EOL;
		$numberAsLcdStyle .= $thirdLine;

		return $numberAsLcdStyle;
	}

	private function getLineArrayOfPrintedNumber(): array {
		$numberAsString = strval($this->number);

		$numberSplittedByLines = [];
		foreach (str_split($numberAsString) as $digit) {
			$digitPrint = self::LCD_CHARACTERS[ $digit ];
			$numberSplittedByLines[] = $this->extractLinesOfTheDigit($digitPrint);
		}

		return $numberSplittedByLines;
	}

	private function extractLinesOfTheDigit(string $printedDigit): array {
		return mb_split(PHP_EOL, $printedDigit);
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
