<?php

namespace App\Domain\Profile\ValueObject\Contact;

use Assert\Assertion;

class Email
{
    /** @var string */
    private $email;

    /**
     * @throws \Assert\AssertionFailedException
     */
    public static function fromString(string $email = ''): self
    {
        if($email !== '') {
            self::validate($email);
        }

        return new self($email);
    }

    /**
     * @return Email
     */
    public static function createBlank() {
        return new self('');
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->email;
    }

    /**
     * Email constructor.
     * @param $email
     */
    private function __construct($email) {
        $this->email = $email;
    }

    /**
     * @param $value
     * @throws \Assert\AssertionFailedException
     */
    private static function validate($value) {
        Assertion::email($value, 'Not a valid email');
    }
}
