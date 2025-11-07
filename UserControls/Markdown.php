<?php
// written by meditext
// Markdown to html, used for feedifications.
// TODO: Might also add usage for descriptions, if i feel interested into.

namespace UserControls;

class Markdown {
    private $text;
    public function __construct(string $text) {
        $this->text = $text;
    }
    public function toHtml(): string {
        $blocks = preg_split("/\R{2,}/", trim($this->text));
        $htmlParts = [];
        foreach ($blocks as $block) {
            $block = $this->parseInline($block);
            if (preg_match('/^\d+\. /m', $block)) {
                $items = preg_replace('/^\d+\. (.+)$/m', '<li>$1</li>', $block);
                $htmlParts[] = "<ol>$items</ol>";
            }
            elseif (preg_match('/^- /m', $block)) {
                $items = preg_replace(
                    '/^- (.+)$/m',
                    '<dd><span class="md-bullet">•</span>&#9; $1</dd>',
                    $block
                );
                $htmlParts[] = "<dl>$items</dl>";
            }
            else {
                $block = preg_replace("/\n/", "<br>", $block);
                $htmlParts[] = "<p>$block</p>";
            }
        }

        return implode("\n", $htmlParts);
    }

    private function parseInline(string $text): string {
        $text = preg_replace('/^# (.*)$/m', '<h4>$1</h4>', $text);
        $text = preg_replace('/\*\*\*(.*?)\*\*\*/s', '<strong><em>$1</em></strong>', $text);
        $text = preg_replace('/\*\*(.*?)\*\*/s', '<strong>$1</strong>', $text);
        $text = preg_replace('/\*(.*?)\*/s', '<em>$1</em>', $text);
        $text = preg_replace('/`(.*?)`/s', '<code>$1</code>', $text);
        $text = preg_replace('/\[(.*?)\]\((.*?)\)/', '<a href="$2">$1</a>', $text);

        return $text;
    }
}