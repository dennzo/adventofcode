<?php

$fileContents = file_get_contents(__DIR__ . '/input.txt');

$numberOfCharacters = strlen($fileContents);
$total = 0;
for ($index = 0; $index <= $numberOfCharacters; $index++) {
    $currentValue = $fileContents[$index] ?? null;

    match ($currentValue) {
        '(' => ++$total,
        ')' => --$total,
        default => null
    };

    // if he enters the basement
    // +1 because index begins at 0 and not 1 (first floor).
    if (($total + 1) <= -1) {
        $result = $index;
        break;
    }
}

echo $result ?? '';
