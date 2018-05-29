<?php

namespace Tests\Randomuser\Domain\ValueObject;

use InvalidArgumentException;

/**
 * Class Email
 * @package Domain\ValueObject
 */
class Email
{
    /**
     * @var string
     */
    private $value;
    /**
     * Email constructor.
     * @param string $value
     * @throws InvalidArgumentException
     */
    public function __construct($value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException('Некорректный адрес email.');
        }
        $this->value = $value;
    }
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}