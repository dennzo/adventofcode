<?php

new fifthDecember();

/**
 * Class fifthDecember
 */
class fifthDecember
{
    private array $seats;

    public function __construct()
    {
        $fileContent = file_get_contents(__DIR__ . '/input.txt');
        $this->seats = array_filter(explode(PHP_EOL, $fileContent));
        $this->process();
    }

    public function process()
    {
        var_dump(bindec(max($this->seats)));
    }

//    public function process()
//    {
//        foreach ($this->seats as $seat) {
//            $result[$seat] = base_convert(strtr($seat, 'BFRL', '1010'), 2, 10);
//        }
//        sort($result);
//
//        foreach ($result as $seatNumber => $binary) {
//            if ($binary)
//        }
//    }
}
//
//for (; $p = fgets(STDIN); $c++) {
//    $i[] = base_convert(strtr($p, 'BFRL', '1010'), 2, 10);
//}
//sort($i);
//echo $i[--$c] . ' ';
//for (; $j++ < $c;) {
//    if ($i[$j + 1] - $i[$j] > 1) echo $i[$j] + 1;
//}

