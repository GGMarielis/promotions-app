<?php

namespace App\Promotions;

use Exads\ABTestData;
use Exads\ABTestException;

class PromotionDesignPercentStrategy implements PromotionDesignInterface
{
    private ABTestData $abTestData;

    /**
     * @throws ABTestException
     */
    public function setPromotionId(int $promotionId): void
    {
        $this->setAbTestData($promotionId);
    }

    /**
     * @throws ABTestException
     */
    public function getDesign(): int
    {
        return $this->selectDesignByPercent();

    }

    /**
     * @throws ABTestException
     */
    private function setAbTestData(int $promotionId): void
    {
        $this->abTestData = new ABTestData($promotionId);
    }

    public function getName(): string
    {
        return $this->abTestData->getPromotionName();
    }


    /**
     * @throws ABTestException
     */
    private function selectDesignByPercent(): int
    {
        $designs =  $this->abTestData->getAllDesigns();

        $totalWeight = array_sum(array_map(fn($design) => $design['splitPercent'], $designs));

        $randomValue = mt_rand(1, $totalWeight);

        $currentWeight = 0;
        foreach ($designs as $design) {
            $currentWeight += $design['splitPercent'];
            if ($randomValue <= $currentWeight) {
                return $design['designId'];
            }
        }

        return $designs[0]['designId'];

    }
}
