<?php
namespace Roblox\TextFilter;

interface ITextFilterResults
{
    public function getFilteredText(): string;
    public function isFiltered(): bool;
}
