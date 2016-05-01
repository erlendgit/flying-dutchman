<?php

namespace FlyingDutchman;
use FlyingDutchman\Log;

class LogTest extends \PHPUnit_Framework_TestCase {

  public function testShouldFly() {
    $log = new Log();

    // will it fly?
    $distance = $log->go(0);
    $this->assertEquals(0, $distance);
  }

  public function testShouldFlyFar() {
    $log = new Log();

    // will it fly?
    $distance = $log->go(1);
    $this->assertEquals(1, $distance);

    $log->go(1);
    $odo = $log->getOdo();
    $this->assertEquals(2, $odo);

    $log->go(1);
    $odo = $log->getOdo();
    $this->assertEquals(3, $odo);
  }

  public function testShouldFlyFast() {
    $log = new Log();

    // will it fly?
    $distance = $log->go(1, 2);
    $this->assertEquals(2, $distance);
    
    // continue to fly
    $distance = $log->go(2, 3);
    $this->assertEquals(6, $distance);
  }
  
}