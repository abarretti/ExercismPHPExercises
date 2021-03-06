<?php

require "bowling.php";

/**
 * Translated from original source:
 * http://butunclebob.com/ArticleS.UncleBob.TheBowlingGameKata
 */
class GameTest extends PHPUnit\Framework\TestCase
{
    /** @var Game */
    private $game;

    public function setUp()
    {
        $this->game = new Game();
    }

    public function testShouldBeAbleToScoreAGameWithAllZeros()
    {
        $this->rollMany(20, 0);

        $this->assertEquals(0, $this->game->score());
    }

    public function testShouldBeAbleToScoreAGameWithNoStrikesOrSpares()
    {
        //$this->markTestSkipped();
        $this->game->roll(3);
        $this->game->roll(6);
        $this->game->roll(3);
        $this->game->roll(6);
        $this->game->roll(3);
        $this->game->roll(6);
        $this->game->roll(3);
        $this->game->roll(6);
        $this->game->roll(3);
        $this->game->roll(6);
        $this->game->roll(3);
        $this->game->roll(6);
        $this->game->roll(3);
        $this->game->roll(6);
        $this->game->roll(3);
        $this->game->roll(6);
        $this->game->roll(3);
        $this->game->roll(6);
        $this->game->roll(3);
        $this->game->roll(6);

        $this->assertEquals(90, $this->game->score());
    }

    public function testASpareFollowedByZerosIsWorthTenPoints()
    {
        //$this->markTestSkipped();
        $this->game->roll(6);
        $this->game->roll(4);
        $this->rollMany(18, 0);

        $this->assertEquals(10, $this->game->score());
    }

    public function testPointsScoredInTheRollAfterASpareAreCountedTwice()
    {
        //$this->markTestSkipped();
        $this->game->roll(6);
        $this->game->roll(4);
        $this->game->roll(3);
        $this->rollMany(17, 0);

        $this->assertEquals(16, $this->game->score());
    }

    public function testConsecutiveSparesEachGetAOneRollBonus()
    {
        //$this->markTestSkipped();
        $this->game->roll(5);
        $this->game->roll(5);
        $this->game->roll(3);
        $this->game->roll(7);
        $this->game->roll(4);
        $this->rollMany(15, 0);

        $this->assertEquals(31, $this->game->score());
    }

    public function testASpareInTheLastFrameGetsAOneRollBonusThatIsCountedOnce()
    {
        //$this->markTestSkipped();
        $this->rollMany(18, 0);
        $this->game->roll(7);
        $this->game->roll(3);
        $this->game->roll(7);

        $this->assertEquals(17, $this->game->score());
    }

    public function testAStrikeEarnsTenPointsInFrameWithASingleRoll()
    {
        //$this->markTestSkipped();
        $this->game->roll(10);
        $this->rollMany(18, 0);

        $this->assertEquals(10, $this->game->score());
    }

    public function testPointsScoredInTheTwoRollsAfterAStrikeAreCountedTwiceAsABonus()
    {
        //$this->markTestSkipped();
        $this->game->roll(10);
        $this->game->roll(5);
        $this->game->roll(3);
        $this->rollMany(16, 0);

        $this->assertEquals(26, $this->game->score());
    }

    public function testConsecutiveStrikesEachGetTheTwoRollBonus()
    {
        //$this->markTestSkipped();
        $this->game->roll(10);
        $this->game->roll(10);
        $this->game->roll(10);
        $this->game->roll(5);
        $this->game->roll(3);
        $this->rollMany(12, 0);

        $this->assertEquals(81, $this->game->score());
    }

    public function testAStrikeInTheLastFrameGetsATwoRollBonusThatIsCountedOnce()
    {
        //$this->markTestSkipped();
        $this->rollMany(18, 0);
        $this->game->roll(10);
        $this->game->roll(7);
        $this->game->roll(1);

        $this->assertEquals(18, $this->game->score());
    }

    public function testRollingASpareWithTheTwoRollBonusDoesNotGetABonusRoll()
    {
        //$this->markTestSkipped();
        $this->rollMany(18, 0);
        $this->game->roll(10);
        $this->game->roll(10);
        $this->game->roll(10);

        $this->assertEquals(30, $this->game->score());
    }

    public function testAStrikeWithTheOneRollBonusAfterASpareInTheLastFrameDoesNotGetABonus()
    {
        //$this->markTestSkipped();
        $this->rollMany(18, 0);
        $this->game->roll(7);
        $this->game->roll(3);
        $this->game->roll(10);

        $this->assertEquals(20, $this->game->score());
    }

    public function testStrikesWithTheTwoRollBonusDoNotGetBonusRolls()
    {
        //$this->markTestSkipped();
        $this->rollMany(18, 0);
        $this->game->roll(10);
        $this->game->roll(7);
        $this->game->roll(3);

        $this->assertEquals(20, $this->game->score());
    }

    public function testAllStrikesIsAPerfectGame()
    {
        //$this->markTestSkipped();
        $this->rollMany(12, 10);

        $this->assertEquals(300, $this->game->score());
    }

    public function testRollsCanNotScoreNegativePoints()
    {
        //$this->markTestSkipped();
        $this->expectException(Exception::class);

        $this->game->roll(-1);
    }

    public function testARollCanNotScoreMoreThan10Points()
    {
        //$this->markTestSkipped();
        $this->expectException(Exception::class);
        $this->game->roll(11);
        $this->rollMany(19, 0);

        $this->game->score();
    }

    public function testTwoRollsInAFrameCanNotScoreMoreThan10Points()
    {
        //$this->markTestSkipped();

        $this->expectException(Exception::class);
        $this->game->roll(5);
        $this->game->roll(6);
        $this->rollMany(18, 0);

        $this->game->score();
    }

    public function testTwoBonusRollsAfterAStrikeInTheLastFrameCanNotScoreMoreThan10Points()
    {
        //$this->markTestSkipped();
        $this->expectException(Exception::class);

        $this->rollMany(18, 0);
        $this->game->roll(10);
        $this->game->roll(5);
        $this->game->roll(6);

        $this->game->score();
    }

    public function testAnUnstartedGameCanNotBeScored()
    {
        //$this->markTestSkipped();

        $this->expectException(Exception::class);

        $this->game->score();
    }

    public function testAnIncompleteGameCanNotBeScored()
    {
        //$this->markTestSkipped();
        $this->expectException(Exception::class);
        $this->game->roll(0);
        $this->game->roll(0);

        $this->game->score();
    }

    public function testAGameWithMoreThanTenFramesCanNotBeScored()
    {
        //$this->markTestSkipped();
        $this->expectException(Exception::class);
        $this->rollMany(21, 0);

        $this->game->score();
    }

    public function testBonusRollsForAStrikeInTheLastFrameMustBeRolledBeforeScoreCanBeCalculated()
    {
        //$this->markTestSkipped();
        $this->expectException(Exception::class);
        $this->rollMany(18, 0);
        $this->game->roll(10);

        $this->game->score();
    }

    public function testBothBonusRollsForAStrikeInTheLastFrameMustBeRolledBeforeScoreCanBeCalculated()
    {
        //$this->markTestSkipped();
        $this->expectException(Exception::class);
        $this->rollMany(18, 0);
        $this->game->roll(10);
        $this->game->roll(10);

        $this->game->score();
    }

    public function testBonusRollForASpareInTheLastFrameMustBeRolledBeforeScoreCanBeCalculated()
    {
        //$this->markTestSkipped();
        $this->expectException(Exception::class);
        $this->rollMany(18, 0);
        $this->game->roll(7);
        $this->game->roll(3);

        $this->game->score();
    }

    private function rollStrike()
    {
        $this->game->roll(10);
    }

    private function rollSpare()
    {
        $this->rollMany(2, 5);
    }

    private function rollMany($n, $pins)
    {
        for ($i = 0; $i < $n; $i++) {
            $this->game->roll($pins);
        }
    }
}
