<?php

namespace Tests\Promotions;

use App\Promotions\PromotionDesignPercentStrategy;
use Exads\ABTestException;
use Tests\TestCase;


class PromotionDesignPercentStrategyTest extends TestCase
{
    /**
     * @throws ABTestException
     */
    public function testGetDesignReturnsValidDesignId()
    {
        $promotionId = 1;
        $strategy = new PromotionDesignPercentStrategy();
        $strategy->setPromotionId($promotionId);

        $designId = $strategy->getDesign();

        $this->assertTrue(in_array($designId, [1, 2, 3]));
    }

    /**
     * @throws ABTestException
     */
    public function testGetNameReturnsCorrectName()
    {
        $promotionId = 1;
        $strategy = new PromotionDesignPercentStrategy();
        $strategy->setPromotionId($promotionId);
        $designId = $strategy->getDesign();

        $name = $strategy->getName();

        $this->assertEquals('main', $name);
    }
}
