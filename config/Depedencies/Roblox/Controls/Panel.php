<?php
namespace Roblox\Controls;

class Panel {
    public string $id;
    public string $cssClass = '';
    public bool $visible = true;
    public array $children = [];

    public function __construct(string $id = '') {
        $this->id = $id;
    }

    public function addChild($child): void {
        $this->children[] = $child;
    }

    public function render(): string {
        if (!$this->visible) {
            return '';
        }

        $html = "<div";
        if ($this->id !== '') {
            $html .= " id=\"" . htmlspecialchars($this->id) . "\"";
        }
        if ($this->cssClass !== '') {
            $html .= " class=\"" . htmlspecialchars($this->cssClass) . "\"";
        }
        $html .= ">";

        foreach ($this->children as $child) {
            if (is_object($child) && method_exists($child, 'render')) {
                $html .= $child->render();
            } else {
                // don’t escape html strings please
                $html .= (string)$child;
            }
        }

        $html .= "</div>";
        return $html;
    }

}
