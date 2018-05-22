<?php

namespace Jra\Html;

class KaisaiButton {
    private $place;
    private $cname;

    public function __construct($place, $cname) {
        $this->place = $place;
        $this->cname = $cname;
    }
}