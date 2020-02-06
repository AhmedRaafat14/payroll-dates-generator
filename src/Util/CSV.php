<?php

namespace Fictional\SheetsGenerator\Util;

/**
 * This class is used to build CSV sheet
 *
 * Class CSV
 * @package Fictional\SheetsGenerator\Util
 */
class CSV
{
    private const CSV_HEADER = ['Month', 'Salary Date', 'Bonus Date'];

    /** @var string $sheetName */
    private string $sheetName;

    /** @var string $sheetPath */
    private string $sheetPath;

    /**
     * CSV constructor.
     * @param string $sheetName
     * @param string $sheetPath
     */
    public function __construct(string $sheetName, string $sheetPath = '')
    {
        $this->sheetName = $sheetName;
        $this->sheetPath = $sheetPath;
    }

    /**
     * Build the sheet that contains the payment date for each month in the year specified.
     *
     * @param array $salaryPaymentDays
     */
    public function buildSheet(array $salaryPaymentDays): void
    {
        $sheetFilePointer = fopen("{$this->sheetPath}/{$this->sheetName}.csv", 'w');

        # Write the sheet header
        fputcsv($sheetFilePointer, self::CSV_HEADER);

        foreach ($salaryPaymentDays as $month => $dates) {
            $line = [$month, $dates[0], $dates[1]];
            fputcsv($sheetFilePointer, $line);
        }

        fclose($sheetFilePointer);
    }
}
