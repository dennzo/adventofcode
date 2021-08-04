<?php

new fourthDecember();

/**
 * Class fourthDecember
 * @package ${NAMESPACE}
 */
class fourthDecember
{
    private array $passportsRaw;
    private array $invalidPassports;
    private array $validPassports;

    public function __construct()
    {
        $fileContent = file_get_contents(__DIR__ . '/input.txt');
        $this->passportsRaw = array_filter(explode(PHP_EOL . PHP_EOL, $fileContent));
        $this->process();
    }

    public function process()
    {
        // First we want to split each passport line by key:value
        $mappedPassports = [];
        foreach ($this->passportsRaw as $key => $passportRaw) {
            // First add each passport field to
            $passportArray = array_filter(preg_split('/[\n ]/', $passportRaw));

            // Now we split the key:value string to an associative array
            $mappedPassportData = [];
            foreach ($passportArray as $passportProperty) {
                [$property, $value] = explode(':', $passportProperty);
                $mappedPassportData[$property] = $value;
            }
            $mappedPassports[$key] = $mappedPassportData;
        }

        $mandatoryInformation = [
            'byr',
            'iyr',
            'eyr',
            'hgt',
            'hcl',
            'ecl',
            'pid',
        ];

        foreach ($mappedPassports as $passport) {
            //  Check if all the mandatory fields are present within the passport information
            if (count($mandatoryInformation) > count(array_intersect_key(array_flip($mandatoryInformation), $passport))) {
                $this->invalidPassports[] = $passport;
                continue;
            }
            $this->validPassports[] = $passport;
        }

        echo count($this->validPassports) . " passports are valid and " . count($this->invalidPassports) . " are invalid.\n";
        // solution -> 242 valid and 44 invalid
    }
}
