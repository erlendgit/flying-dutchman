<?php

namespace FlyingDutchman;

class Log {
  protected $distance;

  public function go($time, $speed=1) {
    $distance = $time * $speed;

    $this->distance = $distance + $this->distance;

    return $distance;
  }

  public function getOdo() {
    return $this->distance;
  }
}