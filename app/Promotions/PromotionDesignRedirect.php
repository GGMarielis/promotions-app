<?php

namespace App\Promotions;

class PromotionDesignRedirect
{
    private PromotionDesignInterface $strategy;

    public function __construct(PromotionDesignInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function getRedirectUrl(int $promotionId): string
    {
        $this->strategy->setPromotionId($promotionId);

        return $this->getDesignUrl(
            $this->strategy->getName(),
            $this->strategy->getDesign()
        );
    }

    private function getDesignUrl(string $promotionName, int $designId): string
    {
        return "/promotion/$promotionName/$designId";
    }
}
