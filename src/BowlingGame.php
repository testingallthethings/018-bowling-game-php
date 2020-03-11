<?php
declare(strict_types=1);

namespace Braddle;

class BowlingGame
{

    public function calculateScore(string $game) : int
    {
        $score = 0;
        $frames = mb_split(" ", $game);

        for ($i = 0; $i < 10; $i++) {
            $frame = $frames[$i];

            if ($this->isStrike($frame)) {
                $score += 10;
                if ($this->isLastFrame($i)) {
                    $score += $this->getBallScore(2, $frame);
                    $score += $this->getBallScore(3, $frame);
                } elseif ($i == 8) {
                    $nextFrame = $frames[$i + 1];
                    $score += $this->getBallScore(1, $nextFrame);
                    $score += $this->getBallScore(2, $nextFrame);
                } else {
                    $nextFrame = $frames[$i + 1];
                    $score += $this->getBallScore(1, $nextFrame);
                    if ($this->isStrike($nextFrame)) {
                        $nextNextFrame = $frames[$i + 2];
                        $score += $this->getBallScore(1, $nextNextFrame);
                    } else {
                        $score += $this->getBallScore(2, $nextFrame);
                    }
                }
            } elseif ($this->isSpare($frame)) {
                $score += 10;
                if ($this->isLastFrame($i)) {
                    $score += $this->getBallScore(3, $frame);
                } else {
                   $nextFrame = $frames[$i + 1];
                   $score += $this->getBallScore(1, $nextFrame);
                }
            } else {
                $score += $this->getBallScore(1, $frame);
                $score += $this->getBallScore(2, $frame);
            }
        }

        return $score;
    }

    private function getBallScore(int $ball, string $frame) :int {
        if (is_numeric($frame[$ball - 1])) {
            return intval($frame[$ball - 1]);
        } elseif ($frame[$ball - 1] == "X") {
            return 10;
        } elseif ($frame[$ball - 1] == "/") {
            return 10 - $frame[$ball - 2];
        }

        return 0;
    }

    private function isSpare(string $frame): bool
    {
        return strlen($frame) > 1 && $frame[1] === "/";
    }

    private function isStrike(string $frame): bool
    {
        return $frame[0] === "X";
    }

    /**
     * @param int $i
     * @return bool
     */
    private function isLastFrame(int $i): bool
    {
        return $i == 9;
    }
}