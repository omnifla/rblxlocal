<?php
namespace Roblox\TextFilter;

class TextFilterResults implements ITextFilterResults
{
    private string $filteredText;
    private bool $isFiltered;

    public function __construct(string $filteredText, bool $isFiltered)
    {
        $this->filteredText = $filteredText;
        $this->isFiltered = $isFiltered;
    }

    public function getFilteredText(): string
    {
        return $this->filteredText;
    }

    public function isFiltered(): bool
    {
        return $this->isFiltered;
    }
}
