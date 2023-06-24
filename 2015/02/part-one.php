<?php

$fileContent = file_get_contents(__DIR__ . '/input.txt');
$presents = explode("\n", $fileContent);
$presents = array_filter(array_map('trim', $presents));

$amountToOrder = 0;
foreach ($presents as $present) {
    // assign each dimension with the format e.g. 100x50x20 to their respective variable
    [$length, $width, $height] = explode('x', $present);

    // calculate surface area of each side
    $lengthSquare = $length * $width;
    $widthSquare = $width * $height;
    $heightSquare = $height * $length;

    // calculate total surface area from all sides.
    // since it is a regular rectangular prism, it will have all sides twice on the opposite side.
    $total = (2 * $lengthSquare) + (2 * $widthSquare) + (2 * $heightSquare);

    // add slack from the surface area of the smallest side.
    $total += min($lengthSquare, $widthSquare, $heightSquare);

    // add to total amount which has to be ordered.
    $amountToOrder += $total;
}

echo $amountToOrder;
