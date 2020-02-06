<?php

namespace Fictional\SheetsGenerator\Generator;

use DateTime;
use Fictional\SheetsGenerator\Util\CSV;

/**
 * Generate CSV sheet describing the current year payroll dates (salary & bonus).
 *
 * Class PaymentDatesGenerator
 * @package Fictional\SheetsGenerator\Generator
 */
class PaymentDatesGenerator
{
    # Define the weekend days (It might different from country to another)
    private const WEEKEND_DAY_1 = 'Sat';
    private const WEEKEND_DAY_2 = 'Sun';

    /** @var CSV $csv */
    private CSV $csv;

    /** @var string $calenderYear */
    private string $calenderYear;

    /**
     * SalarySheetGenerator constructor.
     * @param CSV $csv
     * @param string $calenderYear
     */
    public function __construct(CSV $csv, string $calenderYear)
    {
        $this->csv = $csv;
        $this->calenderYear = $calenderYear;
    }

    /**
     * This function the generic function that is used to build the sheet for salary and bonus payments dates.
     */
    public function generate(): bool
    {
        $salaryPaymentDates = $this->buildSalaryPaymentDatesArray();
        $bonusPaymentDates = $this->buildBonusPaymentDatesArray();

        $this->csv->buildSheet(
            array_merge_recursive($salaryPaymentDates, $bonusPaymentDates)
        );

        return true;
    }

    /**
     * Build an associative array that contains the salary payment date and the corresponding date name
     *
     * @return array
     */
    private function buildSalaryPaymentDatesArray(): array
    {
        $days = array();

        for ($month = 1; $month <= 12; $month++) {
            $paymentDay = new DateTime("last day of {$this->calenderYear}-{$month}");
            $monthName = $paymentDay->format('F');
            $dayName = $paymentDay->format('D');

            if ($dayName === self::WEEKEND_DAY_1) {
                $paymentDay->modify('-1 day');
            } elseif ($dayName === self::WEEKEND_DAY_2) {
                $paymentDay->modify('+1 day');
            }

            $days[$monthName] = $paymentDay->format('Y-m-d');
        }

        return $days;
    }

    /**
     * Build an associative array that contains the bonus payment date and the corresponding date name
     *
     * @return array
     */
    private function buildBonusPaymentDatesArray(): array
    {
        $days = array();

        for ($month = 1; $month <= 12; $month++) {
            $paymentDay = new DateTime("{$this->calenderYear}-{$month}-15");
            $dayName = $paymentDay->format('D');

            if ($dayName === self::WEEKEND_DAY_1 || $dayName === self::WEEKEND_DAY_2) {
                $paymentDay->modify('next wednesday');
            }

            $days[$paymentDay->format('F')] = $paymentDay->format('Y-m-d');
        }

        return $days;
    }
}
