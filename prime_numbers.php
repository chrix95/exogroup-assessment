<?php

class PrimeNumbersList
{
    public $start;
    public $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    // list all prime number from $this->start to $this->end
    public function getPrimeMultipleList () : array
    {
        $result = [];
        for ($i = $this->start; $i <= $this->end; $i++) {
            if ($i == 1) { // 1 isn't a prime number and doesn't have any multiple
                array_push($result, $i);
                continue;
            }
            $multiples = $this->findMultiples($i);
            array_push($result, $multiples);
        }
        return $result;
    }

    // Find the multiple of each integer that are not prime
    protected function findMultiples ($value) : string
    {
        $isPrime = true;
        for ($j = 2; $j < ($value - 1); $j++) {
            if ($value % $j == 0) {
                $isPrime = false;
                $multiples[] = $j;
            }
        }
        if ($isPrime) {
            return $value . " [PRIME]";
        } else {
            return $value . " (" . implode(", ", $multiples) . ")";
        }
    }

}

$response = new PrimeNumbersList(1, 100);
echo implode("<br>", $response->getPrimeMultipleList());
