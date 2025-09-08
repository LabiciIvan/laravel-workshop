<?php

namespace App\Classes;

class Work {

    public $name;

    public function _construct($name)
    {
        $this->name = $name;
    }

    private function thingsThatKeepUpAtNight() {
        return 'I might win the lottery';
    }

}
