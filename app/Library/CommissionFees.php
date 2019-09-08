<?php


namespace app\Library;

/**
 * Class CommissionFees
 * @package app\Library
 */
class CommissionFees
{

    /**
     * Commission fee - 0.03% from total amount.
     *
     * @var float
     */
    private $cashInFee = 0.03;

    /**
     * Commission fees for natural and legal users.
     *
     * @var array
     */
    private $cashOutFee = [
      'natural' => 0.3,
      'legal' => 0.3
    ];

    /**
     * Conversion rate EUR to JPY.
     *
     * @var float
     */
    private $eurTojpy = 129.53;

    /**
     * Conversion rate EUR to USD.
     *
     * @var float
     */
    private $eurTousd = 1.1497;

    /**
     * Calculate the fee when customer is doing Cash In operation.
     *
     * @param $amount
     *   numeric
     * @param $currency
     *   string
     *
     * @return float|int
     */
    public function cashIn($amount, $currency)
    {
        $fee = $this->percentCalculation($this->cashInFee, $amount);
        return $fee > 5 ? 5.00 : $fee;
    }

    /**
     * Calculate the fee when customer is doing Cash Out operation.
     *
     * @param $amount
     *   numeric
     * @param $userType
     *   string
     * @param $currency
     *   string
     *
     * @return float|int|string
     */
    public function cashOut($amount, $userType, $currency)
    {
        $amount = (double) $amount;

        if ('natural' === $userType) {
            $fee = 0.00;

            if ('EUR' === $currency) {
                $noFeeAmount = 1000;
            }

            if ('JPY' === $currency) {
                $noFeeAmount = 1000 * $this->eurTojpy;
            }

            if ('USD' === $currency) {
                $noFeeAmount = 1000 * $this->eurTousd;
            }

            if ($amount > $noFeeAmount) {
                $amount = $amount - $noFeeAmount;
                $fee = $this->percentCalculation($this->cashOutFee[$userType], $amount);
            }

            return $fee;
        }

        if ('legal' === $userType) {
            $fee = $this->percentCalculation($this->cashOutFee[$userType], $amount);
            return $fee < 0.50 ? 0.50 : $fee;
        }
    }

    /**
     * Find the percent fee of given amount.
     *
     * @param $fee
     *   numeric
     * @param $amount
     *   numeric
     *
     * @return float|int
     */
    private function percentCalculation($fee, $amount)
    {
        return ($fee / 100) * $amount;
    }
}
