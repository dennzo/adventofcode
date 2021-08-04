<?php

new secondDecember();

class secondDecember
{

    public function __construct()
    {
        // Get input fromfile
        $this->input = file_get_contents(__DIR__ . '/input.txt');

        // Remove the :
        $this->input = str_replace(':', '', $this->input);

        // Remove empty keys and separate each line into an array
        $this->input = array_filter(explode(PHP_EOL, $this->input));

        $this->partOne();
        $this->partTwo();
    }

    public function partOne()
    {
        $validPasswords = $invalidPasswords = [];
        foreach ($this->input as $item) {
            [$occurrence, $letter, $password] = explode(' ', $item);

            [$minRange, $maxRange] = explode('-', $occurrence);

            $characterCount = substr_count($password, $letter);

            if ($characterCount >= $minRange && $characterCount <= $maxRange) {
                $validPasswords[] = $password;
            } else {
                $invalidPasswords[] = $password;
            }

        }
        echo "Total valid -> " . count($validPasswords) . PHP_EOL;
        echo "Total invalid -> " . count($invalidPasswords) . PHP_EOL;
        // Result -> 569 valid and 431 invalid
    }

    public function partTwo()
    {
        $validPasswords = $invalidPasswords = [];
        foreach ($this->input as $item) {
            [$occurrence, $letter, $password] = explode(' ', $item);

            [$firstPosition, $secondPosition] = explode('-', $occurrence);

            $first = substr($password, $firstPosition - 1, 1);
            $second = substr($password, $secondPosition - 1, 1);

            if ($letter === $first xor $letter === $second) {
                $validPasswords[] = $password;
            } else {
                $invalidPasswords[] = $password;
            }

        }
        echo "Total valid -> " . count($validPasswords) . PHP_EOL;
        echo "Total invalid -> " . count($invalidPasswords) . PHP_EOL;
        // Result -> 346 valid and 654 invalid
    }

}
