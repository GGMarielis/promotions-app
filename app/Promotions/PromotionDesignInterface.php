<?php

namespace App\Promotions;

interface PromotionDesignInterface
{
    public function getDesign(): int;

    public function setPromotionId(int $promotionId): void;

    public function getName(): string;
}
