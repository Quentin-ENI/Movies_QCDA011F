<?php

namespace App\Model;

class Quote
{
    private int $status;
    private array $citation;

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getCitation(): array
    {
        return $this->citation;
    }

    public function setCitation(array $citation): void
    {
        $this->citation = $citation;
    }
}
