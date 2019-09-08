<?php

  namespace app\Library;

  use DateTime;

  /**
   * Class Validation
   * @package app\Library
   */
class Validation
{

    // Check if file exists.
    public function checkIfFileExists($file)
    {
        return (!file_exists($file)) ? false : true;
    }

    /**
     * Data validation.
     *
     * @param $date
     * @return bool
     */
    private function validateDate($date)
    {
        $format = 'Y-m-d';
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    /**
     * Validate user identificator number.
     *
     * @param $number
     * @return bool
     */
    private function validateUserIdentificator($number)
    {
        return preg_match('/^[0-9]+$/', $number) ? true : false;
    }

    /**
     * Validate user type.
     *
     * @param $type
     * @return bool
     */
    private function validateUserType($type)
    {
        $target = ['natural', 'legal'];
        return (in_array($type, $target)) ? true : false;
    }

    /**
     * Validate operation type.
     *
     * @param $оperation
     * @return bool
     */
    private function validateОperationType($оperation)
    {
        $target = ['cash_in', 'cash_out'];
        return (in_array($оperation, $target)) ? true : false;
    }

    /**
     * Validate the input amount.
     *
     * @param $amount
     * @return bool
     */
    private function validateАmount($amount)
    {
        $check = preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $amount);
        return $check ? true : false;
    }

    /**
     * Validate currency.
     *
     * @param $currency
     * @return bool
     */
    private function validateCurrency($currency)
    {
        $target = ['EUR', 'USD', 'JPY'];
        return (in_array($currency, $target)) ? true : false;
    }

    /**
     * @param array $entry
     * @return array
     */
    public function validateEntryLine(array $entry)
    {
        $entryLine = 0;
        $message = [];

        if ($this->validateDate($entry[0])) {
            $entryLine++;
            $message[0] = $entry[0];
        } else {
            $message[0] = 'Date is not in right format';
        }

        if ($this->validateUserIdentificator($entry[1])) {
            $entryLine++;
            $message[1] = $entry[1];
        } else {
            $message[1] = 'User identificatoris must be integer number';
        }

        if ($this->validateUserType($entry[2])) {
            $entryLine++;
            $message[2] = $entry[2];
        } else {
            $message[2] = 'User type must be natural or legal';
        }

        if ($this->validateОperationType($entry[3])) {
            $entryLine++;
            $message[3] = $entry[3];
        } else {
            $message[3] = 'Operation type must be cash_in or cash_out';
        }

        if ($this->validateАmount($entry[4])) {
            $entryLine++;
            $message[4] = $entry[4];
        } else {
            $message[4] = 'The amount needs to be in the following formats xxxx.xx or xxxx';
        }

        if ($this->validateCurrency($entry[5])) {
            $entryLine++;
            $message[5] = $entry[5];
        } else {
            $message[5] = 'The only allowed currency are the following: EUR, USD and JPY';
        }

        if (6 === $entryLine) {
            $message['process'] = true;
        } else {
            $message['process'] = false;
        }

        return $message;
    }
}
