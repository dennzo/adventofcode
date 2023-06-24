<?php

$fileContent = file_get_contents(__DIR__ . '/input.txt');
$presents = explode("\n", $fileContent);
$presents = array_filter(array_map('trim', $presents));

$amountToOrder = 0;
foreach ($presents as $present) {
    // assign each dimension with the format e.g. 100x50x20 to their respective variable
    // also assign as array to a variable that will be used to determine the lowest two sides.
    $ascendingOrder = [$length, $width, $height] = explode('x', $present);

    // now create an array we can access the lowest two values
    sort($ascendingOrder, SORT_NUMERIC);

    // calculate how many feet is needed for the bow
    $bow = $length * $width * $height;

    // calculate bow running via length and width of the present.
    // since it is a regular rectangular prism, it will have all sides twice on the opposite side.
    $total = (2 * $ascendingOrder[0]) + (2 * $ascendingOrder[1]) + $bow;

    // add to total amount which has to be ordered.
    $amountToOrder += $total;
}

echo $amountToOrder;
