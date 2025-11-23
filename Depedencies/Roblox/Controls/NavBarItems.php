<?php
namespace Roblox\Controls;

class NavBarItem {
    public string $text;
    public string $url;
    public string $cssClass = '';
    public bool $active = false;

    public function __construct(string $text, string $url, string $cssClass = '', bool $active = false) {
        $this->text = $text;
        $this->url = $url;
        $this->cssClass = $cssClass;
        $this->active = $active;
    }

    public function render(): string {
        $class = $this->cssClass;
        if ($this->active) {
            $class = trim($class . ' active');
        }

        $html = "<li";
        if ($class !== '') {
            $html .= " class=\"" . htmlspecialchars($class) . "\"";
        }
        $html .= "><a href=\"" . htmlspecialchars($this->url) . "\">" . htmlspecialchars($this->text) . "</a></li>";

        return $html;
    }
}

class NavBarItems {
    public string $id;
    public string $cssClass = 'navbar-nav';
    public array $items = [];

    public function __construct(string $id = '') {
        $this->id = $id;
    }

    public function addItem(NavBarItem $item): void {
        $this->items[] = $item;
    }

    public function render(): string {
        $html = "<ul";
        if ($this->id !== '') {
            $html .= " id=\"" . htmlspecialchars($this->id) . "\"";
        }
        if ($this->cssClass !== '') {
            $html .= " class=\"" . htmlspecialchars($this->cssClass) . "\"";
        }
        $html .= ">";

        foreach ($this->items as $item) {
            $html .= $item->render();
        }

        $html .= "</ul>";
        return $html;
    }
}
