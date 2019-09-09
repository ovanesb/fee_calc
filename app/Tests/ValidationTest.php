<?php

namespace app\Tests;

use PHPUnit\Framework\TestCase;
use App\Library\Validation;

class ValidationTest extends TestCase
{
  /**
   * Check if file that will be processed exists.
   */
    public function testCheckIfFileExistsSuccess()
    {
        $this->assertFileExists('input.csv');
    }

    /**
   * Check if file that will be processed exists.
   */
    public function testCheckIfFileExistsFailure()
    {
        $this->assertFileExists('i_do_not_exists.csv');
    }

  /**
   * Check for successful passed validation.
   */
    public function testValidateEntryLinePass()
    {
        $result = ( new Validation() )->validateEntryLine(['2014-12-31', '4', 'natural', 'cash_out', '1200.00', 'EUR']);
        $this->assertTrue($result['process']);
    }

  /**
   * Case for unsuccessful passed validation.
   */
    public function testValidateEntryLineFailure()
    {
        $result = ( new Validation() )->validateEntryLine([
          '2014-12-31', '4', 'i_do_not_exists', 'cash_out', '1200.00', 'EUR'
        ]);
        $this->assertTrue($result['process']);
    }
}
