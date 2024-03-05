<?php

namespace App\Promotions;

class PromotionDesignFactory
{
    public static function create(string $type): PromotionDesignRedirect
    {
        $strategy = match ($type) {
            'percent' => PromotionDesignPercentStrategy::class,
        };

        return new PromotionDesignRedirect(new $strategy);
    }
}
