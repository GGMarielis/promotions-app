<?php

namespace App\Services;

class PrimeNumbersService
{
    const DEFAULT_INITIAL_VALUE = 1;
    const DEFAULT_FINAL_VALUE = 100;
    public function listPrimeNumbers(?int $initValue, ?int $finalValue): array
    {
        $initValue = $initValue ?? self::DEFAULT_INITIAL_VALUE;
        $finalValue = $finalValue ?? self::DEFAULT_FINAL_VALUE;

        $result = [];
        for ($i = $initValue; $i <= $finalValue; $i++) {
            $result[] = $i . " " . $this->findMultiplesOrPrime($i);
        }
        return $result;
    }

    private function isPrime($num): bool
    {
        if ($num === 1) {
            return false;
        }
        for ($i = 2; $i * $i <= $num; $i++) {
            if ($num % $i == 0) {
                return false;
            }
        }
        return true;
    }

    private function findMultiplesOrPrime($num): string
    {
        if ($this->isPrime($num)) {
            return "[PRIME]";
        } else {
            $multiples = [];
            for ($i = 1; $i <= $num; $i++) {
                if ($num % $i == 0) {
                    $multiples[] = $i;
                }
            }
            return "[" . implode(", ", $multiples) . "]";
        }
    }
}
