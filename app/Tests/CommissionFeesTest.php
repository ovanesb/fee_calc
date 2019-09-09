<?php

namespace app\Tests;

use PHPUnit\Framework\TestCase;
use App\Library\CommissionFees;

class CommissionFeesTest extends TestCase
{

  /**
   * Check that Cache in fee is no more than 5.00
   */
    public function testCashIn()
    {
        $result = ( new CommissionFees() )->cashIn(10000);
        $this->assertGreaterThan($result, 5);
    }

  /**
   * Check that cache out for legal person is not less than 0.50 EUR for operation.
   */
    public function testCacheOutLegal()
    {
        $result = ( new CommissionFees() )->cashOut('30000000', 'legal', 'JPY');
        $this->assertGreaterThan(0.5, $result);
    }
}
