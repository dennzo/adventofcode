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
}

echo $currentValue ?? '';
