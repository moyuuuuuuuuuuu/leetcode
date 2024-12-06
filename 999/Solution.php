<?php
$board = [
    [".", ".", ".", ".", ".", ".", ".", "."],
    [".", ".", ".", "p", ".", ".", ".", "."],
    [".", ".", ".", "R", ".", ".", ".", "p"],
    [".", ".", ".", ".", ".", ".", ".", "."],
    [".", ".", ".", ".", ".", ".", ".", "."],
    [".", ".", ".", "p", ".", ".", ".", "."],
    [".", ".", ".", ".", ".", ".", ".", "."],
    [".", ".", ".", ".", ".", ".", ".", "."]
];

$board1 = [
    [".", ".", ".", ".", ".", ".", ".", "."],
    [".", "p", "p", "p", "p", "p", ".", "."],
    [".", "p", "p", "B", "p", "p", ".", "."],
    [".", "p", "B", "R", "B", "p", ".", "."],
    [".", "p", "p", "B", "p", "p", ".", "."],
    [".", "p", "p", "p", "p", "p", ".", "."],
    [".", ".", ".", ".", ".", ".", ".", "."],
    [".", ".", ".", ".", ".", ".", ".", "."]
];

$board2 = [
    [".", ".", ".", ".", ".", ".", ".", "."],
    [".", ".", ".", "p", ".", ".", ".", "."],
    [".", ".", ".", "p", ".", ".", ".", "."],
    ["p", "p", ".", "R", ".", "p", "B", "."],
    [".", ".", ".", ".", ".", ".", ".", "."],
    [".", ".", ".", "B", ".", ".", ".", "."],
    [".", ".", ".", "p", ".", ".", ".", "."],
    [".", ".", ".", ".", ".", ".", ".", "."]
];
$board3 = [
    ["R", ".", "p", ".", "p", ".", ".", "."],
    [".", ".", ".", ".", ".", ".", ".", "."],
    [".", ".", ".", ".", ".", ".", ".", "."],
    [".", ".", ".", ".", ".", ".", ".", "."],
    ["p", ".", ".", ".", ".", ".", ".", "."],
    ["p", ".", ".", ".", ".", ".", ".", "."],
    [".", ".", ".", ".", ".", ".", ".", "."],
    [".", ".", ".", ".", ".", ".", ".", "."]
];

class Solution
{

    /**
     * @param String[][] $board
     * @return Integer
     */
    function numRookCaptures($board)
    {
        $chesePostion = $this->chesePostion($board);
        $rPostion     = $chesePostion['R'][0] ?? [];
        if (!$rPostion) {
            return 0;
        }
        $bPostionList = $chesePostion['B'] ?? [];
        unset($chesePostion['R'], $chesePostion['B']);
        return $this->calc($chesePostion['p'], $rPostion, $bPostionList);
    }

    /**
     * 获取棋子坐标
     * @param $board
     * @return array
     */
    function chesePostion(&$board)
    {
        $chesePostion = [];
        foreach ($board as $row => $value) {
            foreach ($value as $col => $chese) {
                if ($chese !== '.') {
                    $chesePostion[$chese][] = [$row, $col];
                }
            }
        }
        return $chesePostion;
    }

    /**
     * 检测棋子是否被遮挡
     * @param int[] $chese 棋子坐标
     * @param int[] $target 目标棋子坐标
     * @param int[] $block 遮挡物坐标
     * @return bool
     */
    public function isBlock($chese, $target, $block)
    {
        list($cheseX, $cheseY) = $chese;
        list($targetX, $targetY) = $target;
        list($blockX, $blockY) = $block;
        //棋子和目标棋子在同一行
        if ($cheseX == $targetX) {
            if ($blockX == $cheseX && $blockY > min($cheseY, $targetY) && $blockY < max($cheseY, $targetY)) {
                return true;
            }
        } //棋子和目标棋子在同一列
        else if ($cheseY == $targetY) {
            if ($blockY == $cheseY && $blockX > min($cheseX, $targetX) && $blockX < max($cheseX, $targetX)) {
                return true;
            }
        }
        return false;
    }

    public function calc($chesePostionList, $rPostion, $bPostionList)
    {
        list($rx, $ry) = $rPostion;
        $arrY = $arrX = [];
        //获取行和列中的最小值的坐标
        foreach ($chesePostionList as $key => $chese) {
            foreach ($bPostionList as $b) {
                if ($this->isBlock($chese, $rPostion, $b)) {
                    continue 2;
                }
            }
            list($x, $y) = $chese;
            if ($x == $rx) {
                $arrX[($ry - $y)][] = 1;
            } else if ($y == $ry) {
                $arrY[($rx - $x)][] = 1;
            }
        }
        $num = $this->judge(array_keys($arrX));
        $num += $this->judge(array_keys($arrY));
        return $num;
    }

    /**
     * 检测数组中是否只有正整数或者负整数 或者二者都有
     * @param $array
     * @return int
     */
    public function judge($arr)
    {
        // 检查是否包含正整数
        $hasPositive = count(array_filter($arr, function ($v) {
                return is_int($v) && $v > 0;
            })) > 0;

        // 检查是否包含负整数
        $hasNegative = count(array_filter($arr, function ($v) {
                return is_int($v) && $v < 0;
            })) > 0;

        if ($hasPositive && $hasNegative) {
            return 2;
        } elseif ($hasPositive || $hasNegative) {
            return 1;
        } else {
            return 0;
        }
    }
}

$num = (new Solution())->numRookCaptures($board3);
echo $num;
