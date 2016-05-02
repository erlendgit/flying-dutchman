<?php

namespace FlyingDutchman;
use FlyingDutchman\Log;

class LogTest extends \PHPUnit_Framework_TestCase {

  public function testShouldFlyFar() {
    $log = new Log();

    // will it fly?
    $log->go(1);
    $this->assertEquals(1, $log->getOdo());

    $log->go(1);
    $this->assertEquals(2, $log->getOdo());

    $log->go(1);
    $this->assertEquals(3, $log->getOdo());
  }

  public function testShouldFlyForward() {
    $log = new Log();

    $log->go(0);
    $this->assertEquals(0, $log->getLandDistance());

    $log->go(1);
    $this->assertEquals(1, $log->getLandDistance());

    $log->go(1, sqrt(2), 45);
    $this->assertEquals(2, $log->getLandDistance());

  }

  public function testShouldFlyUp() {
    $log = new Log();

    $log->go(1, 1, 0);
    $this->assertEquals(0, $log->getAltitude());
    
    $distance = $log->go(1, sqrt(1.25), rad2deg(atan(.5)));
    $this->assertEquals(.5, round($log->getAltitude(), 3));
  }

  public function testShouldFlyInACertainDirection() {
    $log = new Log();

    $this->assertEquals(0, $log->changeCourse(0)->getDirection());
    $this->assertEquals(10, $log->changeCourse(10)->getDirection());
    $this->assertEquals(20, $log->changeCourse(10)->getDirection());
    $this->assertEquals(20, $log->changeCourse(360)->getDirection());
    $this->assertEquals(0, $log->changeCourse(700)->getDirection());
    $this->assertEquals(0, $log->changeCourse(-360)->getDirection());
    $this->assertEquals(0, $log->changeCourse(-720)->getDirection());
    $this->assertEquals(359, $log->changeCourse(-1)->getDirection());
  }

  public function testShouldBeSomewhere() {
    $log = new Log();

    $this->assertEquals([1,0], $log->go(1)->getLocation());
    $this->assertEquals([2,0], $log->go(1)->getLocation());
    $log->changeCourse(90);

    $this->assertEquals([2,1], $log->go(1)->getLocation());

    $log->changeCourse(90)->go(2)->changeCourse(90)->go(1);
    $this->assertEquals([0,0], $log->getLocation());
  }
}