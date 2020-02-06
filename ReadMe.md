# Payroll Dates Generator

##### This is console utility that generate CSV file (for now) has the payroll for a whole year salary and bonus payment dates.

## The problem:
* Sales staff get a regular monthly fixed base salary and a monthly bonus.
* The base salaries are paid on the last day of the month unless that day is a Saturday or
a Sunday (weekend).
* On the 15th of every month bonuses are paid for the previous month, unless that day is
a weekend. In that case, they are paid the first Wednesday after the 15th.
* The output of the utility should be a CSV file, containing the payment dates for the
remainder of this year. The CSV file should contain a column for the month, a column that contains the salary payment date for that month, and a column that contains the bonus payment date.

## Requirements:
* PHP >= 7.4
* composer


## Usage:

> Please, make sure first that is the `bin` file has the correct permissions, you can run the following command to be sure:
```cmd
$ chmod +x bin
```

* First run composer:
```cmd
$ composer update
```

* To generate CSV file for the current year payroll, open your terminal and type:
```cmd
$ ./bin --salary-sheet --generate
```
> This will generate csv file under `result/` folder with name `2020_salaryAndBonusPaymentDays.csv`.

* If you want to generate it for specific year, just update the command to:
```cmd
$ ./bin --salary-sheet --generate --year=2019
```

* If you want to use specific CSV file name then update the command to:
```cmd
$ ./bin --salary-sheet --generate --sheet-name=payroll_for_year_2020
```

* If you want the generated file to be located in specific directory then update the command to:
```cmd
$ ./bin --salary-sheet --generate --sheet-path=payroll
```
**NOTE:** if the provided directory not exist it will create it.

**You can as well combine more than one option for the command**