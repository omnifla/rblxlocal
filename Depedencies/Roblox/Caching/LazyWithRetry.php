<?php
namespace Roblox\Caching;

class LazyWithRetry
{
    private mixed $value = null;
    private bool $resolved = false;

    public function __construct(
        private $callback
    ) {}

    public function getValue(): mixed
    {
        if (!$this->resolved) {
            $this->value = ($this->callback)();
            $this->resolved = true;
        }

        return $this->value;
    }
}