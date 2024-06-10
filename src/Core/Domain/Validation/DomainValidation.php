<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation
{
    public static function notNull(string $value, ?string $exceptMessage = null)
    {
        if (empty($value)) {
            throw new EntityValidationException($exceptMessage ?? 'Should not be empty');
        }

    }

    public static function strMaxLength(string $value, int $max_length = 255, $exceptMessage = null)
    {
        if (strlen($value) > $max_length) {
            throw new EntityValidationException($exceptMessage ?? " the value most not be greater than {$max_length} characters ");
        }

    }

    public static function strMinLength(string $value, int $min_length = 2, $exceptMessage = null)
    {
        if (strlen($value) <= $min_length) {
            throw new EntityValidationException($exceptMessage ?? " the value most not be less than {$min_length} characters ");
        }

    }

    public static function strCanNullAndMaxLength(string $value = '', int $length = 255, ?string $exceptMessage = null)
    {
        if (! empty($value) && strlen($value) > $length) {
            throw new EntityValidationException($exceptMessage ?? "The value must not be greater than {$length} characters");
        }
    }
}
