<?php

namespace App\SpecialPage;

use App\Models\SpecialPage;
use App\Models\SpecialPageClick;

class ClickHandler
{
    protected const MIN_VALUE = 1;
    protected const MAX_VALUE = 1000;

    /**
     * @param SpecialPage $specialPage
     */
    public function __construct(protected SpecialPage $specialPage) {}

    /**
     * @return SpecialPageClick
     */
    public function getResult(): SpecialPageClick
    {
        $number = rand(self::MIN_VALUE, self::MAX_VALUE);
        $isWin = !($number%2);

        /** @var SpecialPageClick $specialPageClick */
        $specialPageClick = $this->specialPage
            ->specialPageClicks()
            ->create(
                [
                    'number' => $number,
                    'is_win' => $isWin,
                    'profit' => $isWin ? $this->calculateProfit($number) : 0
                ]
            );

        return $specialPageClick;
    }

    /**
     * @param int $number
     *
     * @return float
     */
    protected function calculateProfit(int $number): float
    {
        $profit = $number > 900
            ? 0.7 * $number
            : (
                $number > 600
                ? 0.5 * $number
                : (
                    $number > 300
                    ? 0.3 * $number
                    : 0.1 * $number
                )
            );
        return round($profit, 2);
    }
}
