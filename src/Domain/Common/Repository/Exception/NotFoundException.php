<?php

namespace App\Domain\Common\Repository\Exception;

class NotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Resource not found');
    }
}
