<?php
namespace Roblox\TextFilter;

interface ITextFilter
{
    public function filter(string $text): ITextFilterResults;
}
