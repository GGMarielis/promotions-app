<?php

namespace App\Services;

class ASCIISearcherService
{
    const DEFAULT_INITIAL_CHARACTER = 44;
    const DEFAULT_FINAL_CHARACTER = 124;

    public function search(): string
    {
        $initial = self::DEFAULT_INITIAL_CHARACTER;
        $final = self::DEFAULT_FINAL_CHARACTER;

        $asciiCodes = $this->randomRangeWithOutCharacter($initial, $final);

        $missingAsciiCode = 0;

        for ($i = $initial; $i <= $final; $i++) {
            $missingAsciiCode ^= $i;
        }

        foreach ($asciiCodes as $code) {
            $missingAsciiCode ^= $code;
        }

        return chr($missingAsciiCode);
    }

    private function randomRangeWithOutCharacter($initial, $final): array
    {
        $asciiCodes = range($initial, $final);

        $randomKey = $this->getRandomKey($asciiCodes);

        unset($asciiCodes[$randomKey]);

        return $asciiCodes;
    }

    public function getRandomKey($asciiCodes): int
    {
        return array_rand($asciiCodes);
    }
}
