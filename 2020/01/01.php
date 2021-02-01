<?php

new firstPart();
new secondPart();

class firstPart
{
    // Result = 145875

    /**
     * @var int
     */
    private int $target = 2020;

    /**
     * @var array
     */
    private $input;

    public function __construct()
    {
        $this->input = json_decode(file_get_contents(__DIR__ . '/input.json'));

        echo "The solution of part 1 is: {$this->start()}" . PHP_EOL;

    }

    /**
     * @return int|null
     */
    private function start(): ?int
    {
        foreach ($this->input as $a) {
            foreach ($this->input as $b) {
                if ($this->target === ($a + $b)) {
                    return $a * $b;
                }
            }
        }

        return null;
    }
}


class secondPart
{
    // Result = 69596112

    /**
     * @var array
     */
    private $input;

    /**
     * @var int
     */
    private int $target = 2020;

    public function __construct()
    {
        $this->input = json_decode(file_get_contents(__DIR__ . '/input.json'));

        echo "The solution of part 2 is: {$this->start()}" . PHP_EOL;
    }

    public function start(): ?int
    {
        foreach ($this->input as $a) {
            foreach ($this->input as $b) {
                foreach ($this->input as $c) {
                    $sum = $a + $b + $c;
                    if ($this->target === $sum) {
                        return $a * $b * $c;
                    }
                }
            }
        }

        return null;
    }
}
