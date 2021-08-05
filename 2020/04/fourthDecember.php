<?php

new fourthDecember();

/**
 * Class fourthDecember
 */
class fourthDecember
{
    private array $passports, $validPassports, $invalidPassports;

    public function __construct()
    {
        $fileContent = file_get_contents(__DIR__ . '/input.txt');
        $passportsRaw = array_filter(explode(PHP_EOL . PHP_EOL, $fileContent));
        $this->parsePassports($passportsRaw);
        $this->partOne();
        $this->partTwo();
    }

    /**
     * @param array $passportsRaw
     */
    public function parsePassports(array $passportsRaw): void
    {
        // First we want to split each passport line by key:value
        foreach ($passportsRaw as $key => $passportRaw) {
            // First add each passport field to
            $passportArray = array_filter(preg_split('/[\n ]/', $passportRaw));

            // Now we split the key:value string to an associative array
            $mappedPassportData = [];
            foreach ($passportArray as $passportProperty) {
                [$property, $value] = explode(':', $passportProperty);
                $mappedPassportData[$property] = $value;
            }
            $this->passports[$key] = $mappedPassportData;
        }
    }

    /**
     * Validate the passports for mandatory fields.
     */
    public function partOne(): void
    {
        $mandatoryInformation = [
            'byr',
            'iyr',
            'eyr',
            'hgt',
            'hcl',
            'ecl',
            'pid',
        ];

        foreach ($this->passports as $passport) {
            //  Check if all the mandatory fields are present within the passport information
            if (count($mandatoryInformation) > count(array_intersect_key(array_flip($mandatoryInformation), $passport))) {
                $this->invalidPassports[] = $passport;
                continue;
            }
            $this->validPassports[] = $passport;
        }

        echo "Solution for Part 1\n";
        echo count($this->validPassports) . " passports are valid and " . count($this->invalidPassports) . " are invalid.\n";
        // solution -> 242 valid and 44 invalid
    }

    /**
     * Validate each field of the passport.
     */
    public function partTwo(): void
    {
        // We do not need the invalid passports, since they are declined already anyway.
        $invalid = $valid = [];
        foreach ($this->validPassports as $passport) {

            $validationResult = [
                // birth year
                'byr' => (1920 <= $passport['byr']) && ($passport['byr'] <= 2002),
                // issue year
                'iyr' => (2010 <= $passport['iyr']) && ($passport['iyr'] <= 2020),
                // expiration year
                'eyr' => (2020 <= $passport['eyr']) && ($passport['eyr'] <= 2030),
                // height
                'hgt' => $this->validateHeight($passport['hgt']),
                // hair color should match a hex color pattern
                'hcl' => (bool)preg_match('/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/m', $passport['hcl']),
                // eye color
                'ecl' => in_array($passport['ecl'], ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth',]),
                // 9 digit numeric passport id
                'pid' => is_integer((int)$passport['pid']) && 9 === strlen($passport['pid'])
            ];

            // If any of the above solutions have failed the array contains a false boolean.
            if (in_array(false, $validationResult, true)) {
                $invalid[] = $passport;
                continue;
            }

            $valid[] = $passport;
        }

        echo "\nSolution for Part 2\n";
        echo count($valid) . " passports are valid and " . count($invalid) . " are invalid.\n";
        echo "\nWhich makes up a total of " . (count($this->invalidPassports) + count($invalid)) . " invalid passports.\n";
    }

    /**
     * @param string $height
     * @return bool
     */
    private function validateHeight(string $height): bool
    {
        preg_match('/^(\d+)([A-z]+)$/', $height, $matches, PREG_UNMATCHED_AS_NULL);

        if (!isset($matches[0], $matches[1], $matches[2])) return false;

        $number = $matches[1];
        $measurement = $matches[2];

        // Only allow between 150cm and 193cm
        if ('cm' === $measurement && (150 <= $number && $number <= 193)) {
            return true;
        }

        // only allow between 59in and 76in
        if ('in' === $measurement && (59 <= $number && $number <= 76)) {
            return true;
        }

        return false;
    }
}
