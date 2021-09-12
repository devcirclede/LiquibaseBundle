<?php

declare(strict_types=1);

namespace Freesoftde\Validator;

class JavaValidator
{

    /**
     * Simple check if java is available
     *
     * @return bool
     */
    public static function validate(): bool
    {
        return false !== exec("java -v");
    }
}
