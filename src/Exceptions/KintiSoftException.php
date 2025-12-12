<?php

namespace KintiSoft\SDK\Exceptions;

use Exception;

class KintiSoftException extends Exception
{
    private ?int $status;
    private mixed $details;

    public function __construct(string $message, ?int $status = null, mixed $details = null)
    {
        parent::__construct($message);
        $this->status = $status;
        $this->details = $details;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getDetails(): mixed
    {
        return $this->details;
    }

    public function __toString(): string
    {
        if ($this->status !== null) {
            return '[' . $this->status . '] ' . parent::__toString();
        }
        return parent::__toString();
    }
}
