<?php
namespace Roblox\Controls;

class Button {
    public string $id;
    public string $text = 'Button';
    public string $cssClass = '';
    public bool $visible = true;
    public string $onClick = '';

    public function __construct(string $id = '', string $text = 'Button') {
        $this->id = $id;
        $this->text = $text;
    }

    public function render(): string {
        if (!$this->visible) {
            return '';
        }

        $html = "<button";
        if ($this->id !== '') {
            $html .= " id=\"" . htmlspecialchars($this->id) . "\"";
        }
        if ($this->cssClass !== '') {
            $html .= " class=\"" . htmlspecialchars($this->cssClass) . "\"";
        }
        if ($this->onClick !== '') {
            $html .= " onclick=\"" . htmlspecialchars($this->onClick) . "\"";
        }
        $html .= ">" . htmlspecialchars($this->text) . "</button>";

        return $html;
    }
}
