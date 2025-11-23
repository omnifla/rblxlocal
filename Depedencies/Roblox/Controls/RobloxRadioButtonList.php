<?php
namespace Roblox\Controls;

class RobloxRadioButtonList {
    public string $name;
    public string $cssClass = '';
    public array $items = [];
    public ?string $selectedValue = null;

    public function __construct(string $name, string $cssClass = '') {
        $this->name = $name;
        $this->cssClass = $cssClass;
    }

    public function addItem(string $value, string $text, bool $selected = false): void {
        $this->items[$value] = $text;
        if ($selected) {
            $this->selectedValue = $value;
        }
    }

    public function setSelectedValue(?string $value): void {
        if ($value !== null && array_key_exists($value, $this->items)) {
            $this->selectedValue = $value;
        }
    }

    public function getSelectedValue(): ?string {
        return $this->selectedValue;
    }

    public function render(): string {
        $html = "<div";
        if ($this->cssClass !== '') {
            $html .= " class=\"" . htmlspecialchars($this->cssClass) . "\"";
        }
        $html .= ">";

        foreach ($this->items as $value => $text) {
            $checked = ($this->selectedValue === $value) ? " checked" : "";
            $html .= "<label><input type=\"radio\" name=\"" . htmlspecialchars($this->name) .
                "\" value=\"" . htmlspecialchars($value) . "\"$checked> " .
                htmlspecialchars($text) . "</label><br>";
        }

        $html .= "</div>";
        return $html;
    }
}
