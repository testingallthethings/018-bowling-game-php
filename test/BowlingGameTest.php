<?php
declare(strict_types=1);

namespace Braddle;

use PHPUnit\Framework\TestCase;

class BowlingGameTest extends TestCase
{
    private $game;

    protected function setUp() : void
    {
        parent::setUp();

        $this->game = new BowlingGame();
    }


    public function testGutterBallGame()
    {
        $score = $this->game->calculateScore("-- -- -- -- -- -- -- -- -- --");

        $this->assertEquals(0, $score);
    }

    public function testFirstBallSinglePinGame()
    {
        $score = $this->game->calculateScore("1- -- -- -- -- -- -- -- -- --");

        $this->assertEquals(1, $score);
    }

    public function testSecondBallSinglePinGame()
    {
        $score = $this->game->calculateScore("-1 -- -- -- -- -- -- -- -- --");

        $this->assertEquals(1, $score);
    }

    public function testSingleSpare()
    {
        $score = $this->game->calculateScore("5/ -- -- -- -- -- -- -- -- --");

        $this->assertEquals(10, $score);
    }

    public function testSpareNextBallDoubled()
    {
        $score = $this->game->calculateScore("5/ 5- -- -- -- -- -- -- -- --");

        $this->assertEquals(20, $score);
    }

    public function testFirstBallStrike()
    {
        $score = $this->game->calculateScore("X -- -- -- -- -- -- -- -- --");

        $this->assertEquals(10, $score);
    }

    public function testFirstBallStrikeNextTwoBallsTwoDouble()
    {
        $score = $this->game->calculateScore("X 22 -- -- -- -- -- -- -- --");

        $this->assertEquals(18, $score);
    }

    public function testFinalFrameSpareResolved()
    {
        $score = $this->game->calculateScore("-- -- -- -- -- -- -- -- -- 5/2");

        $this->assertEquals(12, $score);
    }

    public function testFinalFrameStrikeResolved()
    {
        $score = $this->game->calculateScore("-- -- -- -- -- -- -- -- -- X52");

        $this->assertEquals(17, $score);
    }

    public function testFinalFrameSpareThenStrikeResolved()
    {
        $score = $this->game->calculateScore("-- -- -- -- -- -- -- -- -- 5/X");

        $this->assertEquals(20, $score);
    }

    public function testFinalFrameStrikeThenSpareResolved()
    {
        $score = $this->game->calculateScore("-- -- -- -- -- -- -- -- -- X5/");

        $this->assertEquals(20, $score);
    }

    public function testFinalFrameThreeStrikesResolved()
    {
        $score = $this->game->calculateScore("-- -- -- -- -- -- -- -- -- XXX");

        $this->assertEquals(30, $score);
    }

    public function testFirstThreeBallAllStrikes()
    {
        $score = $this->game->calculateScore("X X X -- -- -- -- -- -- --");

        $this->assertEquals(60, $score);
    }

    public function testFirstThreeBallStrikeThenSpare()
    {
        $score = $this->game->calculateScore("X 5/ -- -- -- -- -- -- -- --");

        $this->assertEquals(30, $score);
    }

    public function testPerfectGame()
    {
        $score = $this->game->calculateScore("X X X X X X X X X XXX");

        $this->assertEquals(300, $score);
    }

    public function testNormalishGame()
    {
        $score = $this->game->calculateScore("15 33 -/ 54 8- X 22 9/ 8- 9-");

        $this->assertEquals(97, $score);
    }


}