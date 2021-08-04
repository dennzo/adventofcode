<?php

new thirdDecember();

/**
 * Class Something
 * @package ${NAMESPACE}
 */
class thirdDecember
{
    private $map;

    public function __construct()
    {
        $this->map = file_get_contents(__DIR__ . '/input.txt');
        $this->map = array_filter(explode(PHP_EOL, $this->map));
        $this->rowLength = strlen(trim($this->map[0]));

        $this->part1();
        $this->part2();
    }

    private function part1()
    {
        $right = 3;
        $count = 0;

        for ($row = 1, $rowMax = count($this->map); $row < $rowMax; $row++) {
            $position = ($right * $row) % $this->rowLength;

            if ($this->map[$row][$position] === '#') {
                $count++;
            }

        }
        echo "In this slope you have hit {$count} trees." . PHP_EOL;

    }

    private function part2()
    {
        $slopes = [
            ['right' => 1, 'down' => 1],
            ['right' => 3, 'down' => 1],
            ['right' => 5, 'down' => 1],
            ['right' => 7, 'down' => 1],
            ['right' => 1, 'down' => 2],
        ];

        foreach ($slopes as $key => $slope) {
            $count = 0;

            for ($step = $slope['down'], $rowMax = count($this->map); ($step * $slope['down']) < $rowMax; $step++) {
                $currentRow = $step * $slope['down'];
                $position = ($slope['right'] * $step) % $this->rowLength;

                if ($this->map[$currentRow][$position] === '#') {
                    $count++;
                }

            }

            $slopes[$key]['treesHit'] = $count;
        }

        $result = 1;
        $treesHit = 0;
        foreach ($slopes as $slope) {
            $result *= $slope['treesHit'];
            $treesHit += $slope['treesHit'];
        }

        echo "In all slopes you have hit {$treesHit} trees, which multiplies to {$result}." . PHP_EOL;
    }
}
