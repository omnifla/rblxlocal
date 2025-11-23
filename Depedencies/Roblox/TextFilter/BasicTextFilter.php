<?php
// ported by meditext
namespace Roblox\TextFilter;
// This is the chat filter implementation that filters out bad words from text.
// it uses the 2015-2019 chat filter algorithm, before being moved on to CommunitySift.
use Roblox\TextFilter\ITextFilter;
class BasicTextFilter implements ITextFilter
{
    private array $badWords = [];

    public function __construct(string $filePath = __DIR__ . '/swearwords.txt')
    {
        if (file_exists($filePath)) {
            $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                $word = strtolower(trim($line));
                if ($word !== '') {
                    $this->badWords[] = $word;
                }
            }
        }
    }

    public function filter(string $text): ITextFilterResults
    {
        $filtered = $text;
        $isFiltered = false;

        foreach ($this->badWords as $word) {
            if (stripos($filtered, $word) !== false) {
                $replacement = str_repeat('#', strlen($word));
                $filtered = preg_replace("/\b" . preg_quote($word, '/') . "\b/i", $replacement, $filtered);
                $isFiltered = true;
            }
        }

        return new TextFilterResults($filtered, $isFiltered);
    }
}
