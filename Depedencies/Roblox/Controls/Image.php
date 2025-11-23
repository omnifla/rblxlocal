<?php
namespace Roblox\Controls;

class Image {
    public string $id;
    public string $src = '';
    public string $alt = '';
    public int $width = 0;
    public int $height = 0;
    public string $cssClass = '';
    public bool $visible = true;

    public function __construct(string $id = '', string $src = '') {
        $this->id = $id;
        $this->src = $src;
    }

    public function render(): string {
        if (!$this->visible) {
            return '';
        }

        $html = "<img";
        if ($this->id !== '') {
            $html .= " id=\"" . htmlspecialchars($this->id) . "\"";
        }
        if ($this->cssClass !== '') {
            $html .= " class=\"" . htmlspecialchars($this->cssClass) . "\"";
        }
        if ($this->src !== '') {
            $html .= " src=\"" . htmlspecialchars($this->src) . "\"";
        }
        if ($this->alt !== '') {
            $html .= " alt=\"" . htmlspecialchars($this->alt) . "\"";
        }
        if ($this->width > 0) {
            $html .= " width=\"{$this->width}\"";
        }
        if ($this->height > 0) {
            $html .= " height=\"{$this->height}\"";
        }
        $html .= " />";

        return $html;
    }
}
