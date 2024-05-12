<?php

namespace App\Utils;

class View {
    private string $name, $title;
    private ?string $css = null, $js = null;

    public function __construct(string $name, string $title, ?string $css = null, ?string $js = null) {
        $this->name = $name;
        $this->title = $title;
        $this->css = $css;
        $this->js = $js;
    }

    public function getName():string {
        return $this->name;
    }
    public function getTitle():string {
        return $this->title;
    }
    public function getCss():?string {
        return $this->css;
    }
    public function getJs():?string {
        return $this->js;
    }
}