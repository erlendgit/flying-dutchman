<?php

namespace FlyingDutchman;

class Log {
  protected $distance;
  protected $landDistance;
  protected $translationX;
  protected $translationY;
  protected $translationZ;
  protected $direction;

  public function __construct() {
    $this->distance = 0;
    $this->landDistance = 0;
    $this->translationX = 0;
    $this->translationY = 0;
    $this->translationZ = 0;
    $this->course = 0;
    $this->direction = 0;
  }

  public function go($time, $speed=1, $angle=0) {
    $distance = $time * $speed;

    $this->distance = $distance + $this->distance;
    $landDistance = ($distance * cos(deg2rad($angle)));
    $this->landDistance += $landDistance;
    $this->translationX += $landDistance * cos(deg2rad($this->direction));
    $this->translationY += $landDistance * sin(deg2rad($this->direction));
    $this->translationZ += ($distance * sin(deg2rad($angle)));

    return $this;
  }

  public function getOdo() {
    return $this->distance;
  }

  public function getLandDistance() {
    return $this->landDistance;
  }

  public function getAltitude() {
    return $this->translationZ;
  }

  public function changeCourse($deg) {
    $this->direction += $deg;
    while ($this->direction >= 360) {
      $this->direction -= 360;
    }
    while ($this->direction < 0) {
      $this->direction += 360;
    }
    return $this;
  }

  public function getDirection() {
    return $this->direction;
  }

  public function getLocation() {
    return [$this->translationX,$this->translationY];
  }
}