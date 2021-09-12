<?php
declare(strict_types = 1);

namespace Freesoftde\Validator;

class LiquibaseJarValidator
{

    /**
     * @param  string $path
     * @param  string $checksum
     * @return bool
     */
    public static function validate(string $path, string $checksum): bool
    {
        return hash_file('sha256', $path) === $checksum;
    }
}